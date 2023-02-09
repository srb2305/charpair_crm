<?php

namespace App\Imports;

use App\Lead;
use App\LeadComment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;
use Carbon\Carbon;
use DateTime;
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
            if (!empty($row['dob'])) {
               $dob= Carbon::createFromFormat('d/m/Y', $row['dob'])->format('Y-m-d');
            } else {
                $dob=null;
            }

        return new Lead([
                
                'name' => $row['name'],
                'contact' => $row['contact'],
                'email' => $row['email'],
                'dob' => $dob,
                'address' => $row['address'],
                'state' => $row['state'],
                'city' => $row['city'],
                'pincode' => $row['pincode'],
                'company' => $row['company'],
                'department' => $row['department'],
                'designation' => $row['designation'],
                'others' => $row['others'],
                'added_by' => Auth::user()->id,
                'status' => 1
        ]);
    }
    else{
                return error;
            }
    }
}
