<?php

namespace App\Tests\App\Service;

use App\Collection\Collection;
use App\Model\Fruit;
use App\Model\Vegetable;
use App\Service\StorageService;
use PHPUnit\Framework\TestCase;

class StorageServiceTest extends TestCase
{
    protected static string $request;
    protected static array $collectionItems;

    public static function setupBeforeClass(): void
    {
        self::$request = file_get_contents('request.json');
        self::$collectionItems = json_decode(self::$request);
    }

    public function testReceivingRequest(): void
    {
        $storageService = $this->getStorageService();

        $this->assertNotEmpty($storageService->getRequest());
        $this->assertIsString($storageService->getRequest());
        $this->assertSame(self::$request, $storageService->getRequest());
    }

    public function testCanSortFruitAndVegetables()
    {
        $storageService = $this->getStorageService();
        $storageService->process();

        $this->assertSame(10, count($storageService->getFruit()));
        $this->assertSame(10, count($storageService->getVegetables()));
    }

    public function testCanAddFruitAndVegetables()
    {
        $storageService = $this->getStorageService();
        $storageService->process();

        $fruit = $storageService->getFruit();
        $vegetables = $storageService->getVegetables();

        $newFruit = [
            'id' => 21,
            'name' => 'Pineapple',
            'type' => 'fruit',
            'quantity' => 15,
            'unit' => 'kg'
        ];

        $fruit[] = new Fruit($newFruit);

        $newVegetable = [
            'id' => 22,
            'name' => 'Spinach',
            'type' => 'vegetable',
            'quantity' => 15,
            'unit' => 'kg'
        ];

        $vegetables[] = new Vegetable($newVegetable);

        $this->assertSame(11, count($storageService->getFruit()));
        $this->assertSame(11, count($storageService->getVegetables()));
    }

    public function testCanAddMultipleFruitAtOnce()
    {
        $storageService = $this->getStorageService();
        $storageService->process();

        $fruit = $storageService->getFruit();

        $newFruit1 = [
            'id' => 21,
            'name' => 'Pineapple',
            'type' => 'fruit',
            'quantity' => 15,
            'unit' => 'kg'
        ];

        $newFruit2 = [
            'id' => 22,
            'name' => 'Mango',
            'type' => 'fruit',
            'quantity' => 15,
            'unit' => 'kg'
        ];

        $fruit->add([new Fruit($newFruit1), new Fruit($newFruit2)]);

        $this->assertSame(12, count($storageService->getFruit()));
    }

    public function testCanRemoveFruit()
    {
        $storageService = $this->getStorageService();
        $storageService->process();

        $fruit = $storageService->getFruit();
        $fruitToRemove = $fruit->search(fn($item) => $item->getName() === 'Apples');

        unset($fruit[$fruitToRemove]);

        $this->assertSame(9, count($fruit));
    }

    private function getStorageService(): StorageService
    {
        return new StorageService(
            self::$request,
            new Collection(self::$collectionItems)
        );
    }
}
