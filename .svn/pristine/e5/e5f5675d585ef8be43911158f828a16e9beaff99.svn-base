<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\GridView;
use App\ItemMaster;
use App\Filters\GalleryTypeFilter;
use App\Actions\GalleryAction;
use App\Actions\ItemEditAction;
// use Livewire\WithPagination;
use LaravelViews\Facades\UI;

class ItemsGridView extends GridView
{
    // use WithPagination;

    // protected $model = ItemMaster::class;

    public $searchBy = ['item_code', 'description','mapping_item'];

    public $maxCols = 8;
    protected $paginate = 50;

    public function repository(): Builder
    {
        return ItemMaster::where ('type_code','=','SPR');
    }

    public function card($item)
    {
        return [
            'image' =>isset($item->img_path)? asset($item->img_path):asset('/img/spr.png'),
            'title' =>"<button type='button'  class='badge btn btn-light text-primary' id='url' data-id='$item->item_code' data-img='$item->img_path' data-bs-toggle='modal' data-bs-target='#modaladd'>$item->item_code</button>",
            'item_code' =>$item->item_code,
            'description' =>$item->description,
            // 'mapping_item' =>$item->mapping_item,
        ];
    }

    // protected function filters()
    //     {
    //         return [
    //             new GalleryTypeFilter,

    //         ];
    //     }

    // protected function actionsByRow()
    //     {
    //         return [
    //             new ItemEditAction,
    //         ];
    //     }

    // protected function bulkActions()
    //     {
    //         return [
    //             new GalleryAction,
    //         ];
    //     }
}

