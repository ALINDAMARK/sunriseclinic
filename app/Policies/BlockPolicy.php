<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Block;

class BlockPolicy
{
    /**
     * Determine whether the user can create blocks.
     * For now allow users listed in config('app.block_admins') or emails ending with '@sunriseclinic.local'.
     */
    public function create(User $user)
    {
        // Prefer explicit DB flag for admins
        if (!empty($user->is_admin)) {
            return true;
        }
        // Fallback to config list or domain heuristic for legacy setups
        $admins = config('app.block_admins', []);
        if (in_array($user->email, $admins)) return true;
        return str_ends_with($user->email ?? '', '@sunriseclinic.local');
    }

    /**
     * Determine whether the user can delete the block.
     */
    public function delete(User $user, Block $block)
    {
        // same rule for deletions
        return $this->create($user);
    }
}
