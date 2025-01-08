<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academician extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'staff_number', 
        'college', 
        'department', 
        'position',
        'users_id' // Add users_id to the fillable array
    ];

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); // Reference the foreign key (users_id)
    }

    public function projectLeads()
    {
        return $this->hasMany(ResearchGrant::class, 'project_leader_id');
    }

    public function projectMemberships()
    {
        return $this->belongsToMany(ResearchGrant::class, 'project_members')
                    ->withPivot('id')
                    ->withTimestamps();
    }
}
