<?php namespace Blog\Api\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;

class Admin extends Model
{
    protected $table = "admin";

    protected $fillable = [
        'id',
        'username',
        'password',
    ];
}
