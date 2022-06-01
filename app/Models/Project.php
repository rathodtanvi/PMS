<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = "project";
    protected $primarykey = "id";

    public function technology(){
        return $this->belongsTo(Technology::class, 'technology_id'); 
        
    }
}
