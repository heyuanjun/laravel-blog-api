<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Common\Repositories\Pagination;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class LazyHolder extends LengthAwarePaginator
{
    /**
     * @var Builder
     */
    protected $builder = null;
    protected $columns = ['*'];
    protected $countColumns = ['*'];

    public function setBuilder(Builder $builder)
    {
        $this->builder = $builder;

        return $this;
    }

    public function countFrom($columns = ['*'])
    {
        if (is_string($columns)) {
            $columns = [$columns];
        }

        $this->countColumns = $columns;

        return $this;
    }

    public function toArray()
    {
        if (!is_null($this->builder)) {
            $total = $this->builder->toBase()->getCountForPagination($this->countColumns);
            $this->total = $total;
            $results = $total
                ? $this->builder->forPage($this->currentPage(), $this->perPage())->get($this->columns)
                : $this->builder->getModel()->newCollection();

            $this->items = $results;
        }
        return parent::toArray();
    }

    public function getCollection()
    {
        return parent::getCollection();
    }

    /**
     * @param Builder $builder
     * @param null $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return LazyHolder
     */
    public static function fromBuilder(Builder $builder, $perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);

        $pager = new static([], 0, $perPage, $page, [
            'path'     => Paginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ]);

        $pager->columns = $columns;
        $pager->setBuilder($builder);
        return $pager;
    }

    /**
     * @return Builder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * @param array $columns
     * @return LazyHolder
     */
    public function select(array $columns = ['*'])
    {
        $this->columns = $columns;
        return $this;
    }
}
