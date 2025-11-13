<?php

namespace App\Policies;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any doctors.
     */
    public function viewAny(User $user)
    {
        // any authenticated staff can view
        return (bool) $user;
    }

    /**
     * Determine whether the user can create doctors.
     */
    public function create(User $user)
    {
        return (bool) $user->is_admin;
    }

    /**
     * Determine whether the user can update the doctor.
     */
    public function update(User $user, Doctor $doctor)
    {
        return (bool) $user->is_admin;
    }

    /**
     * Determine whether the user can delete the doctor.
     */
    public function delete(User $user, Doctor $doctor)
    {
        return (bool) $user->is_admin;
    }
}
