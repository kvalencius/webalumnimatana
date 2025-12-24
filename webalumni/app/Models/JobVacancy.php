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
        'created_by', // ADMIN
    ];

    protected $casts = [
        'gaji_min' => 'integer',
        'gaji_max' => 'integer',
    ];

    // ======================
    // RELATIONSHIP
    // ======================
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // ======================
    // ACCESSORS
    // ======================
    public function getFormattedGajiAttribute()
    {
        if ($this->gaji_min && $this->gaji_max) {
            return 'Rp ' . number_format($this->gaji_min, 0, ',', '.') .
                   ' - Rp ' . number_format($this->gaji_max, 0, ',', '.');
        }

        if ($this->gaji_min) {
            return 'Mulai dari Rp ' . number_format($this->gaji_min, 0, ',', '.');
        }

        if ($this->gaji_max) {
            return 'Hingga Rp ' . number_format($this->gaji_max, 0, ',', '.');
        }

        return 'Nego';
    }

    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getTipePekerjaanLabelAttribute()
    {
        $labels = [
            'full_time'  => 'Full Time',
            'part_time'  => 'Part Time',
            'internship' => 'Internship',
            'contract'   => 'Kontrak',
            'freelance'  => 'Freelance',
        ];

        return $labels[$this->tipe_pekerjaan]
            ?? ucfirst(str_replace('_', ' ', $this->tipe_pekerjaan));
    }
}
