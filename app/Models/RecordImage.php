<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property int $record_id
 * @property string $original_name
 * @property string $path
 * @property string $mime_type
 * @property int $size
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Record $record
 */
final class RecordImage extends Model
{
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
     * Make the url for the image.
     *
     * @return string
     */
    public function url(): string
    {
        return Storage::temporaryUrl($this->path, now()->addMinutes(5));
    }
}
