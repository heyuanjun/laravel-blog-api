<?php namespace Blog\Api\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;

class Music extends Model
{
    protected $table = "music";

    protected $fillable = [
        'id',
        'music_id',
    ];
}
