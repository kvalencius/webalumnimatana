<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Major extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     * Secara default Laravel akan menganggap tabelnya bernama 'majors'.
     */
    protected $table = 'majors';

    /**
     * Kolom yang dapat diisi melalui mass assignment.
     * Ini penting agar Anda bisa menyimpan nama jurusan (Informatika, Manajemen, dll).
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relasi One-to-Many ke model Alumni.
     * Satu jurusan bisa dimiliki oleh banyak alumni.
     */
    public function alumni(): HasMany
    {
        return $this->hasMany(Alumni::class, 'major', 'name');
    }
}