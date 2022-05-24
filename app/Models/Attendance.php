<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendace";
    protected $primarykey = "id";

    public function employees()
    {
    return $this->belongsToMany(User::class);
     }
}
