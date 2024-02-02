<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

use App\Models\giver;
use App\Models\receiver;
use App\Models\task;

class giverController extends Controller
{
    function loginGiver(){
        if(Auth::guard('givers')->check()){
            return redirect(route('homepageGiver'));
        }
        else{
            return view('givers/login_giver');
        }
    }
    
    function loginGiverPost(Request $request){
        $credentials = $request->only('email','password');

        if(Auth::guard('givers')->attempt($credentials)){
            return redirect(route('homepageGiver'));
        }
        else{
            return redirect(route('loginGiver'))->with('error','Invalid credentials. Try again');
        }
    }

    function registerGiver(){
        if(Auth::guard('givers')->check()){
            return redirect(route('homepageGiver'));
        }
        else{
            return view('givers/register_giver');
        }
    }

    function registerGiverPost(Request $request){
        
        $request->validate([
            'email'=> 'unique:givers'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        if(giver::create($data)){
            return redirect(route('loginGiver'))->with('success','Registration successful');
        }

        else{
            return redirect(route('registerGiver'))->with('error','Registration failed');
        }

    }

    function homepageGiver(){
        return view('givers/homepage_giver');
    }

    function profileGiver(){
        $users = giver::find(Auth::guard('givers')->user()->giver_id);
        $user = compact('users');
        return view('givers/profile_giver')->with($user);
    }

    function showReceivers(){
        $search = '';
        $receivers = receiver::paginate('15');
        $receiversData = compact('receivers','search');
        return view('givers/receivers_data')->with($receiversData);
    }

    function searchReceivers(Request $request){
        $search = $request->input('searchReceiver') ?? '';
        if($search != ''){
            $receivers = receiver::where('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->paginate(15);
            $receiversData = compact('receivers','search');
            return view('givers/receivers_data')->with($receiversData);
        }
        else{
            return redirect(route('showReceivers'))->with('error','Search with Name or Email');
        }
    }

    function uploadGiver(Request $request){
        
        $name = date("Y-m-d",time()).'-'.time().'-givers-'.$request->file('file')->getClientOriginalName();

        $request->file('file')->storeAs('/public/givers', $name);

        $user = giver::find(Auth::guard('givers')->user()->giver_id);
        $user['images'] = $name;

        if($user->save()){
            return redirect()->back()->with('success','Successfully uploaded');
        }
        else{
            return redirect()->back()->with('error','Could not upload picture');
        }


    }

    function updateGiver(Request $request){
        $user = giver::find(Auth::guard('givers')->user()->giver_id);
        
        if($request->email != $user->email){
            $v = \Validator::make(['email' => $request->email],[
                'email' => 'unique:givers',
            ]);
            if($v->fails()){
                return redirect(route('profileGiver'))->with('error',$v->errors());
            }
            
        }
        $user->email = $request->input('email') ?? $user->email;
        $user->name = $request->input('name') ?? $user->name;  
        $user->save();

        return redirect(route('homepageGiver'))->with('success','Successfully updated');
    }

    function uploadProject(){
        return view('/givers/projectUpload');
    }

    function uploadProjectPost(Request $request){

        $data['name'] = $request->projectName;
        $data['giver_id'] = Auth::guard('givers')->user()->giver_id;
        $data['deadline'] = $request->deadline;
        $data['description'] = $request->description;
        $data['urgency']  = $request->urgency;
        $data['pod'] = $request->pod;

        if(task::create($data)){
            return redirect()->back()->with('success','Successfully listed task');
        }
        else{
            return redirect()->back()->with('error','Could not upload task. Try again');
        }
    }

    function myProjects(){
        $user = Auth::guard('givers')->user()->giver_id;
        $tasks = task::with('giver')->where('giver_id','=',$user)->get();
        $data = compact('tasks');
        return view('/givers/myProjects')->with($data);
    }

    function acceptApplier($task_id, $applier_id){
        $task = task::find($task_id);
        $task->receiver_id = $applier_id;
        $task->state = 1;
        $task->appliers = [];
        $task->save();
        return redirect()->back()->with('success','Accepted successfully');
    }

    function findReceivers(){
        return view('givers/receivers_data');
    }

    function completedProjects(){
        $tasks = task::where('giver_id','=',Auth::guard('givers')->user()->giver_id)->where('state','=',2)->get();
        return view('givers/completedProjects')->with(compact('tasks'));
    }
    
    function paidProjects(){

    }

    function logoutGiver(){
        $user = giver::find(Auth::guard('givers')->user()->giver_id);
        $user->status = 0;
        $user->save();
        Auth::guard('givers')->logout();
        return redirect(route('loginGiver'))->with('success','Successfully logged out');
    }

}
