<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelHukum extends Model
{
    use HasFactory;
    protected $table = 'artikel_hukums';
    protected $fillable = ['judul', 'tanggal_terbit', 'abstrak'];
}
