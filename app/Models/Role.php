<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'permission'
    ];
    public static $PERMISSION_DATA = [
        'Menambah Order',
        'Update Order',
        'Membatalkan Order',
        'Menambah Produk',
        'Update Produk',
        'Hapus Produk',
        'Update Pembayaran',
        'Update Status Order',
        'Menambahkan Customer',
        'Update Customer',
    ];
}
