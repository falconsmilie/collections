<?php

namespace App\Collection;

interface CollectionInterface
{
    public function add();

    public function remove();

    public function list();

    public function search();
}