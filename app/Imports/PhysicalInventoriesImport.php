<?php

namespace App\Imports;

use App\PhysicalInventories;
use App\ItemMaster;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class PhysicalInventoriesImport implements ToCollection, SkipsOnError, WithStartRow
{
    use Importable, SkipsErrors;
     /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function transformDate($value, $format = 'd-m-Y')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function collection(Collection $rows)
    {
        $request = request()->all();

        $count = 2;
        foreach($rows as $row){
            $item = ItemMaster::where('item_code',$row[0])->select('inventory_item_id')->first();
            if($item){

                $id= PhysicalInventories::latest('id')->first()->physical_inventory_id ?? 0;
                $id= $id+1;

                $item_id = $item->inventory_item_id;
                PhysicalInventories::create([
                    'tag_id'=> 1,
                    'physical_inventory_id'=> $id,
                    'created_by'=> $request['created_by'] ,
                    'inventory_item_id'=> $item_id,
                    'tag_uom'=> $row[1],
                    'tag_quantity'=> $row[2],
                    'subinventory'=> $row[3],
                    'locator_id'=> $row[4],
                    'revision'=> $row[5],
                    'attribute_date1'=> $this->transformDate($row[6]),
                    'created_at'=> $request['created_at'],
                    'updated_at'=> $request['created_at'],
                ]);
            }else{
                return redirect()->route('admin.physic.index')->with('error', 'Item '.$row[0].' in row '.$count.' not exist, The rest row not imported');
            }
            $count ++;
        }
    }
}
