<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'medicals';
    protected $fillable = ['pdf', 'pateint_id'];
}
