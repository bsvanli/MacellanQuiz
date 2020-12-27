<?php

namespace App\Observers;

use App\Repositories\ActionLogRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ActionObserver
{

    private ActionLogRepository $actionLogRepository;


    public function __construct(ActionLogRepository $actionLogRepository)
    {
        $this->actionLogRepository = $actionLogRepository;
    }

    public function updated(Model $model)
    {
        if (!$model->wasRecentlyCreated) {
            $this->actionLogRepository->create([
                'node_type'     => $model->getTable(),
                'node_id'       => $model->id,
                'user_id'       => Auth::check() ? Auth::id() : null,
                'original_data' => $model->getOriginal(),
                'changes'       => $model->getChanges(),
                'action_type'   => 'updated'
            ]);
        }
    }

}
