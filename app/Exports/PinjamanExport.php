<?php

namespace App\Exports;

use App\Models\DataPinjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PinjamanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DataPinjaman::with(['user', 'book'])->get()->map(function ($item) {
            return [
                'ID'               => $item->id,
                'User ID'          => $item->user_id,
                'Username'         => $item->user->username ?? '-',
                'Email'            => $item->user->email ?? '-',
                'Book ID'          => $item->book_id,
                'Nama Buku'        => $item->book->nama_buku ?? '-',
                'Tanggal Pinjam'   => $item->tanggal_pinjam,
                'Tanggal Kembali'  => $item->tanggal_kembali ?? '-',
                'Status'           => $item->status,
                'Created At'       => $item->created_at,
                'Updated At'       => $item->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Username',
            'Email',
            'Book ID',
            'Nama Buku',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
}
