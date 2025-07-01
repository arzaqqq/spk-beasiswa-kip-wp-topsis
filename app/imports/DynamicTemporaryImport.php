<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DynamicTemporaryImport implements ToArray, WithHeadingRow
{
    public $data;

    public function array(array $array)
    {
        $this->data = $array;
    }
}

