<?php

namespace App\Exports;

use App\Models\DataStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StockExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return DataStock::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Image Path',
            'Nama Buku',
            'Jumlah',
            'Kode Buku',
            'Status',
            'Created At',
            'Updated At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->image_path,
            $row->nama_buku,
            $row->jumlah,
            $row->kode_buku,
            $row->jumlah <= 0 ? 'Out of Stock' : 'Available',
            $row->created_at,
            $row->updated_at,
        ];
    }
}
