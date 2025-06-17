<?php

namespace App\Http\Livewire;
use App\Onhand;
use LaravelViews\Facades\Header;

use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\UI;
use LaravelViews\Views\Traits\WithAlerts;

class PhysicalInventoryView extends TableView
{
    use WithAlerts;

    protected $model = Onhand::class;

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return ['Location','Item Code',  Header::title('Quantity')->width('15%'),'UOM','Different','Action'];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->subinventory_code,
            $model->itemmaster->item_code." ".$model->itemmaster->description,
            UI::editable($model, 'primary_transaction_quantity'),
            $model->transaction_uom_code,
            UI::icon('check', 'success'),

        ];
    }

    public function repository(): Builder
    {
        return Onhand::query();
    }

    public function update(Onhand $model, $data)
    {
        $model->update(collect($data)->map(function ($value) {
            return strip_tags($value);
        })->toArray());
        $this->success();
    }
}
