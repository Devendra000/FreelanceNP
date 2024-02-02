<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\giver;
use App\Models\receiver;

class adminController extends Controller
{    
    function adminEdit(){
        return redirect(route('showGiversAdmin'));
    }

    function showReceiversAdmin(){
        $search = '';
        $receivers = receiver::paginate('15');
        $Data = compact('receivers','search'); 
        return view('admin/receivers')->with($Data);
    }

    function showGiversAdmin(){
        $search = '';
        $givers = giver::paginate('15');
        $Data = compact('givers','search'); 
        return view('admin/givers')->with($Data);
    }

    function activeReceivers(){
        $search = '';
        $receivers = receiver::where('status','=',1)->paginate('15');
        $Data = compact('receivers','search'); 
        return view('admin/receivers')->with($Data);
    }

    function activeGivers(){
        $search = '';
        $givers = giver::where('status','=',1)->paginate('15');
        $Data = compact('givers','search'); 
        return view('admin/givers')->with($Data);
    }

    function addGiver(Request $request){
        return view('register_giver');
    }

    function addReceiver(Request $request){
        return view('register_receiver');
    }

    function searchGiver(Request $request){
        $search = $request['searchGiver'] ?? '';

        if($search != ''){
            $givers = giver::where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->paginate('15');
        }
        else{
            return redirect(route('showGiversAdmin'))->with('error','Search by name or email');
        }
        $Data = compact('givers','search');
            return view('admin/givers')->with($Data);
    }

    function searchReceiver(Request $request){
        $search = $request['search'] ?? '';

        if($search != ''){
            $receivers = receiver::where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->paginate('15');
        }
        else{
            return redirect(route('showReceiversAdmin'))->with('error','Search by name or email or status');
        }
        $Data = compact('receivers','search');
            return view('admin/receivers')->with($Data);
    }

    function trashSearch(Request $request){
        $search = $request['search'] ?? '';

        if($search != ''){
            $givers = giver::onlyTrashed()->where('name','like','%'.$search.'%')->get();
            $receivers = receiver::onlyTrashed()->where('name','like','%'.$search.'%')->get();
        }
        else{
            return redirect(route('viewTrash'))->with('error','Search by name');
        }
        $Data = compact('givers','receivers','search');
            return view('admin/trash')->with($Data);
    }

    function trashGiver($id){
        $giver = giver::find($id)->delete();
        if($giver){
            return redirect()->back()->with('success','Deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Could not delete');
        }
    }

    function trashReceiver($id){
        $receiver = receiver::find($id)->delete();
        if($receiver){
            return redirect()->back()->with('success','Deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Could not delete');
        }
    }

    function viewTrash(){
        $givers = giver::onlyTrashed()->get();
        $receivers = receiver::onlyTrashed()->get();
        $search = '';
        $Data = compact('givers','receivers','search');
        return  view('admin/trash')->with($Data);
    }

    function restoreGiver($id){
        $givers = giver::withTrashed()->find($id);
        if($givers){
            $givers->restore();
            return redirect()->back()->with('success','Restored Successfully');
        }
        return redirect()->back()->with('error','Could not find the giver') ;
    }

    function restoreReceiver($id){
        $receivers = receiver::withTrashed()->find($id);
        if($receivers){
            $receivers->restore();
            return redirect()->back()->with('success','Restored Successfully');
        }
        return redirect()->back()->with('error','Could not find the receiver') ;

    }

    function deleteGiverForce($id){
        $giver = giver::withTrashed()->find($id);
        if($giver){
            $giver->forceDelete();
            return redirect()->back()->with('error','Deleted giver permanently');
        }
        return redirect()->back()->with('error','Could not find the giver');
    }

    function deleteReceiverForce($id){
        $receiver = receiver::withTrashed()->find($id);
        if($receiver){
            $receiver->forceDelete();
            return redirect()->back()->with('error','Deleted receiver permanently');
        }
        return redirect()->back()->with('error','Could not find the receiver');
    }
}
