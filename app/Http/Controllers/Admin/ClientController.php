<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clients = Client::query()
            ->when(request()->input('search'), function($query,$searchParam){    
                 $query->where('contact_name','like',"%{$searchParam}%")
                ->orWhere('contact_email','like',"%{$searchParam}%")
                ->orWhere('company_address','like',"%{$searchParam}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($client) =>[
            'id' => $client->id,
            'contact_name' => $client->contact_name,
            'contact_email' => $client->contact_email,
            'company_address' => $client->company_address,
            'company_city' => $client->company_city,
            'projects' => Project::where('client_id',$client->id)->get()        ]);

        return Inertia::render('Clients/Index',[
            'clients' => $clients,
            'total_clients' => Client::count(),
            'filters' => request()->only(['search'])
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // StoreClientRequest
    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());
        
        return redirect()->route('clients.index')->with('message','Client with company name: '.$request->company_name.' was successfully created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return Inertia::render('Clients/Show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return Inertia::render('Clients/Edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
      
        Client::where('id',$client->id)->update($request->validated());
        return redirect()->route('clients.index')->with('message','Client record was successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
        $client->delete();
        return redirect()->route('clients.index')->with('message','Client record was successfully deleted');
    }
}
