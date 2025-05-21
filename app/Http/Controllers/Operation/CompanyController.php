<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\Operation\Client;
use App\Models\Operation\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $this->authorize('companies.index');

        $companies = Company::latest()->get();

        return view('pages/operation/company/index', [
            'companies' => $companies
        ]);
    }

    public function create()
    {
        $this->authorize('companies.create');

        $clients = Client::all();

        return view('pages/operation/company/create', [
            'clients' => $clients,
            'recommended_code' => $this->generateCompanyCode()
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('companies.create');

        $request->validate([
            'client_id' => 'required',

            'company_code' => 'required|unique:tb_companies,company_code',
            'company_main_name' => 'required|unique:tb_companies,company_main_name',
            'company_alternative_name' => 'max:4'
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        $this->authorize('companies.show');

        return view('pages/operation/company/show', [
            'company' => $company
        ]);
    }

    public function edit(Company $company)
    {
        $this->authorize('companies.edit');

        $clients = Client::all();

        return view('pages/operation/company/edit', [
            'clients' => $clients,
            'company' => $company,

            'recommended_code' => $this->generateCompanyCode()
        ]);
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('companies.edit');

        $request->validate([
            'client_id' => 'required',

            'company_code' => 'required|unique:tb_companies,company_code,' . $company->id,
            'company_main_name' => 'required|unique:tb_companies,company_main_name,' . $company->id,
            'company_alternative_name' => 'max:4'
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $this->authorize('companies.delete');

        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    public function locations(Company $company)
    {
        $locations = $company->locations;

        return view('pages/operation/company/haslocation/index', [
            'company' => $company,
            'locations' => $locations
        ]);
    }

    private function generateCompanyCode()
    {
        $latestCompany = Company::where('company_code', 'like', 'C-%')->orderBy('company_code', 'desc')->first();

        if ($latestCompany) {
            $lastCode = intval(str_replace('C-', '', $latestCompany->company_code));
            $newCode = 'C-' . str_pad($lastCode + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newCode = 'C-001';
        }

        return $newCode;
    }
}
