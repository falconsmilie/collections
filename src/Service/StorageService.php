<?php

namespace App\Service;


use App\Collection\Collection;
use App\Model\Fruit;
use App\Model\Vegetable;

class StorageService
{
    private string $request;
    private Collection $collection;
    private Collection $fruit;
    private Collection $vegetables;

    public function __construct(string $request, Collection $collection)
    {
        $this->request = $request;
        $this->collection = $collection;
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    public function process()
    {
        $this->fruit = $this->collection
            ->filter(fn($item) => $item->type === 'fruit')
            ->map(fn($item) => new Fruit((array)$item));

        $this->vegetables = $this->collection
            ->filter(fn($item) => $item->type === 'vegetable')
            ->map(fn($item) => new Vegetable((array)$item));
    }
}
