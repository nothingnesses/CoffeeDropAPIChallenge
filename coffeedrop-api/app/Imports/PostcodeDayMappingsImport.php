<?php

namespace App\Imports;

use App\Models\PostcodeDayMapping;
use Maatwebsite\Excel\Concerns\ToModel;

class PostcodeDayMappingsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PostcodeDayMapping([
            //
        ]);
    }
}
