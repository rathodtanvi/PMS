<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public $table = 'rating';
    protected $fillable=['id','user_id','task_id','star_rated'];
}
