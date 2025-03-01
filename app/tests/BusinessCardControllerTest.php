<?php

namespace Tests;

use App\Controllers\BusinessCardController;
use App\Models\BusinessCard;
use PHPUnit\Framework\TestCase;

class BusinessCardControllerTest extends TestCase
{
    private $businessCardController;
    private $businessCardModel;

    protected function setUp(): void
    {
        // Создаем мок для модели BusinessCard
        $this->businessCardModel = $this->createMock(BusinessCard::class);
        
        // Передаем мок в контроллер
        $this->businessCardController = new BusinessCardController();
        $this->businessCardController->setBusinessCardModel($this->businessCardModel);
    }

    public function testCreateBusinessCard()
    {
        $data = ['title' => 'Business Card 1', 'content' => 'Sample content'];
        
        // Настраиваем мок
        $this->businessCardModel->method('create')->willReturn('651a1b2c3d4e5f6a7b8c9d0e');

        // Проверяем вывод
        $this->expectOutputString(json_encode(['id' => '651a1b2c3d4e5f6a7b8c9d0e']));
        $this->businessCardController->create($data);
    }

    public function testReadBusinessCard()
    {
        $businessCard = ['_id' => '651a1b2c3d4e5f6a7b8c9d0e', 'title' => 'Business Card 1'];
        
        // Настраиваем мок
        $this->businessCardModel->method('findById')->willReturn($businessCard);

        // Проверяем вывод
        $this->expectOutputString(json_encode($businessCard));
        $this->businessCardController->read('651a1b2c3d4e5f6a7b8c9d0e');
    }

    public function testReadAllBusinessCards()
    {
        $businessCards = [
            ['_id' => '651a1b2c3d4e5f6a7b8c9d0e', 'title' => 'Business Card 1'],
            ['_id' => '651a1b2c3d4e5f6a7b8c9d0f', 'title' => 'Business Card 2']
        ];
        
        // Настраиваем мок
        $this->businessCardModel->method('findAll')->willReturn($businessCards);

        // Проверяем вывод
        $this->expectOutputString(json_encode($businessCards));
        $this->businessCardController->read();
    }

    public function testUpdateBusinessCard()
    {
        $data = ['title' => 'Updated Business Card'];
        
        // Настраиваем мок
        $this->businessCardModel->method('update')->willReturn(1);

        // Проверяем вывод
        $this->expectOutputString(json_encode(['modifiedCount' => 1]));
        $this->businessCardController->update('651a1b2c3d4e5f6a7b8c9d0e', $data);
    }

    public function testDeleteBusinessCard()
    {
        // Настраиваем мок
        $this->businessCardModel->method('delete')->willReturn(1);

        // Проверяем вывод
        $this->expectOutputString(json_encode(['deletedCount' => 1]));
        $this->businessCardController->delete('651a1b2c3d4e5f6a7b8c9d0e');
    }
}