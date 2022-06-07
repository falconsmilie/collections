<?php

namespace App\Collection;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

class Collection implements ArrayAccess, IteratorAggregate, Countable
{
    protected array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * User can call, $this->collection[] = $item, from where the collection is instantiated/available.
     * This method is for the convenience of being able to add more than one item at a time.
     *
     * @param array $values
     * @return $this
     */
    public function add(array $values): Collection
    {
        foreach ($values as $value) {
            $this->offsetSet(null, $value);
        }

        return $this;
    }

    /**
     * User can call, unset($this->collection[$key]), from where the collection is instantiated/available.
     * This method just provides a clean interface for doing so.
     */
    public function remove($key)
    {
        if ($this->offsetExists($key)) {
            $this->offsetUnset($key);
        }
    }

    public function filter(callable $callback): Collection
    {
        return new static(array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH));
    }

    public function map(callable $callback): Collection
    {
        return new static(array_map($callback, $this->items));
    }

    public function each(callable $callback): Collection
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    public function search(callable $callable, bool $strict = true): bool|int|string
    {
        //  if (is_string($callable)) {
        //      return array_search($callable, $this->items, $strict);
        //  }

        if (is_callable($callable)) {
            foreach ($this->items as $key => $item) {
                if ($callable($item, $key)) {
                    return $key;
                }
            }
        }

        return false;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return count($this->items);
    }
}
