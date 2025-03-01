<?php

namespace App\Controllers;

use App\Models\ViewHistory;

class ViewHistoryController
{
    private $viewHistoryModel;

    public function __construct()
    {
        $this->viewHistoryModel = new ViewHistory();
    }

    /**
     * Добавляет или обновляет запись о просмотре визитки.
     * Если записей больше 100, удаляет самую старую.
     *
     * @param string $userId
     * @param string $cardId
     * @return void
     */
    public function addView($userId, $cardId)
    {
        $this->viewHistoryModel->addOrUpdateView($userId, $cardId);
        echo json_encode(['status' => 'success']);
    }

    /**
     * Возвращает историю просмотров для пользователя.
     *
     * @param string $userId
     * @return void
     */
    public function getViews($userId)
    {
        $views = $this->viewHistoryModel->getViewsByUser($userId);
        echo json_encode($views);
    }

    /**
     * Устанавливает мок коллекции для тестирования.
     *
     * @param \MongoDB\Collection $collection
     * @return void
     */
    public function setViewHistoryModel(ViewHistory $viewHistoryModel)
    {
        $this->viewHistoryModel = $viewHistoryModel;
    }
}