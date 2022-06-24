<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAllotment extends Model
{
    use HasFactory;
    protected $table = "project_allotment";
    protected $primarykey = "id";

    public function user(){
        return $this->belongsTo(User::class, 'user_id'); 
        
    }
    public function project(){
        return $this->belongsTo(Project::class, 'project_id'); 
        
    }
    public function technology(){
        return $this->belongsTo(Technology::class, 'technology_id');   
    }
    public function dailywork(){
        return $this->belongsTo(DailyWorkEntry::class);   
    }

}
