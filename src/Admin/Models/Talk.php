<?php namespace Blog\Admin\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;

class Talk extends Model
{
    protected $table = "talk";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'content',
        'imgsrc',
        'datetime',
    ];
}
