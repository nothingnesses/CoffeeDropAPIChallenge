<?php

namespace App\Imports;

use App\Models\Postcode;
use Maatwebsite\Excel\Concerns\ToModel;

class PostcodesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Postcode([
            //
        ]);
    }
}
