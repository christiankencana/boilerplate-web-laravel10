<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Operation\Client;

class ClientController extends Controller
{
    public function index()
    {
        $this->authorize('clients.index');

        $clients = Client::latest()->get();

        return view('pages/operation/client/index', [
            'clients' => $clients
        ]);
    }

    public function create()
    {
        $this->authorize('clients.create');

        return view('pages/operation/client/create');
    }

    public function store(Request $request)
    {
        $this->authorize('clients.create');

        $request->validate([
            'client_code' => 'required|unique:tb_clients,client_code',
            'client_name' => 'required|unique:tb_clients,client_name',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        $this->authorize('clients.show');

        return view('pages/operation/client/show', [
            'client' => $client
        ]);
    }

    public function edit(Client $client)
    {
        $this->authorize('clients.edit');

        return view('pages/operation/client/edit', [
            'client' => $client
        ]);
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('clients.edit');

        $request->validate([
            'client_code' => 'required|unique:tb_clients,client_code,' . $client->id,
            'client_name' => 'required|unique:tb_clients,client_name,' . $client->id,
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $this->authorize('clients.delete');

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully.');
    }

    public function companies(Client $client)
    {
        $companies = $client->companies;

        return view('pages/companies/index', [
            'client' => $client,
            'companies' => $companies
        ]);
    }
}
