<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMilestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_grant_id',
        'milestone_name',
        'target_completion_date',
        'deliverable',
        'status',
        'remark',
        'date_updated',
    ];

    public function researchGrant()
    {
        return $this->belongsTo(ResearchGrant::class);
    }
}

