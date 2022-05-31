<?php

namespace App\Tests\App\Service;

use App\Collection\Collection;
use App\Service\StorageService;
use PHPUnit\Framework\TestCase;

class StorageServiceTest extends TestCase
{
    public function testReceivingRequest(): void
    {
        $request = file_get_contents('request.json');
        $items = json_decode($request);

        $storageService = new StorageService($request, new Collection($items));

        $storageService->process();

        $this->assertNotEmpty($storageService->getRequest());
        $this->assertIsString($storageService->getRequest());
    }
}
