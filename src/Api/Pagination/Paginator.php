<?php

/**
 * Created by PhpStorm.
 * User: HeYuanJun
 * Date: 2021/1/11
 * Time: 5:59 下午
 */

namespace Blog\Api\Repositories\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;

class Paginator extends LengthAwarePaginator
{
    protected $merges = [];

    protected $formatMethods = ['format', 'transform'];

    public function format($formatter)
    {
        if (is_callable($formatter)) {
            $this->items = $this->items->map($formatter);
        } elseif (is_object($formatter)) {
            $this->callFormatMethod($formatter);
        }

        return $this;
    }

    protected function callFormatMethod($formatter)
    {
        foreach ($this->formatMethods as $method) {
            if (method_exists($formatter, $method)) {
                $closure = function ($item) use ($formatter, $method) {
                    return call_user_func([$formatter, $method], $item);
                };
                $this->items = $this->items->map($closure);
                return true;
            }
        }

        return false;
    }

    public function with($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                if (!is_numeric($k)) {
                    $this->merges[$k] = $v;
                }
            }
        } elseif (is_string($key) && !is_null($value)) {
            $this->merges[$key] = $value;
        }

        return $this;
    }

    /**
     * @param LengthAwarePaginator|\Illuminate\Contracts\Pagination\LengthAwarePaginator $paginator
     * @return static
     */
    public static function fromBase($paginator)
    {
        return new static($paginator->items(), $paginator->total(), $paginator->perPage(), $paginator->currentPage(), [
            'pageName' => $paginator->getPageName()
        ]);
    }

    public static function forArray(array $array, $perPage, $currentPage, $options = [])
    {
        $items = array_slice($array, $perPage * ($currentPage - 1), $perPage);
        return new static($items, count($array), $perPage, $currentPage, $options);
    }
}
