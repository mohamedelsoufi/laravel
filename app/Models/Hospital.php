<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    //public $timestamps = true;
    protected $table = 'hospitals';
    protected $fillable = ['name', 'address', 'country_id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];


    ######### Begin relation ###########################

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor', 'hospital_id', 'id');
    }

    public function countries()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }
    ######### End relation #############################
}
