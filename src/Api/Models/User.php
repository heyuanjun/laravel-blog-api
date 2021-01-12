<?php namespace Blog\Api\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;

class User extends Model
{
    protected $table = "user";

    protected $fillable = [
        'name',
        'username',
        'password',
        'email',
        'info',
        'uploadimg',
        'registerTime',
    ];
}
