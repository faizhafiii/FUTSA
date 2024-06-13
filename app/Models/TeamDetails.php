<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamDetails extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
        'squad',
        'win',
        'draw',
        'lose',
        'goalfor',
        'goalagainst',
        'status',
        'owner_id',
    ];

    // protected $casts = [
    //     'squad' => 'array',
    // ];
}
