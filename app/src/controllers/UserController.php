<?php

namespace App\Controllers;

use App\Models\User;
use App\Config\Constants;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // Метод для установки мока
    public function setUserModel(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function create($data)
    {
        $id = $this->userModel->create($data);
        echo json_encode(['id' => (string)$id]);
    }

    public function read($id = null)
    {
        if ($id) {
            $user = $this->userModel->findById($id);
            if ($user) {
                echo json_encode($user);
            } else {
                http_response_code(Constants::HTTP_NOT_FOUND);
                echo json_encode(['error' => Constants::ERROR_RESOURCE_NOT_FOUND]);
            }
        } else {
            $users = $this->userModel->findAll();
            echo json_encode($users);
        }
    }

    public function update($id, $data)
    {
        $result = $this->userModel->update($id, $data);
        echo json_encode(['modifiedCount' => $result]);
    }

    public function delete($id)
    {
        $result = $this->userModel->delete($id);
        echo json_encode(['deletedCount' => $result]);
    }
}