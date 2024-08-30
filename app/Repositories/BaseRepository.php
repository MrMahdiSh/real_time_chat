<?php


namespace App\Repositories;


use App\Interfaces\IBaseRepositoryInterface;
use App\Status;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }


    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->getById($id);

        if (!$record) {
            return false;
        }

        return $record->update($data);
    }

    public function CreateOrUpdate($where, array $data)
    {
        $record = $this->model->updateOrCreate($where, $data);
        if ($record) {
            return true;
        }
        return false;
    }

    public function delete($id)
    {
        $record = $this->getById($id);

        if (!$record) {
            return false;
        }

        return $record->delete();
    }

    public function getAllStatus($count = 1000)
    {
        return $this->model->where('status', Status::True)->take($count)->get();
    }

    public function Get()
    {
        return $this->model;
    }

    public function getPaginateProduct($paginate = 20)
    {
        return $this->model->where('status', Status::True);
    }
}

