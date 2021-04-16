<?php

namespace App\Exports;

use App\Models\LaporanTransaksi as ModelsLaporanTransaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanTransaksi implements FromCollection, WithHeadings, ShouldAutoSize
{

    public function collection()
    {
        return ModelsLaporanTransaksi::all();
    }

    public function headings(): array
    {
        return [
            "ID","ID ORDER", "NAMA COSTUMER", "NAMA SALES", "NAMA BARANG", "JUMLAH BARANG", "TANGGAL ORDER", "STATUS"
        ];
    }


}
