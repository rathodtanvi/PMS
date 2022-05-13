<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAllotment extends Model
{
    use HasFactory;
    protected $table = "project_allotment";
    protected $primarykey = "id";
}
