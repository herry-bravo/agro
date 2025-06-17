<?php

namespace App\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class ItemEditAction extends Action
{

    public $title = "Edit";


    public $icon = "lock";



    public function handle($model, View $view)
    {
        $model->active = true;

    }
    public function render()
    {
        return view('livewire.post.edit');
    }
}
