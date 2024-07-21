<?php

namespace App\Imports;

use App\Models\BusinessHours;
use Maatwebsite\Excel\Concerns\ToModel;

class BusinessHoursImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new BusinessHours([
            //
        ]);
    }
}
