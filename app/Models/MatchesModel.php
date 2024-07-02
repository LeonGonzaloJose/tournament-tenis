<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchesModel extends Model
{
    use HasFactory;

    protected $table = "matches";

    protected $fillable = ['tournament_id','player_one_id','player_two_id','winner_id'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
