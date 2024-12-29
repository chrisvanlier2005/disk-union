<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property-read int $id
 * @property int $record_id
 * @property string $title
 * @property int $duration The tracks duration in seconds.
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\Record $record
 */
final class Track extends Model
{
    /** @use HasFactory<\Database\Factories\TrackFactory> */
    use HasFactory;

    /**
     * Query the record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Record, $this>
     */
    public function record(): BelongsTo
    {
        return $this->belongsTo(Record::class);
    }

    /**
     * Get the track's duration formatted as `mm:ss`
     *
     * @return string
     */
    public function getFormattedDuration(): string
    {
        $minutes = floor($this->duration / 60);
        $seconds = $this->duration - $minutes * 60;

        $minutes = Str::padLeft($minutes, 2, '0');
        $seconds = Str::padLeft($seconds, 2, '0');

        return "{$minutes}:{$seconds}";
    }
}
