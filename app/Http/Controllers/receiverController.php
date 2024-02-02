<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\giver;
use App\Models\receiver;
use App\Models\task;

use Illuminate\Http\Request;

class receiverController extends Controller
{
    function loginReceiver(){
        if(Auth::guard('receivers')->check()){
            return redirect(route('homepageReceiver'));
        }
        else{
            return view('receivers/login_receiver');
        }
    }

    function loginReceiverPost(Request $request){
        $credentials = $request->only('email','password');

        if(Auth::guard('receivers')->attempt($credentials)){
            return redirect(route('homepageReceiver'));
        }
        else{
            return redirect(route('loginReceiver'))->with('error','Invalid credentials. Try again');
        }
    }
    
    function registerReceiver(){
        if(Auth::guard('receivers')->check()){
            return redirect(route('homepageReceiver'));
        }
        else{
            return view('receivers/register_receiver');
        }
    }
    
    function registerReceiverPost(Request $request){
        
        $request->validate([
            'email'=> 'unique:receivers'
        ]);

        $receiverData = new receiver;
        $receiverData->name = $request['name'];
        $receiverData->email = $request['email'];
        $receiverData->password = Hash::make($request['password']);
        $saveSuccess = $receiverData->save();

        if($saveSuccess){
            return redirect(route('loginReceiver'))->with('success','Registration successful as a RECEIVER');
        }

        else{
            return redirect(route('registerReceiver'))->with('error','Registration failed');
        }

    }

    function homepageReceiver(){
        $currentUserId = Auth::guard('receivers')->user()->receiver_id;
        $tasks = task::with('receiver')->where('receiver_id','=',null)->whereRaw("NOT JSON_CONTAINS(appliers, '[$currentUserId]')")->get();
        $task = compact('tasks');
        return view('receivers/homepage_receiver')->with($task);
    }

    function profileReceiver(){
        return view('receivers/profile_receiver');
    }

    function updateReceiver(Request $request){
        $user = receiver::find(Auth::guard('receivers')->user()->receiver_id);
        if($request->input('email') != $user->email){
            $request->validate([
                'email'=> 'unique:receivers'
            ]);
            $user->name = $request->input('name') ?? $user->name; 
            $user->email = $request->input('email') ?? $user->email; 
            $user->save();
        }
        else{
            $user->name = $request->input('name') ?? $user->name; 
            $user->save();
        }
        return redirect(route('homepageReceiver'))->with('success','Successfully updated');
    }

    function uploadReceiver(Request $request){
        
        $name = date("Y-m-d",time()).'-'.time().'-receiver-'.$request->file('file')->getClientOriginalName();

        $request->file('file')->storeAs('public/receivers', $name);

        $user = receiver::find(Auth::guard('receivers')->user()->receiver_id);
        $user['images'] = $name;
        $user->save();

        return redirect()->back()->with('success','Successfully uploaded');
    }

    function showGivers(){
        $givers = giver::paginate(15);
        $search = '';
        $giversData = compact('givers','search');
        return view('receivers/giver_data')->with($giversData);
    }

    function searchGivers(Request $request){
        $search = $request['searchGiver'] ?? '';

        if($search != ''){
            $givers = giver::where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->paginate('15');
        }
        else{ 
            return redirect(route('showGivers'))->with('error','Search by name or email or status');
        }
        return view('receivers/giver_data')->with(compact('givers','search'));
    }

    function viewProject(){
        $currentUserId = Auth::guard('receivers')->user()->receiver_id;
        $tasks = task::with('receiver')->where('receiver_id','=',null)->whereRaw("NOT JSON_CONTAINS(appliers, '[$currentUserId]')")->orderBy('created_at','desc')->paginate(5);
        $task = compact('tasks');
        return view('receivers/projectList')->with($task);
    }

    function apply($task_id){
        $task = task::find($task_id);
        if($task->state == 0){
            if($task->appliers === null){
                $task->appliers = [];
            }
            $task->appliers = array_unique(array_merge($task->appliers, [Auth::guard('receivers')->user()->receiver_id]));
            $task->save();
            return redirect()->back()->with('success','Successfully applied');
        }
        else{
            return redirect()->back()->with('error','Job is not available anymore');
        }
    }
    
    function receiverApplied(){
        $tasks = task::all();
        $applieds = [];
        $appliedTasks = [];
        foreach($tasks as $task){
            $applied = array_search(Auth::guard('receivers')->user()->receiver_id,$task->appliers);
            
            for($i=0; $i<$tasks->count(); $i++ ){
                if($applied === $i){
                    $applieds=array_merge($applieds,[$task->task_id]);
                }
            }
        }

        foreach($applieds as $applied){
            $appliedTasks = array_merge($appliedTasks,[task::find($applied)]); 
        }

        return view('receivers\applied')->with(compact('appliedTasks'));
        
    }

    function receiverProject(){
        $tasks = task::where('receiver_id','=',Auth::guard('receivers')->user()->receiver_id)->get();
        $task = compact('tasks');
        return view('receivers/myProject')->with($task);
    }

    function projectComplete($id){
        $task = task::find($id);
        $task->completed_at = now('GMT+5:45');
        $task->state = 2;
        $task->save();
        return redirect()->back();
    }

    function logoutReceiver(){
        $user = receiver::find(Auth::guard('receivers')->user()->receiver_id);
        $user->status = 0;
        $user->save();
        Auth::guard('receivers')->logout();
        return redirect(route('loginReceiver'))->with('success','Successfully logged out');
    }
}
