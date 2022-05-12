<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyWorkEntry extends Model
{
    use HasFactory;
    public $table="daily_work_entries";
    protected $fillable=['id','entry_duration' => 'array'];
}
