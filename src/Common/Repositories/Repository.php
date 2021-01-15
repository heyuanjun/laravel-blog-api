<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Common\Repositories;

use Blog\Common\Helpers\Filterable;
use Blog\Common\PipelineQuery;
use Blog\Common\Repositories\Pagination\PageHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;

class Repository
{
    use PageHelper, Filterable;

    public function getSearchAbleData($model, array $search = [], \Closure $closure = null, \Closure $trans = null)
    {
        $filterKey = $this->getFilterKey();
        $sortKey = $this->getSortKey();
        $pageSizeKey = $this->getPageSizeKey();

        $data = Request::only([
            $filterKey,
            $sortKey,
            $pageSizeKey
        ]);

        $data = array_merge([
            $filterKey => '',
            $sortKey => '',
            $pageSizeKey => $this->getDefaultPageSize()
        ], $data);
        [
            $filter,
            $order,
            $pageSize
        ] = array_values($data);
        $builder = $this->getSearchableBuilder($model, $search, $closure, $order, $filter);

        $pager = $this->applyPaginate($builder, $pageSize);
        if ($trans) {
            $pager->setCollection($trans($pager->getCollection()));
        }

        return $pager;
    }

    protected function getDefaultPageSize()
    {
        return 15;
    }

    protected function getFilterKey()
    {
        return 'filter';
    }


    protected function getSortKey()
    {
        return 'sort';
    }

    protected function getPageSizeKey()
    {
        return 'per_page';
    }

    /**
     * @param $model
     * @param array $search
     * @param \Closure $closure
     * @param $order
     * @param $filter
     * @return Builder
     */
    public function getSearchableBuilder($model, array $search = [], \Closure $closure = null, $order = '', $filter = '')
    {
        $modelInstance = $this->getModelInstance($model);
        if ($model instanceof Builder) {
            $builder = $model;
        } else {
            $builder = $modelInstance->newQuery();
        }

        $table = $modelInstance->getTable();
        $this->resolveSort($modelInstance, $order, $builder, $closure);
        if ($filter && $search) {
            $builder->where(function ($builder) use ($search, $filter, $table) {
                foreach ((array)$search as $column) {
                    /** @var Builder $builder */

                    $key = $column;
                    if (strpos($column, '.') === false) {
                        $key = $table . '.' . $column;
                    }

                    $builder->orWhere($key, 'like binary', "%{$filter}%");
                }
            });
        }
        return $builder;
    }

    /**
     * @param $model
     * @return Model
     * @throws \UnexpectedValueException
     */
    protected function getModelInstance($model)
    {
        if (!is_object($model)) {
            $model = app($model);
        }

        if ($model instanceof Builder) {
            return $model->getModel();
        }

        if (!$model instanceof Model) {
            throw new \UnexpectedValueException(__METHOD__ . ' expects parameter 1 to be an object of ' . Model::class . ',' . get_class($model) . ' given');
        }
        return $model;
    }

    /**
     * @param Model $model
     * @param \Closure $closure
     * @param $order
     * @param Builder $builder
     * @return mixed
     */
    public function resolveSort($model, $order, $builder, \Closure $closure = null)
    {
        $orderArr = explode('|', $order, 2);
        $table = $model->getTable();
        $key = $model->getKeyName();
        $by = Arr::get($orderArr, 0);
        $direction = Arr::get($orderArr, 1);
        [
            $o,
            $d
        ] = [
            $by ?: $table . '.' . $key,
            $direction ?: 'desc'
        ];
        if ($closure) {
            $closure($builder);
        }
        if ($by) {
            $builder->getQuery()->orders = [];
            $builder->orderBy($o, $d);
        } else if (!$builder->getQuery()->orders) {
            $builder->orderBy($o, $d);
        }

        return $builder;
    }

    public function pipeline($model, $pipeline, callable $first = null)
    {
        $instance = $this->getModelInstance($model);
        $p = new PipelineQuery($instance);

        return $p->query($pipeline, $first);
    }
}
