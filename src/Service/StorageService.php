<?php

namespace App\Service;

use App\Collection\Collection;
use App\Model\Food;
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

    public function process(): void
    {
        $this->fruit = $this->collection
            ->filter(fn($item) => $item->type === 'fruit')
            ->map(fn($item) => new Fruit((array)$item));

        $this->vegetables = $this->collection
            ->filter(fn($item) => $item->type === 'vegetable')
            ->map(fn($item) => new Vegetable((array)$item));
//
//        $pineapple = $this->fruit->search(fn($item) => $item->getName() === 'Pineapple');
//        var_dump($this->fruit[$pineapple]);
//        unset($this->fruit[$pineapple]);
//
//        $this->fruit->each(fn($item) => $item->convertUnit(Food::UNIT_KILOGRAMS));

//        var_dump($this->fruit);
    }

    public function getFruit(): Collection
    {
        return $this->fruit;
    }

    public function getVegetables(): Collection
    {
        return $this->vegetables;
    }
}
