<?php

namespace App\Exports;

use App\Models\LaporanTransaksi as ModelsLaporanTransaksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanTransaksi implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelsLaporanTransaksi::all();
    }
}
