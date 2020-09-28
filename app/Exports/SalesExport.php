<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }
    protected $template;

    public function __construct(array $template)
    {
        $this->template = $template;
    }

    public function array(): array
    {
        return $this->template;
    }

    public function headings(): array
    {
        return [
            'Lokal Order Number',
            'Seller O.N.',
            'Sub Total',
            'Delivery Fee',
            'Pouch',
            'Lokal Share',
            'Net',
            'Date'
        ];
    }
}
