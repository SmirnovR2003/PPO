<?php

namespace App\Models;

use App\Config\Database;
use App\Config\Constants;
use MongoDB\BSON\UTCDateTime;

class ViewHistory
{
    private $collection;

    public function __construct()
    {
        $db = Database::getInstance()->getDb();
        $this->collection = $db->{Constants::COLLECTION_VIEW_HISTORY};

        // Создаем уникальный индекс для user_id и card_id
        $this->collection->createIndex(['user_id' => 1, 'card_id' => 1], ['unique' => true]);
    }

    /**
     * Добавляет или обновляет запись в истории просмотров.
     * Если записей больше 100, удаляет самую старую.
     *
     * @param string $userId
     * @param string $cardId
     * @return void
     */
    public function addOrUpdateView($userId, $cardId)
    {
        // Добавляем или обновляем запись
        $this->collection->updateOne(
            ['user_id' => $userId, 'card_id' => $cardId], // Условие поиска
            [
                '$set' => [
                    'last_viewed_at' => new UTCDateTime(time() * 1000) // Текущее время
                ]
            ],
            ['upsert' => true] // Создать запись, если она не существует
        );

        // Проверяем количество записей для пользователя
        $count = $this->collection->countDocuments(['user_id' => $userId]);

        // Если записей больше 100, удаляем самую старую
        if ($count > 100) {
            $oldestView = $this->collection->findOne(
                ['user_id' => $userId],
                ['sort' => ['last_viewed_at' => 1]] // Сортировка по возрастанию даты
            );

            if ($oldestView) {
                $this->collection->deleteOne(['_id' => $oldestView['_id']]);
            }
        }
    }

    /**
     * Возвращает историю просмотров для пользователя, отсортированную по дате последнего просмотра.
     *
     * @param string $userId
     * @return array
     */
    public function getViewsByUser($userId)
    {
        return $this->collection->find(
            ['user_id' => $userId],
            [
                'sort' => ['last_viewed_at' => -1], // Сортировка по убыванию даты
                'projection' => ['_id' => 0, 'card_id' => 1, 'last_viewed_at' => 1] // Выбираем только нужные поля
            ]
        )->toArray();
    }
}