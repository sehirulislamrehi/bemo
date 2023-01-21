<?php

namespace App\Models\UserModule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorBoard extends Model
{
    use HasFactory;

    public function card(){
        return $this->hasMany(VisitorBoardCard::class)->orderBy("position","asc");
    }

    public function visitor(){
        return $this->belongsTo(Visitor::class);
    }
}
