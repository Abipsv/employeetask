<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class ClientController
{
    //
    public function clients(){
        return view('backend.out-client.clients');
    }
    public function clientsProfile(){
        return view('backend.out-client.client-profile');
    }

}
