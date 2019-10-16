<?php

namespace App\Imports;

use App\Model\Lender;
use Maatwebsite\Excel\Concerns\ToModel;

class LendersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lender([
            'code'     => $row[0],
            'name'    => $row[1], 
            'subname' => $row[2],
            'branch_id' => $row[3],
            'orig_code' => $row[4],
            'visible' => $row[5]
        ]);
    }
}
