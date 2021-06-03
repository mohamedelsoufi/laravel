<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'hospitals';
    protected $fillable = ['name', 'title', 'hospital_id', 'created_at', 'updated_at'];
    protected $hidden = ['hospital_id', 'created_at', 'updated_at'];


    ######### Begin relation ###########################

    public function hospital()
    {
        return $this->belongsTo('App\Models\Hospital', 'hospital_id', 'id');
    }
    ######### End relation #############################
}
