<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumni';
    protected $primaryKey = 'user_id'; // Sesuai database Anda
    public $incrementing = false;
    public $timestamps = false; // Karena tabel alumni Anda tidak punya created_at

    protected $fillable = [
        'user_id', 'nim', 'graduation_year', 'major', 'phone'
    ];

    public function user()
    {
        // Menghubungkan user_id di tabel alumni ke id di tabel users
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}