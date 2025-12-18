<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerStudy extends Model
{
    use HasFactory;
    
    protected $table = 'tracer_studies';
    
    protected $fillable = [
        'alumni_id',
        'survey_date',
        'status',
        'current_company',
        'current_position',
        'funding_source',
        'f21_perkuliahan',
        'f22_demonstrasi',
        'f23_riset_project',
        'f24_magang',
        'f25_praktikum',
        'f26_kerja_lapangan',
        'f27_diskusi',
    ];

    protected $casts = [
        'survey_date' => 'date',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id', 'user_id');
    }
}
