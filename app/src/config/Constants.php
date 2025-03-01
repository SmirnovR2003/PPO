<?php

namespace App\Config;

class Constants
{
    // Коды HTTP-статусов
    const HTTP_OK = 200;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;

    // Сообщения об ошибках
    const ERROR_ACTION_REQUIRED = 'Action parameter is required';
    const ERROR_INVALID_ACTION_FORMAT = 'Invalid action format. Use "controller.method"';
    const ERROR_CONTROLLER_NOT_FOUND = 'Controller not found';
    const ERROR_METHOD_NOT_FOUND = 'Method not found';
    const ERROR_DATA_REQUIRED = 'Data is required for create';
    const ERROR_ID_REQUIRED = 'ID is required';
    const ERROR_ID_AND_DATA_REQUIRED = 'ID and data are required for update';
    const ERROR_RESOURCE_NOT_FOUND = 'Resource not found';

    // Названия коллекций
    const COLLECTION_USERS = 'users';
    const COLLECTION_BUSINESS_CARDS = 'business_cards';
    const COLLECTION_VIEW_HISTORY = 'view_history';

    // Параметры подключения к MongoDB
    const MONGO_URI = 'mongodb://root:secret@mongodb:27017';
    const MONGO_DB_NAME = 'tutorial';

    // Разделитель для action
    const ACTION_DELIMITER = '.';

    // Названия контроллеров
    const CONTROLLER_USER = 'user';
    const CONTROLLER_BUSINESS_CARD = 'businessCard';
    const CONTROLLER_VIEW_HISTORY = 'viewHistory';

    // Названия методов
    const METHOD_CREATE = 'create';
    const METHOD_READ = 'read';
    const METHOD_UPDATE = 'update';
    const METHOD_DELETE = 'delete';
    const METHOD_GET_VIEW = 'addView';
    const METHOD_ADD_VIEW = 'getViews';
}