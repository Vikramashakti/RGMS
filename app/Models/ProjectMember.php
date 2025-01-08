<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_grant_id',
        'academician_id',
        'role', // New field to store the role (e.g., 'leader', 'member')
    ];

    /**
     * Relationship with the ResearchGrant model.
     */
    public function researchGrant()
    {
        return $this->belongsTo(ResearchGrant::class);
    }

    /**
     * Relationship with the Academician model.
     */
    public function academician()
    {
        return $this->belongsTo(Academician::class);
    }
}
