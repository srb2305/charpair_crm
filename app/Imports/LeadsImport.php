<?php

namespace App\Imports;

use App\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class LeadsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        
        if(!empty($row)){
        return new Lead([
                
                'name' => $row['name'],
                'contact' => $row['contact'],
                'email' => $row['email'],
                'added_by' => Auth::user()->id,
                'status' => 1
        ]);
    }
    }
}
