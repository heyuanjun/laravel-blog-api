<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Common\Repositories\Pagination;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;

trait PageHelper
{
    /**
     * @param Builder|Model $builder
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return LengthAwarePaginator|AbstractPaginator|Paginator
     */
    public function applyPaginate($builder, $perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $url =  app('url')->current();
        $query = Request::query();
        $query = http_build_query(Arr::except($query, $pageName));
        $query && $query = '?' . $query;
        $path = $url . $query;
        return $builder->paginate($perPage, $columns, $pageName, $page)->setPath($path);
    }

    /**
     * @param Builder $builder
     * @param int $perPage
     * @param string $minKeyName
     * @param string $maxKeyName
     * @return mixed
     */
    public function pageByKey($builder, $perPage = 15, $minKeyName = 'since_id', $maxKeyName = 'to_id')
    {
        $maxId = Request::get($maxKeyName, 0);
        $sinceId = Request::get($minKeyName);
        $table = $builder->getModel()->getTable();
        $key = $builder->getModel()->getKeyName();
        if ($maxId) {
            $builder->where($table . '.' . $key, '<', $maxId);
        } else {
            if ($sinceId !== null) {
                $builder->where($table . '.' . $key, '>', $sinceId);
            }
        }

        $builder->take($perPage);
        return $builder;
    }

    public function fakePager($array, $perPage = 15, $pageName = 'page', $page = null)
    {
        if ($page < 1 || !$page) {
            $page = 1;
        }

        if ($array instanceof Arrayable) {
            $array = $array->toArray();
        }

        $items = array_slice($array, $perPage * ($page - 1), $perPage);
        $url = app('url')->current();

        $query = Request::query();
        $query = http_build_query(Arr::except($query, $pageName));
        $query && $query = '?' . $query;
        $path = $url . $query;
        return new LengthAwarePaginator($items, count($array), $perPage, $page, [
            'path'     => $path,
            'pageName' => $pageName,
        ]);
    }
}
