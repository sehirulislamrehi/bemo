<?php

namespace App\Models\UserModule;

use App\Models\ProductModule\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Visitor extends Authenticatable
{
    protected $guard = 'customer';

    use HasFactory;

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function visitor_type(){
        return $this->belongsTo(VisitorType::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function visitor_package(){
        return $this->hasMany(VisitorPackage::class);
    }
}
