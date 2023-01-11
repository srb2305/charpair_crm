<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Lead;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   

	public function map($row): array{
           return [
              $row->id,
              $row->name,
              $row->contact,
              $row->email,
              $row->dob,
              $row->address,
              $row->state,
              $row->city,
              $row->pincode,
              $row->company,
              $row->department,
              $row->designation,
              $row->others,
         ];
        
    }

    public function headings(): array{
           return [
              'id',
              'name',
              'contact',
              'email',
              'dob',
              'address',
              'state',
              'city',
              'pincode',
              'company',
              'department',
              'designation',
              'others',
         ];
        
    }

    public function collection()
    {
        return lead::all();

    }
	

}
