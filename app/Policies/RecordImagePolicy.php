<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\RecordImage;
use App\Models\User;

class RecordImagePolicy
{
    /**
     * Determine whether the user can create a record image for the specified record.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Record $record
     * @return bool
     */
    public function create(User $user, Record $record): bool
    {
        return $user->can('update', $record);
    }

    /**
     * Determine whether the user can delete the specified record image.
     *
     * @param \App\Models\User $user
     * @param \App\Models\RecordImage $recordImage
     * @return bool
     */
    public function delete(User $user, RecordImage $recordImage): bool
    {
        return $user->can('update', $recordImage->record);
    }
}
