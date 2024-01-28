<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberships extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'userid',
        'description',
        'status',
        'price',
        'starts',
        'ends',
        'limit'
    ];
}
