<?php namespace Blog\Api\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;

class AccessMessage extends Model
{
    protected $table = "access_message";

    protected $fillable = [
        'id',
        'username',
        'name',
        'article_id',
        'Imgsrc',
        'value',
        'date',
    ];
}
