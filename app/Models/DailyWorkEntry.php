<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyWorkEntry extends Model
{
    use HasFactory;
    public $table="daily_work_entries";
    protected $fillable=['id','project_id', "user_id" , "entry_date" ,'entry_duration' => 'array' , "productive" , "work_type" ,"description"];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }
    
    public function allotment()
    {
        return $this->hasMany(ProjectAllotment::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  
    }
    /*public function technology()
    {
        return $this->belongsTo(Technology::class,'technology_id','id');  
    }*/
}
