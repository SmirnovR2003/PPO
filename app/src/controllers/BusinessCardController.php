<?php

namespace App\Controllers;

use App\Models\BusinessCard;
use App\Config\Constants;

class BusinessCardController
{
    private $businessCardModel;

    public function __construct()
    {
        $this->businessCardModel = new BusinessCard();
    }

    // Метод для установки мока
    public function setBusinessCardModel(BusinessCard $businessCardModel)
    {
        $this->businessCardModel = $businessCardModel;
    }

    public function create($data)
    {
        $id = $this->businessCardModel->create($data);
        echo json_encode(['id' => (string)$id]);
    }

    public function read($id = null)
    {
        if ($id) {
            $businessCard = $this->businessCardModel->findById($id);
            if ($businessCard) {
                echo json_encode($businessCard);
            } else {
                http_response_code(Constants::HTTP_NOT_FOUND);
                echo json_encode(['error' => Constants::ERROR_RESOURCE_NOT_FOUND]);
            }
        } else {
            $businessCards = $this->businessCardModel->findAll();
            echo json_encode($businessCards);
        }
    }

    public function update($id, $data)
    {
        $result = $this->businessCardModel->update($id, $data);
        echo json_encode(['modifiedCount' => $result]);
    }

    public function delete($id)
    {
        $result = $this->businessCardModel->delete($id);
        echo json_encode(['deletedCount' => $result]);
    }
}