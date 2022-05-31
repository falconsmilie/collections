<?php

namespace App\Model;

class Model
{
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    private function fill(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            if (method_exists($this, 'set' . ucfirst($key))) {
                // this relies on the user sticking to naming convention
                $this->{'set' . ucfirst($key)}($value);
            }
        }
    }
}