<?php

namespace App\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class GalleryAction extends Action
{
    use Confirmable;

    public $title = "Action";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "shield";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param Array $selectedModels Array with all the id of the selected models
     * @param $view Current view where the action was executed from
     */
    public function handle($selectedModels, View $view)
    {
        $model->active = true;
        $model->save();
        $this->success();
    }
    // public function renderIf($model, View $view)
    // {
    //     return !$model->active;
    // }
}
