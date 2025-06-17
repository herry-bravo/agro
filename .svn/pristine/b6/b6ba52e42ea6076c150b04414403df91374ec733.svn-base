<?php

namespace App\Http\Livewire;
use App\OperationUnit;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\TableView;
use LaravelViews\Facades\Header;
use App\Actions\OpUnitAction;
use LaravelViews\Facades\UI;

class OperationUnitView extends TableView
{


    protected $model = OperationUnit::class;



    public function repository(): Builder
    {
        return OperationUnit::query();
    }

    public function headers(): array
    {
        return ['ID','Avatar','Name', 'Capacity','Min','Max','GSM Min','GSM Max', 'Created', 'Updated'];
    }
    public $searchBy = ['short_name', 'unit_id'];

    public function row($model)
    {
        return [
            $model->unit_id,
            UI::avatar('https://cdn-icons-png.flaticon.com/512/1670/1670483.png'),
            $model->short_name,
            (float)$model->capacity,
            (float) $model->range_capacity_min,
            (float) $model->range_capacity_max,
            (float) $model->range_gsm_min,
            (float) $model->range_gsm_max,
            $model->created_at,
            $model->updated_at
        ];
    }
    protected function actionsByRow()
    {
        return [
           new  OpUnitAction,
        ];
    }

    protected function bulkActions()
    {
        return [
            new OpUnitAction,
        ];
    }
}
