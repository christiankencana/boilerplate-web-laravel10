<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Operation\Company;
use App\Models\Operation\CompanyHasLocation;

class CompanyHasLocationController extends Controller
{
    public function index()
    {
        $this->authorize('companies.index');

        $locations = CompanyHasLocation::all();

        return view('pages/operation/company/haslocation/index', [
            'locations' => $locations
        ]);
    }

    public function create(Company $company)
    {
        $this->authorize('companies.create');

        return view('pages/operation/company/haslocation/create', [
            'company' => $company
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('companies.create');

        $request->validate([
            'company_id' => 'required',

            'location_name' => 'required',
            'location_address' => 'required',
        ]);

        CompanyHasLocation::create($request->all());

        return redirect()->route('companies.locations.index', $request->company_id)
            ->with('success', 'Location created successfully.');
    }

    public function edit(Company $company, CompanyHasLocation $location)
    {
        $this->authorize('companies.edit');

        return view('pages/operation/company/haslocation/edit', [
            'company' => $company,
            'location' => $location
        ]);
    }

    public function update(Request $request, Company $company, CompanyHasLocation $location)
    {
        $this->authorize('companies.edit');

        $request->validate([
            'company_id' => 'required',

            'location_name' => 'required',
            'location_address' => 'required',
        ]);

        $location->update($request->all());

        return redirect()->route('companies.locations.index', $location->company_id)
            ->with('success', 'Location updated successfully.');
    }

    public function destroy(Company $company, CompanyHasLocation $location)
    {
        $this->authorize('companies.delete');

        $location->delete();

        return redirect()->route('companies.locations.index', $location->company_id)
            ->with('success', 'Location deleted successfully.');
    }
}
