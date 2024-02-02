<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    
    function receiver(){
        return $this->hasMany('App\Models\receiver','receiver_id', 'receiver_id');
    }

    function giver(){
        return $this->hasMany('App\Models\giver','giver_id','giver_id');
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 
        'urgency',
        'deadline',
        'giver_id',
        'receiver_id',
        'appliers',
        'description',
        'pod',
        'state',
        'pidx',
        'paid'
    ];

    protected $casts =[
        'appliers' => 'array',
    ];
}
