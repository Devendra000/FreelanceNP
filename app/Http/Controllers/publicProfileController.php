<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

use App\Models\giver;
use App\Models\receiver;
use App\Models\task;


class publicProfileController extends Controller
{
    function giverPublicProfile($id){
        $user = giver::find($id);
        return view('givers/profilePublic')->with(compact('user'));
    }
    
    function receiverPublicProfile($id){
        $user = receiver::find($id);
        return view('receivers/profilePublic')->with(compact('user'));
    }

    
}
