<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Client;
use App\ClientAddress;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

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
     * Show the client list.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clientList()
    {
        if (!Gate::allows('clients_list')) {
            return abort(403);
        }
        
        $clients = DB::table('clients')->paginate(30);

        $data = [
            'clients' => $clients,
        ];

        return view('admin.clients.list')->with($data);
    }
    
    /**
     * Add new client.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addClient(Request $request)
    {
        if (!Gate::allows('clients_add')) {
            return abort(403);
        }
        
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'email' => ['sometimes', 'nullable', 'email'],
                'nip' => ['required', 'numeric', 'digits:10'],
                'regon' => ['required', 'numeric', 'digits:9'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                $client = Client::create([
                    'name' => Input::get('name'),
                    'nip' => Input::get('nip'),
                    'regon' => Input::get('regon'),
                    'email' => Input::get('email'),
                    'phone' => Input::get('phone'),
                ]);
                
                $client_address = ClientAddress::create([
                    'street' => Input::get('street'),
                    'city' => Input::get('city'),
                    'house' => Input::get('house'),
                    'flat' => Input::get('flat'),
                    'zip' => Input::get('zip'),
                    'id_client' => $client->id,
                ]);
                
                Storage::disk('local')->makeDirectory('clients/client_'. $client->id);

                // redirect
                return Redirect::to(route('admin.clients'));
            }
        }

        return view('admin.clients.add');
    }
    
    /**
     * Edit client.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function editClient($id, Request $request)
    {
        if (!Gate::allows('clients_edit')) {
            return abort(403);
        }
        
        $client = Client::find($id);
        $client_address = ClientAddress::where('id_client', '=', $id)->firstOrFail();
        
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'email' => ['email'],
                'nip' => ['required', 'numeric', 'digits:10'],
                'regon' => ['required', 'numeric', 'digits:9'],
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return Redirect::back()->withErrors($errors)->withInput();
            } else {
                //client save
                $client->name = Input::get('name');
                $client->nip = Input::get('nip');
                $client->regon = Input::get('regon');
                $client->save();
                
                //client address save
                $client_address->street = Input::get('street');
                $client_address->city = Input::get('city');
                $client_address->house = Input::get('house');
                $client_address->flat = Input::get('flat');
                $client_address->zip = Input::get('zip');
                $client_address->save();
                
                // redirect
                $request->session()->flash('status', 'Zaktualizowano pomyślnie!');
            }
        }
        
        $data = [
            'client' => $client,
            'client_address' => $client_address,
        ];

        return view('admin.clients.edit')->with($data);
    }
    
    /**
     * Delete client.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteClient(Request $request)
    {
        if (!Gate::allows('clients_delete')) {
            return abort(403);
        }
        
        $success = false;

        if ($request->isMethod('get')) {
            $id = $request->query('id');
            $client = Client::find($id);
            $result = $client->delete();

            if ($result) {
                $success = true;
            }
        }

        return json_encode($success);
    }
}
