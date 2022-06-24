<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendace";
    protected $primarykey = "id";

    public function employees()
    {
        return $this->belongsToMany(User::class,'user_id','id');
    }

    public function created_at_difference()
    {
        return "hello";
        //return Carbon::parse($In_Entry)->diff( Carbon::parse($Out_Entry))->format('%H:%I:%S');
    } 
}
