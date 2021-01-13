<?php namespace Blog\Api\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;

class Article extends Model
{
    protected $table = "article";

    protected $fillable = [
        'id',
        'article_categroy',
        'article_brief',
        'article_img',
        'accessPulish_count',
        'visited',
        'like_Star',
        'label',
        'content',
        'title',
        'time',
        'article_id',
    ];
}
