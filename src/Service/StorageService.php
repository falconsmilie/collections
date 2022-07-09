<?php

namespace App\Service;

use App\Collection\Collection;
use App\Model\Fruit;
use App\Model\Vegetable;

class StorageService
{
    private string $request;
    private Collection $fruitAndVegetables;
    private Collection $fruit;
    private Collection $vegetables;

    public function __construct(string $request, Collection $fruitAndVegetables)
    {
        $this->request = $request;
        $this->fruitAndVegetables = $fruitAndVegetables;
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    public function process(): void
    {
        $this->fruit = $this->fruitAndVegetables
            ->filter(fn($item) => $item->type === 'fruit')
            ->map(fn($item) => new Fruit((array)$item));

        $this->vegetables = $this->fruitAndVegetables
            ->filter(fn($item) => $item->type === 'vegetable')
            ->map(fn($item) => new Vegetable((array)$item));
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
