<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Status;

class ClientController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::with('isDeleted')->paginate(20);
        return view('dashboard.client.clientList', ['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all();
        return view('dashboard.client.create', [ 'statuses' => $statuses ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name'             => 'required|unique:client',

            'financial_contact_name' =>'required|unique:client',
            'email'           => 'required|unique:client',
            'address'         => 'required',
            'billing_address'   => 'required',
            'bank_name'         => 'required',
            'account_number'  => 'required|unique:client',
            'swif_code'  => 'required|unique:client',
            'transit_number'  => 'required|unique:client',
        ], [
            'email.unique' => 'Email should be unique' ,
            'swif_code.unique' => 'Swif code should be unique' ,
            'account_number.unique' => 'Account should be unique',
            'transit_number.unique' => 'Transit Number should be unique'     ]);
        $client = new Client();
        $client->company_name   = $request->input('company_name');
        $client->financial_contact_name   = $request->input('financial_contact_name');
        $client->email   = $request->input('email');
        $client->address = $request->input('address');
        $client->billing_address = $request->input('billing_address');
        $client->bank_name = $request->input('bank_name');
        $client->account_number = $request->input('account_number');
        $client->swif_code = $request->input('swif_code');
        $client->transit_number = $request->input('transit_number');
        $client->save();
        $request->session()->flash('message', 'Successfully created client');
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Client = Client::with('user')->with('status')->find($id);
        return view('dashboard.client.clientShow', [ 'note' => $Client ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        $statuses = Status::all();
        return view('dashboard.client.edit', [ 'statuses' => $statuses, 'client' => $client ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $validatedData = $request->validate([
            'name'             => 'required',
            'email'           => 'required',
            'address'         => 'required',
            'billing_address'   => 'required',
            'bank_name'         => 'required',
            'account_number'  => 'required',
            'swif_code'  => 'required',
            'transit_number'  => 'required',
        ], [
            'name.unique' => 'Name should be unique',
            'email.unique' => 'Email should be unique' ,
            'email.swif_code' => 'Swif code should be unique' ,
            'account_number.unique' => 'Account should be unique',
            'transit_number.unique' => 'Transit Number should be unique'     ]);

        $client = Client::find($id);
        $client->name     = $request->input('name');
        $client->email   = $request->input('email');
        $client->address = $request->input('address');
        $client->billing_address = $request->input('billing_address');
        $client->bank_name = $request->input('bank_name');
        $client->account_number = $request->input('account_number');
        $client->swif_code = $request->input('swif_code');
        $client->transit_number = $request->input('transit_number');
        $client->save();
        $request->session()->flash('message', 'Successfully updated client');
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo $id;
        exit;
        Client::find($id)->delete();
        $request->session()->flash('message', 'Successfully deleted client');
        return redirect()->route('client.index');
    }
}
