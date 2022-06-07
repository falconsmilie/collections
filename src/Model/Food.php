<?php

namespace App\Model;

/**
 * One concern here is there is only support for grams/kilograms, not e.g. tons, or liquid measurements.
 */
class Food extends Model
{
    public const UNIT_KILOGRAMS = 'kg';
    public const UNIT_GRAMS = 'g';

    protected int $id;
    protected string $name;
    protected string $type;
    protected float $quantity;  // This is the weight
    protected string $unit;     // This is the unit of weight

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->convertUnit();
    }

    public function convertUnit($unit = self::UNIT_GRAMS)
    {
        if ($this->unit !== $unit) {

            $this->quantity = $unit === self::UNIT_GRAMS
                ? $this->quantity *= 1000
                : $this->quantity /= 1000;

            $this->unit = $unit;
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }
}
