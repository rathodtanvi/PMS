<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;
    protected $table = "technology";
    protected $primarykey = "id";

    protected $fillable = [ 'technology_name', ];

    
    public function projectallotment()
    {
        return $this->hasMany(ProjectAllotment::class,'technology_id');
    }
}
