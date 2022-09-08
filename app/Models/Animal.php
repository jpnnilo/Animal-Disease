<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = ['name','type','breed','gender','age'];

    public function diseases(){
        return $this->belongsToMany(Disease::class);
    }
}
