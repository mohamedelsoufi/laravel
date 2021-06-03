<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospitals extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'hospitals';
    protected $fillable = ['name', 'address', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];


    ######### Begin relation ###########################

    public function doctor()
    {
        return $this->hasMany('App\Models\Doctor', 'hospital_id', 'id');
    }
    ######### End relation #############################
}
