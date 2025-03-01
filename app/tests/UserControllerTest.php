<?php

namespace Tests;

use App\Controllers\UserController;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    private $userController;
    private $userModel;

    protected function setUp(): void
    {
        // Создаем мок для модели User
        $this->userModel = $this->createMock(User::class);
        
        // Передаем мок в контроллер
        $this->userController = new UserController();
        $this->userController->setUserModel($this->userModel);
    }

    public function testCreateUser()
    {
        $data = ['name' => 'John Doe', 'email' => 'john@example.com'];
        
        // Настраиваем мок
        $this->userModel->method('create')->willReturn('651a1b2c3d4e5f6a7b8c9d0e');

        // Проверяем вывод
        $this->expectOutputString(json_encode(['id' => '651a1b2c3d4e5f6a7b8c9d0e']));
        $this->userController->create($data);
    }

    public function testReadUser()
    {
        $user = ['_id' => '651a1b2c3d4e5f6a7b8c9d0e', 'name' => 'John Doe'];
        
        // Настраиваем мок
        $this->userModel->method('findById')->willReturn($user);

        // Проверяем вывод
        $this->expectOutputString(json_encode($user));
        $this->userController->read('651a1b2c3d4e5f6a7b8c9d0e');
    }

    public function testReadAllUsers()
    {
        $users = [
            ['_id' => '651a1b2c3d4e5f6a7b8c9d0e', 'name' => 'John Doe'],
            ['_id' => '651a1b2c3d4e5f6a7b8c9d0f', 'name' => 'Jane Doe']
        ];
        
        // Настраиваем мок
        $this->userModel->method('findAll')->willReturn($users);

        // Проверяем вывод
        $this->expectOutputString(json_encode($users));
        $this->userController->read();
    }

    public function testUpdateUser()
    {
        $data = ['name' => 'Jane Doe'];
        
        // Настраиваем мок
        $this->userModel->method('update')->willReturn(1);

        // Проверяем вывод
        $this->expectOutputString(json_encode(['modifiedCount' => 1]));
        $this->userController->update('651a1b2c3d4e5f6a7b8c9d0e', $data);
    }

    public function testDeleteUser()
    {
        // Настраиваем мок
        $this->userModel->method('delete')->willReturn(1);

        // Проверяем вывод
        $this->expectOutputString(json_encode(['deletedCount' => 1]));
        $this->userController->delete('651a1b2c3d4e5f6a7b8c9d0e');
    }
}