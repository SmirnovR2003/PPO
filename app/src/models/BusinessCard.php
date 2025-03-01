<?php

namespace App\Models;

use App\Config\Database;
use App\Config\Constants;
use MongoDB\BSON;

class BusinessCard
{
    private $collection;

    public function __construct()
    {
        $db = Database::getInstance()->getDb();
        $this->collection = $db->{Constants::COLLECTION_BUSINESS_CARDS};
    }

    public function findAll()
    {
        return $this->collection->find()->toArray();
    }

    public function findById($id)
    {
        return $this->collection->findOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
    }

    public function create($data)
    {
        $result = $this->collection->insertOne($data);
        return $result->getInsertedId();
    }

    public function update($id, $data)
    {
        $result = $this->collection->updateOne(
            ['_id' => new \MongoDB\BSON\ObjectId($id)],
            ['$set' => $data]
        );
        return $result->getModifiedCount();
    }

    public function delete($id)
    {
        $result = $this->collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectId($id)]);
        return $result->getDeletedCount();
    }
}