<?php

namespace App\Collection;

class Collection
{
    protected array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function add($values): Collection
    {
        foreach ($values as $value) {
            $this->items[] = $value;
        }

        return $this;
    }

    public function filter(callable $callback): Collection
    {
        return new static(array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH));
    }

    public function map(callable $callback): Collection
    {
        return new static(array_map($callback, $this->items));
    }

    public function remove(mixed $item)
    {
        // TODO: Implement remove() method.
    }

    public function list()
    {
        // TODO: Implement list() method.
    }

    public function search()
    {
        // TODO: Implement search() method.
    }
}