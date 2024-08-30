<?php


namespace App\Interfaces;


interface IBaseRepositoryInterface
{
    public function getAll();

    public function getAllStatus($count = 1000);

    public function getById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function Get();

}
