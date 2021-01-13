<?php namespace Blog\Api\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;

class LeaveMessage extends Model
{
    protected $table = "leave_message";

    public $timestamps = false;

    protected $fillable = [
        'id',
        'username',
        'name',
        'Imgsrc',
        'value',
        'date',
    ];
}
