<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pateints';
    protected $fillable = ['name', 'age', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    // has one through relation

    public function doctors()
    {
        return $this->hasOneThrough('App\Models\Doctor', 'App\Models\Medical', 'pateint_id',
            'medical_id', 'id', 'id');
    }
}
