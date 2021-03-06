<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = "services";
    protected $fillable = ['name', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor', 'doctor_service', 'doctor_id',
            'service_id', 'id', 'id');
    }
}
