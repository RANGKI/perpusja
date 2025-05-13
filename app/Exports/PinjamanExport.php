<?php

namespace App\Exports;

use App\Models\DataPinjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PinjamanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DataPinjaman::select([
            'id',
            'user_id',
            'book_id',
            'tanggal_pinjam',
            'tanggal_kembali',
            'status',
            'created_at',
            'updated_at'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Book ID',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Created At',
            'Updated At'
        ];
    }
}

