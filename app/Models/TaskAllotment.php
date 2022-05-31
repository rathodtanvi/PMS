<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskAllotment extends Model
{
    use HasFactory;
    protected $table = "task_allotment";
    protected $fillable=['id','user_id','project_id','title','days_txt','hours_txt','created_at','updated_at' ];
    public function project()
    {
         return $this->belongsTo(ProjectAllotment::class,'project_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id'); 
        
    }
}
