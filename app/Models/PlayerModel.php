<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property int $age
 * @property string $sex
 * @property string $status
 * @property int $level
 */
class PlayerModel extends Model
{
    use HasFactory, SoftDeletes; 

    protected $table = "players";

    protected $fillable = ['name','age','sex','status','level'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function stats()
    {
        return $this->hasOne(PlayerStatsModel::class, 'player_id');
    }
}
