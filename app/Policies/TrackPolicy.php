<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;

class TrackPolicy
{
    public function create(User $user, Record $record)
    {
        return $user->can('view', $record);
    }
}
