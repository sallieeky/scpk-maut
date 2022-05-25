<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function staff()
    {
        return $this->hasMany(Staff::class, "id_departemen");
    }

    public function user()
    {
        return $this->hasMany(User::class, "id_departemen");
    }
}
