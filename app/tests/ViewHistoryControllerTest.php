<?php

namespace Tests;

use App\Controllers\ViewHistoryController;
use App\Models\ViewHistory;
use MongoDB\Collection;
use PHPUnit\Framework\TestCase;

class ViewHistoryControllerTest extends TestCase
{
    private $viewHistoryController;
    private $viewHistoryModel;

    protected function setUp(): void
    {
        // Создаем мок для модели ViewHistory
        $this->viewHistoryModel = $this->createMock(ViewHistory::class);
        
        // Передаем мок в контроллер
        $this->viewHistoryController = new ViewHistoryController();
        $this->viewHistoryController->setViewHistoryModel($this->viewHistoryModel);
    }

    public function testAddView()
    {
        $userId = '123';
        $cardId = '456';

        // Настраиваем мок
        $this->viewHistoryModel->method('addOrUpdateView')->willReturn(true);

        // Проверяем вывод
        $this->expectOutputString(json_encode(['status' => 'success']));
        $this->viewHistoryController->addView($userId, $cardId);
    }

    public function testGetViews()
    {
        $userId = '123';
        $views = [
            ['card_id' => '456', 'last_viewed_at' => '2023-10-15T12:34:56.789Z'],
            ['card_id' => '789', 'last_viewed_at' => '2023-10-14T12:34:56.789Z']
        ];

        // Настраиваем мок
        $this->viewHistoryModel->method('getViewsByUser')->willReturn($views);

        // Проверяем вывод
        $this->expectOutputString(json_encode($views));
        $this->viewHistoryController->getViews($userId);
    }
}