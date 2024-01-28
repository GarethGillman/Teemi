<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'userid',
        'description',
        'slug',
        'excerpt',
        'status',
        'commenting',
        'scheduled',
        'seotitle',
        'seodesc',
        'type',
        'visibility'
    ];
}
