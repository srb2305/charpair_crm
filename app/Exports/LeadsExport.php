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
         ];
        
    }

    public function headings(): array{
           return [
              'id',
              'name',
              'contact',
              'email',
         ];
        
    }

    public function collection()
    {
        return Lead::all();
    }
	

}
