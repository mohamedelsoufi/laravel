<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    //public $timestamps = true;
    protected $table = 'doctors';
    protected $fillable = ['name', 'title', 'hospital_id', 'created_at', 'updated_at', 'gender'];
    protected $hidden = ['created_at', 'updated_at'];


    ######### Begin relation ###########################

    public function hospital()
    {
        return $this->belongsTo('App\Models\Hospital', 'hospital_id', 'id');
    }
    ######### End relation #############################
}
