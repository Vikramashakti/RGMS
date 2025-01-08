<?php

namespace App\Providers;

use App\Models\Academician;
use App\Models\ResearchGrant;
use App\Models\ProjectMilestone;
use App\Models\ProjectMember;

use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Gate;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
    Schema::defaultStringLength(191);

    //ACADEMICIANS
    Gate::define('view-academicians', function ($user) {
        return $user->user_level == 4;  // Only Admin
    });

    Gate::define('create-academician', function ($user) {
        return $user->user_level == 4;  // Only Admin
    });

    Gate::define('edit-academician', function ($user, Academician $academician) {
        return $user->user_level == 4;  // Only Admin
    });

    Gate::define('view-academician', function ($user, Academician $academician) {
        // Any user level can view, but ensure project leader can view their own academics
        return $user->user_level >= 0; // Everyone can view but logic can be customized
    });

    Gate::define('delete-academician', function ($user, Academician $academician) {
        return $user->user_level == 4;  // Only Admin
    });

    //RESEARCH GRANTS
    Gate::define('view-research-grants', function ($user) {
        return $user->user_level >= 2;  // Admin Executive or Staff or Leader
    });

    Gate::define('create-research-grant', function ($user) {
        return $user->user_level >= 3;  // Admin Executive or Staff
    });

    Gate::define('edit-research-grant', function ($user, ResearchGrant $researchGrant) {
        return $user->user_level >=3; // Admin Executive, Staff and Project Leader
    });

    Gate::define('view-research-grant', function ($user, ResearchGrant $researchGrant) {
        // Check if the user_level is >= 2
        $hasUserLevel = $user->user_level >= 2;
    
        // Check if the user has a role of 1 in the project_members table
        $hasProjectMemberRole = ProjectMember::whereHas('academician', function($query) use ($user) {
            $query->where('users_id', $user->id);
        })
        ->where('role', 1)  // Assuming role 1 corresponds to Member
        ->exists();
    
        // Allow access if either condition is true
        return $hasUserLevel || $hasProjectMemberRole;
    });
    

    Gate::define('delete-research-grant', function ($user, ResearchGrant $researchGrant) {
        return $user->user_level >= 3;  // Admin Executive or Staff
    });

    //PROJECT MILESTONES

    //Admin, Project Leader, Project Member
    Gate::define('view-project-milestones', function ($user) {
        // Check if user_level is 4 or 2
        $hasUserLevel = in_array($user->user_level, [4, 2]); 
    
        // Check if the user has a role in the project_members table via the academicians table
        $hasProjectMemberRole = ProjectMember::whereHas('academician', function($query) use ($user) {
            $query->where('users_id', $user->id);
        })
        ->where('role', 1)  // Adjust role condition as needed
        ->exists();
        
        // Allow access if either condition is true
        return $hasUserLevel || $hasProjectMemberRole;
    });

    //Admin, Project Leader
    Gate::define('create-project-milestone', function ($user) {
        // Allow access if user_level is 4 or 2
        return in_array($user->user_level, [4, 2]);
    });
    
    //Admin, Project Leader
    Gate::define('edit-project-milestone', function ($user, ProjectMilestone $projectMilestone) {
        // Project Leader or Admin Executive can edit
        return in_array($user->user_level, [4, 2]);
    });

    Gate::define('view-project-milestone', function ($user, ProjectMilestone $projectMilestone) {
        // Check if user_level is 4 or 2
        $hasUserLevel = in_array($user->user_level, [4, 2]); 
    
        // Check if the user has a role in the project_members table via the academicians table
        $hasProjectMemberRole = ProjectMember::whereHas('academician', function($query) use ($user) {
            $query->where('users_id', $user->id);
        })
        ->where('role', 1)  // Adjust role condition as needed
        ->exists();
        
        // Allow access if either condition is true
        return $hasUserLevel || $hasProjectMemberRole;
    });
    

    Gate::define('delete-project-milestone', function ($user, ProjectMilestone $projectMilestone) {
        return $user->user_level == 4;  // Admin Executive only
    });

    //PROJECT MEMBERS

    Gate::define('view-project-members', function ($user) {
        // Check if user_level is 4 or 2
        $hasUserLevel = in_array($user->user_level, [4, 2]); 
    
        // Check if the user has a role in the project_members table via the academicians table
        $hasProjectMemberRole = ProjectMember::whereHas('academician', function($query) use ($user) {
            $query->where('users_id', $user->id);
        })
        ->where('role', 1)  // Adjust role condition as needed
        ->exists();
        
        // Allow access if either condition is true
        return $hasUserLevel || $hasProjectMemberRole;
    });

    Gate::define('create-project-member', function ($user) {
        return in_array($user->user_level, [4, 2]);  // Project Leader or Admin Executive
    });

    Gate::define('view-project-member', function ($user, ProjectMember $projectMember) {
        // Admin Executive, Staff, or Project Leader for related research grant
        return in_array($user->user_level, [4, 2]);
    });

    Gate::define('delete-project-member', function ($user, ProjectMember $projectMember) {
        return in_array($user->user_level, [4, 2]);
    });
    }
}