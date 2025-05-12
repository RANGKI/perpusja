<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataStock extends Model
{
    protected $table = 'data_stock';

    protected $primaryKey = 'id'; 

    protected $fillable = [
        'image_path',
        'nama_buku',
        'jumlah',
        'kode_buku'
    ];

    public function pinjaman() {
        return $this->hasMany(DataPinjaman::class, 'book_id');
    }

}
