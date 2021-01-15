<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Common\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param $filters
     * @param array $others
     * @param \Closure|null $then
     */
    public function applyFilters($builder, $filters, $others = [] , \Closure $then = null)
    {
        if (is_array($filters)) {
            $model = $builder->getModel();
            $searchables = $model->getFillable();

            $searchables = array_merge($others, $searchables);

            $table = $model->getTable();
            $builder->where(function ($query) use ($filters,$searchables,$table, $then) {
                foreach ($filters as $key => $value) {
                    list($key, $op) = $this->parseFilterKey($key);
                    if ($op == 'like') {
                        $value = \DB::raw("'%{$value}%'");
                    }
                    if (in_array($key, $searchables)){
                        /** @var Builder $query */
                        $column = $key;
                        if (strpos($key, '.') === false) {
                            $column = $table . '.' . $key;
                        }

                        $query->where($column, $op, $value);
                    } else {
                        $then && $then($query, $key, $value, $op);
                    }
                }
            });

        }
    }

    protected function parseFilterKey($key)
    {
        $partials = explode(',', $key);


        return [Arr::get($partials, 0), Arr::get($partials, 1, 'like')];
    }
}
