<?php

namespace App\Policies;

use App\Models\Section;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class SectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        $hasPermission = $admin->permissions()->where('role', 'read-sections')->first();
        return $hasPermission ? true : false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Admin $admin, Section $section): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Admin $admin): bool
    {

        $hasPermission = $admin->permissions()->where('role', 'create-section')->first();
        return $hasPermission ? true : false;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Admin $admin, Section $section): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Admin $admin, Section $section): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Admin $admin, Section $section): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Admin $admin, Section $section): bool
    {
        //
    }
}