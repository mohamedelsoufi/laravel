<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = "offers";
    protected $fillable = ['name_ar', 'name_en', 'price', 'details_ar', 'details_en', 'image', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
    //public $timestamps = false;

    ####### local scopes #####################
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function scopeInvalid($query)
    {
        return $query->where('status', 0)->whereNull('details_ar');
    }

    ####### Global Scopes
    protected static function booted()
    {
        static::addGlobalScope(new OfferScope);
    }
}
