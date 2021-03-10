<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Client;
use App\Models\Status;

class ProjectController extends Controller
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
        $projects = Project::join('client', 'project.client_id', '=', 'client.id')
        ->select('project.*',  'client.financial_contact_name')->paginate(20);
        return view('dashboard.project.projectList', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients =Client::with('isDeleted')->paginate(20);
        return view('dashboard.project.create', ["clients" =>$clients]);
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
            'project_name'   => 'required|unique:project',
            'client_id'      => 'required',
            'terms_net'      => 'required',
            'due_date'       => 'required',
            'complete'       => 'required',
            'cpi'            => 'required',
        ], [
            'name.unique' => 'Name should be unique',
        ]);
        $project = new Project();
        $latestproject = Project::orderBy('created_at','DESC')->first();
        if($latestproject) {
        $project->po_number= str_pad($latestproject->id + 1, 8, "0", STR_PAD_LEFT);
        }
        else{
            $project->po_number= str_pad( 1, 8, "0", STR_PAD_LEFT);
        }
        $project->project_name  = $request->input('project_name');
        $project->client_id  = $request->input('client_id');
        $project->terms_net  = $request->input('terms_net');
        $project->due_date  = $request->input('due_date');
        $project->complete  = $request->input('complete');
        $project->cpi  = $request->input('cpi');
        $project->save();
        $request->session()->flash('message', 'Successfully created Project');
        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::with('user')->with('status')->find($id);
        return view('dashboard.project.projectShow', [ 'project' => $project ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $statuses = Status::all();
        return view('dashboard.project.edit', [ 'statuses' => $statuses, 'project' => $project ]);
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
        Client::find($id)->delete();
        $request->session()->flash('message', 'Successfully deleted client');
        return redirect()->route('client.index');
    }
}
