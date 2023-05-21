<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.indexClient');
    }

    public function create(){

        return view('clients.createClient');
    }

    public function edit($id){

        $client = Client::findOrFail($id);

        return view('clients.editClient', compact('client'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|digits:9'
        ]);


        $client = new Client;
        $client->name = $request->name;
        $client->email = $request-> email;
        $client->phone_number = $request -> phone_number;

        $clients = Client::all('name','email','phone_number');

        foreach ($clients as $key){
            if($client->email == $key['email'] || $client->phone_number == $key['phone_number']){

                return redirect()->route('clientsCRUD.create')
                    ->with('error', 'Client with that email or phone number already exists.');

            }
        }

        $client->save();
        return redirect()->route('clients')
            ->with('success', 'Client has been added successfully.');
    }


    public function show(Client $client)
    {
        return view('clients.indexClient', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|digits:9'
        ]);

        Client::whereId($id)->update($validatedData);

        return redirect()->route('clients')
            ->with('success', 'Client Has Been updated successfully');
    }


    public function destroy($id)
    {

        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients')
            ->with('success', 'Client has been deleted successfully');
    }
}
