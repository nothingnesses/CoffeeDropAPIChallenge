<?php

namespace App\Imports;

use App\Models\Time;
use Maatwebsite\Excel\Concerns\ToModel;

class TimesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Time([
            //
        ]);
    }
}
