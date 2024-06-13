<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchDetails extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'hometeam',
        'awayteam',
        'homescore',
        'awayscore',
        'homeyellowcard',
        'homeredcard',
        'awayyellowcard',
        'awayredcard',
        'referee',
        'homescorer',
        'awayscorer',
        'datetime',
        'status',
        'location',
    ];

    protected $casts = [
        'datetime' => 'datetime', // or 'timestamp'
    ];
}
