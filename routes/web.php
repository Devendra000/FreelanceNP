<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\giverController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\receiverController;
use App\Http\Controllers\publicProfileController;
use App\Http\Controllers\paymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function(){
    return redirect(route('loginGiver'));
});

Route::group(["prefix"=>"giver"],function(){
    Route::get('/login',[giverController::class,'loginGiver'])->name('loginGiver');
    Route::post('/login',[giverController::class,'loginGiverPost'])->name('loginGiver.post');

    Route::get('/register',[giverController::class,'registerGiver'])->name('registerGiver');
    Route::post('/register',[giverController::class,'registerGiverPost'])->name('registerGiver.post');

    //Accessible by givers only
    Route::group(["middleware"=>"isGiver"],function(){
        
        Route::get('/uploadProject',[giverController::class, 'uploadProject'])->name('uploadProject');
        Route::post('/uploadProject',[giverController::class, 'uploadProjectPost'])->name('uploadProjectPost');

        Route::get('/homepage',[giverController::class,'homepageGiver'])->name('homepageGiver');

        Route::get('/profile',[giverController::class,'profileGiver'])->name('profileGiver');
        Route::post('/update',[giverController::class, 'updateGiver'])->name('updateGiver');
        Route::post('/upload',[giverController::class, 'uploadGiver'])->name('uploadGiver');
        
        Route::get('/showReceivers', [giverController::class,'showReceivers'])->name('showReceivers');
        Route::get('/searchReceivers', [giverController::class,'searchReceivers'])->name('searchReceiversGiver');

        Route::get('/acceptApplier/{task_id}/{applier_id}',[giverController::class, 'acceptApplier'])->name('acceptApplier');

        Route::get('/myProjects', [giverController::class,'myProjects'])->name('myProjects');

        Route::get('/completed', [giverController::class,'completedProjects'])->name('completedProjects');
        Route::get('/completed/paid', [giverController::class,'paidProjects'])->name('paidProjects');

        Route::get('/pay/{id}/{user_id}', [paymentController::class,'openKhalti'])->name('pay');
        Route::get('/success', [paymentController::class,'verify'])->name('success');

        Route::get('/logout', [giverController::class,'logoutGiver'])->name('logoutGiver');
        
    });
});

Route::group(['prefix'=>'/receiver'], function(){

    Route::get('/login',[receiverController::class,'loginReceiver'])->name('loginReceiver');
    Route::post('/login',[receiverController::class,'loginReceiverPost'])->name('loginReceiver.post');
    
    Route::get('/register',[receiverController::class,'registerReceiver'])->name('registerReceiver');
    Route::post('/register',[receiverController::class,'registerReceiverPost'])->name('registerReceiver.post');

    //Accessible by receivers only
    Route::group(['middleware' => 'isReceiver'], function(){
        Route::get('/homepage',[receiverController::class,'homepageReceiver'])->name('homepageReceiver');

        Route::get('/profile',[receiverController::class,'profileReceiver'])->name('profileReceiver');
        Route::post('/update',[receiverController::class, 'updateReceiver'])->name('updateReceiver');
        Route::post('/upload',[receiverController::class, 'uploadReceiver'])->name('uploadReceiver');

        Route::get('/showGivers',[receiverController::class, 'showGivers'])->name('showGivers');
        Route::get('/searchGivers', [receiverController::class,'searchGivers'])->name('searchGiversReceiver');

        Route::get('/viewProject',[receiverController::class,'viewProject'])->name('viewProject');
        Route::get('/apply/{task_id}',[receiverController::class,'apply'])->name('apply');

        Route::get('/myProjects', [receiverController::class,'receiverProject'])->name('receiverProject');
        Route::get('/applied', [receiverController::class,'receiverApplied'])->name('receiverApplied');
        
        Route::get('/completeProject/{id}',[receiverController::class, 'projectComplete'])->name('projectComplete');

        Route::get('/logout', [receiverController::class,'logoutReceiver'])->name('logoutReceiver');
    });

    
});
//Redirects without giving error message using middleware 'giver', multiple routes can be grouped together to get through "giver" middleware where user login is checked, if user is valid, only then the routes inside this function are accessed, else redirected to the '/' route

// Route::group(["middleware"=>"giver"],function(){
    
//     Route::get('/profile',[giverController::class,' profile'])->name('profile');

// });

Route::get('/popup', function(){
    return view('popup');
});

Route::get('/giverPublicProfile/{id}',[publicProfileController::class, 'giverPublicProfile'])->name('giverPublicProfile');

Route::get('/receiverPublicProfile/{id}',[publicProfileController::class, 'receiverPublicProfile'])->name('receiverPublicProfile');

Route::group(['prefix' => '/admin'], function(){
    Route::get('/',[adminController::class, 'showGiversAdmin']);
    Route::get('/showGivers',[adminController::class, 'showGiversAdmin'])->name('showGiversAdmin');
    Route::get('/showReceivers',[adminController::class, 'showReceiversAdmin'])->name('showReceiversAdmin');

    Route::get('/addGiver',[adminController::class, 'addGiver'])->name('addGivers');
    Route::get('/addReceiver',[adminController::class, 'addReceiver'])->name('addReceivers');

    Route::get('/searchGiver',[adminController::class, 'searchGiver'])->name('searchGiverByAdmin');
    Route::get('/searchReceiver',[adminController::class, 'searchReceiver'])->name('searchReceiverByAdmin');

    Route::get('/activeGivers',[adminController::class, 'activeGivers'])->name('activeGivers');
    Route::get('/activeReceivers',[adminController::class, 'activeReceivers'])->name('activeReceivers');


    Route::get('/viewTrash/search',[adminController::class, 'trashSearch'])->name('trashSearchByAdmin');
    
    Route::get('/trashGiver/{id}',[adminController::class, 'trashGiver'])->name('trashGiver');
    Route::get('/trashReceiver/{id}',[adminController::class, 'trashReceiver'])->name('trashReceiver');
    
    Route::get('/viewTrash',[adminController::class, 'viewTrash'])->name('viewTrash');

    Route::get('/restoreGiver/{id}',[adminController::class, 'restoreGiver'])->name('restoreGiver');
    Route::get('/restoreReceiver/{id}',[adminController::class, 'restoreReceiver'])->name('restoreReceiver');
    
    Route::get('/deleteGiver/{id}',[adminController::class, 'deleteGiverForce'])->name('deleteGiver');
    Route::get('/deleteReceiver/{id}',[adminController::class, 'deleteReceiverForce'])->name('deleteReceiver');
    
});
