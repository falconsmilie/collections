<?php

namespace App\Model;

class Food extends Model
{
    private const UNIT_KILOGRAMS = 'kg';
    private const UNIT_GRAMS = 'g';

    protected int $id;
    protected string $name;
    protected string $type;
    protected int $quantity;
    protected string $unit;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->convertToGrams();
    }

    public function convertToGrams()
    {
        if ($this->unit === self::UNIT_KILOGRAMS) {
            $this->quantity *= 1000;
            $this->unit = self::UNIT_GRAMS;
        }
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }
}