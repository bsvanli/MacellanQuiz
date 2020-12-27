<?php


namespace App\Repositories;


use App\Models\ActionLog;
use App\Repositories\Interfaces\ActionLogRepositoryInterface;

class ActionLogRepository implements ActionLogRepositoryInterface
{

    private ActionLog $model;

    /**
     * ActionLogRepository constructor.
     * @param ActionLog $model
     */
    public function __construct(ActionLog $model)
    {
        $this->model = $model;
    }


    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
