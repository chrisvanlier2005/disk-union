<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\Track;
use App\Models\User;

class TrackPolicy
{
    /**
     * Determine whether the use can create a track.
     *
     * @param User $user
     * @param Record $record
     * @return bool
     */
    public function create(User $user, Record $record): bool
    {
        return $user->can('view', $record);
    }

    /**
     * Determine whether the user can update the specified track.
     *
     * @param User $user
     * @param Track $track
     * @return bool
     */
    public function update(User $user, Track $track): bool
    {
        return $user->can('update', $track->record);
    }

    /**
     * Determine whether the user can delete the specified track.
     */
    public function delete(User $user, Track $track): bool
    {
        return $user->can('update', $track->record);
    }
}
