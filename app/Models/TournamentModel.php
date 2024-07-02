<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property int $participants
 * @property string $sex
 * @property int $winner
 */
class TournamentModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tournaments";

    protected $fillable = ['name','participants','sex','winner','created_at'];

    protected $hidden = ['updated_at', 'deleted_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

}
