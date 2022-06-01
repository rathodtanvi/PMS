<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;
    protected $table = "project";
    protected $primarykey = "id";
    protected $fillable=['id','project_id','user_id','technology_name','complete_project','created_at','updated_at' ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id'); 
        
    }
}
