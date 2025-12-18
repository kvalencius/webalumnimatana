<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    use HasFactory;

    protected $table = 'job_vacancies';

    protected $fillable = [
        'judul',
        'perusahaan',
        'tipe_pekerjaan',
        'lokasi',
        'deskripsi',
        'persyaratan',
        'gaji_min',
        'gaji_max',
        'kontak_email',
        'kontak_phone',
        'status', // Tetap ada di fillable untuk berjaga-jaga, meski default 'approved'
        'posted_by',
    ];

    protected $casts = [
        'gaji_min' => 'decimal:2',
        'gaji_max' => 'decimal:2',
    ];

    // ========================================
    // RELATIONSHIPS
    // ========================================
    
    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    // ========================================
    // ACCESSORS (Computed Properties)
    // ========================================
    
    /**
     * Format gaji dengan rupiah
     * Usage: $job->formatted_gaji
     */
    public function getFormattedGajiAttribute()
    {
        if ($this->gaji_min && $this->gaji_max) {
            return 'Rp ' . number_format($this->gaji_min, 0, ',', '.') . 
                   ' - Rp ' . number_format($this->gaji_max, 0, ',', '.');
        }
        
        if ($this->gaji_min && !$this->gaji_max) {
            return 'Mulai dari Rp ' . number_format($this->gaji_min, 0, ',', '.');
        }
        
        if (!$this->gaji_min && $this->gaji_max) {
            return 'Hingga Rp ' . number_format($this->gaji_max, 0, ',', '.');
        }
        
        return 'Nego';
    }

    /**
     * Waktu relatif sejak posting
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Format tipe pekerjaan yang lebih readable
     */
    public function getTipePekerjaanLabelAttribute()
    {
        $labels = [
            'full_time'  => 'Full Time',
            'part_time'  => 'Part Time',
            'internship' => 'Internship',
            'contract'   => 'Kontrak',
            'freelance'  => 'Freelance',
        ];

        return $labels[$this->tipe_pekerjaan] ?? ucfirst(str_replace('_', ' ', $this->tipe_pekerjaan));
    }

    // ========================================
    // PERMISSION CHECKERS
    // ========================================

    /**
     * Check apakah user adalah pemilik loker ini
     * Hanya alumni yang bisa memiliki loker
     */
    public function isOwnedBy($user)
    {
        if (!$user) return false;
        return $this->posted_by === $user->id;
    }

    /**
     * Karena tidak ada admin, hanya pemilik (Alumni) yang bisa edit/delete
     */
    public function canBeManagedBy($user)
    {
        return $this->isOwnedBy($user);
    }
}