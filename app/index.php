<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controllers\UserController;
use App\Controllers\BusinessCardController;
use App\Controllers\ViewHistoryController;
use App\Config\Constants;

// Запуск тестов
if (isset($_GET['test']) && $_GET['test'] == 1) {
    require __DIR__ . '/vendor/autoload.php';
    $testSuite = new PHPUnit\Framework\TestSuite();
    $testSuite->addTestSuite('Tests\UserControllerTest');
    $testSuite->addTestSuite('Tests\BusinessCardControllerTest');
    $testSuite->addTestSuite('Tests\ViewHistoryControllerTest');
    (new PHPUnit\TextUI\TestRunner)->run($testSuite);
    exit;
}

header("Content-Type: application/json");

// Получаем данные из $_REQUEST
$action = $_REQUEST['action'] ?? null;
$id = $_REQUEST['id'] ?? null;
$data = $_REQUEST['data'] ?? null;

if (!$action) {
    http_response_code(Constants::HTTP_BAD_REQUEST);
    echo json_encode(['error' => Constants::ERROR_ACTION_REQUIRED]);
    exit;
}

$actionParts = explode('.', $action);
if (count($actionParts) !== 2) {
    http_response_code(Constants::HTTP_BAD_REQUEST);
    echo json_encode(['error' => Constants::ERROR_INVALID_ACTION_FORMAT]);
    exit;
}

list($controllerName, $method) = $actionParts;

switch ($controllerName) {
    case 'user':
        $controller = new UserController();
        break;
    case 'businessCard':
        $controller = new BusinessCardController();
        break;
    case 'viewHistory':
        $controller = new ViewHistoryController();
        break;
    default:
        http_response_code(Constants::HTTP_NOT_FOUND);
        echo json_encode(['error' => Constants::ERROR_CONTROLLER_NOT_FOUND]);
        exit;
}

if (method_exists($controller, $method)) {
    switch ($method) {
        case 'create':
            if ($data) {
                $controller->$method($data);
            } else {
                http_response_code(Constants::HTTP_BAD_REQUEST);
                echo json_encode(['error' => Constants::ERROR_DATA_REQUIRED]);
            }
            break;
        case 'read':
            if ($id) {
                $controller->$method($id);
            } else {
                $controller->$method();
            }
            break;
        case 'update':
            if ($id && $data) {
                $controller->$method($id, $data);
            } else {
                http_response_code(Constants::HTTP_BAD_REQUEST);
                echo json_encode(['error' => Constants::ERROR_ID_AND_DATA_REQUIRED]);
            }
            break;
        case 'delete':
            if ($id) {
                $controller->$method($id);
            } else {
                http_response_code(Constants::HTTP_BAD_REQUEST);
                echo json_encode(['error' => Constants::ERROR_ID_REQUIRED]);
            }
            break;
        case 'addView':
            if ($userId && $cardId) {
                $controller->$method($userId, $cardId);
            } else {
                http_response_code(Constants::HTTP_BAD_REQUEST);
                echo json_encode(['error' => 'user_id and card_id are required']);
            }
            break;
        case 'getViews':
            if ($userId) {
                $controller->$method($userId);
            } else {
                http_response_code(Constants::HTTP_BAD_REQUEST);
                echo json_encode(['error' => 'user_id is required']);
            }
            break;
        default:
            http_response_code(Constants::HTTP_BAD_REQUEST);
            echo json_encode(['error' => Constants::ERROR_METHOD_NOT_FOUND]);
            break;
    }
} else {
    http_response_code(Constants::HTTP_NOT_FOUND);
    echo json_encode(['error' => Constants::ERROR_METHOD_NOT_FOUND]);
}