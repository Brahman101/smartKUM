<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonografiHukum extends Model
{
    use HasFactory;
    protected $table = 'monografi_hukums';
    protected $fillable = ['judul', 'tanggal_pengundangan', 'status_dokumen', 'jenis', 'abstrak', 'jumlah_dilihat', 'jumlah_diunduh', 'file_path', 'file_name'];
}
