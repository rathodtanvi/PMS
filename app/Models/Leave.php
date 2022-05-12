<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    public $table = 'leaves';
    protected $fillable=['id','user_id','leave_type','half_leave_type','subject','date_start','date_end','leave_status',
        'message','approve','created_at' ];

        public function users()
        {
           return $this->belongsTo(User::class,'user_id','id');
        }
}
