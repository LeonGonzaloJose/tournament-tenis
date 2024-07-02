<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayerStatsModel extends Model
{
    use HasFactory, SoftDeletes; 

    protected $table = "player_stats";

    protected $fillable = ['player_id','speed','strength','reflex','energy'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function player()
    {
        return $this->belongsTo(PlayerModel::class, 'player_id');
    }
}
