<?php

namespace App\Policies;

use App\Models\RecordCategory;
use App\Models\User;

class RecordCategoryPolicy
{
    /**
     * Determine whether the use can view any record category.
     *
     * @param \App\Models\User $user
     * @return true
     */
    public function viewAny(User $user): true
    {
        return true;
    }

    /**
     * Determine whether the user can view the record category.
     *
     * @param \App\Models\User $user
     * @param \App\Models\RecordCategory $recordCategory
     * @return bool
     */
    public function view(User $user, RecordCategory $recordCategory): bool
    {
        return $user->id === $recordCategory->user_id;
    }

    /**
     * Determine whether the user can create record categories.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('viewAny', RecordCategory::class);
    }

    /**
     * Determine whether the user can update the specified category.
     *
     * @param \App\Models\User $user
     * @param \App\Models\RecordCategory $recordCategory
     * @return bool
     */
    public function update(User $user, RecordCategory $recordCategory): bool
    {
        return $user->can('view', $recordCategory);
    }

    /**
     * Determine whether the user can delete the specified category.
     *
     * @param \App\Models\User $user
     * @param \App\Models\RecordCategory $recordCategory
     * @return bool
     */
    public function delete(User $user, RecordCategory $recordCategory): bool
    {
        return $user->can('update', $recordCategory);
    }
}
