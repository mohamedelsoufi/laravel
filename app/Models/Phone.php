<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'phones';
    protected $fillable = ['code', 'phone', 'user_id'];
    protected $hidden = ['user_id'];


    ######### Begin relation ###########################

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    ######### End relation #############################
}
