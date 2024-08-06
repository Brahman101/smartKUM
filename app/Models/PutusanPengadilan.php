<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PutusanPengadilan extends Model
{
    use HasFactory;
    protected $table = 'putusan_pengadilans';
    protected $fillable = ['judul', 'tanggal_putusan', 'abstrak'];
}
