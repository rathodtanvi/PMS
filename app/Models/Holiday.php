<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    public $table = 'holidays';
    protected $fillable=['id','name','start_date','end_date'];
}
