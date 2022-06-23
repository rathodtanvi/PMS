<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyWorkEntry extends Model
{
    use HasFactory;
    public $table="daily_work_entries";
    protected $fillable=['id','project_id','entry_duration' => 'array'];

    public function project()
    {
         return $this->belongsTo(Project::class,'project_id','id');
    }
    
    public function allotment()
    {
         return $this->hasMany(ProjectAllotment::class);
    }
    
    public function user(){
     return $this->belongsTo(User::class, 'user_id');  
    }
}
