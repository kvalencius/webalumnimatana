<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'bigint';
    
    protected $fillable = [
        'user_id',
        'nim',
        'graduation_year',
        'major',
        'current_job',
        'company_name',
        'job_position',
        'salary_range',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tracerStudy()
    {
        return $this->hasOne(TracerStudy::class, 'alumni_id', 'user_id');
    }
}
