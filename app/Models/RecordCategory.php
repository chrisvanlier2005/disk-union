<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read int $id
 * @property int $user_id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read int|null $records_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Record> $records
 */
final class RecordCategory extends Model
{
    /** @use HasFactory<\Database\Factories\RecordCategoryFactory> */
    use HasFactory;

    /**
     * Query the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Query the records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Record, $this>
     */
    public function records(): BelongsToMany
    {
        return $this->belongsToMany(Record::class);
    }
}
