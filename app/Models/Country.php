<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'countries';
    protected $fillable = ['name'];

    public function doctors()
    {
        return $this->hasManyThrough('App\Models\Doctor', 'App\Models\Hospital', 'country_id',
            'hospital_id', 'id', 'id');
    }

    public function hospitals()
    {
        return $this->hasMany('App\Models\Hospital', 'country_id', 'id');
    }
}
