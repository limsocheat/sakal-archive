<?php

namespace Modules\Academic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicCard extends Model
{
    use HasFactory;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'code',
        'student_id',
        'faculty_id',
        'major_id',
        'academic_year_id',
        'academic_generation_id',
        'expired_at',
        'status',
        'description',
        'active',
    ];

    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Academic\Database\Factories\AcademicCardFactory::new();
    }

    /**
     * Get faculty that owns the academic card.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Get major that owns the academic card.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    /**
     * Get academic year that owns the academic card.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Get academic generation that owns the academic card.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function academicGeneration()
    {
        return $this->belongsTo(AcademicGeneration::class);
    }
}
