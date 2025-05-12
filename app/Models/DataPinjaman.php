<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPinjaman extends Model
{
    protected $table = 'data_pinjaman';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(DataPersonal::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(DataStock::class, 'book_id');
    }
}
