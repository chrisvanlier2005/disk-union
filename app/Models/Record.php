<?php

namespace App\Models;

use App\Value\RecordFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @property-read int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $artist
 * @property string|null $label
 * @property string|null $code
 * @property string|null $genre
 * @property string|null $country
 * @property \Carbon\Carbon|null $release_date
 * @property string $format
 * @property int|null $rpm
 * @property string|null $color
 * @property bool $is_limited_edition
 * @property int|null $edition_number
 * @property string|null $condition
 * @property string|null $barcode
 * @property int|null $total_tracks
 * @property string|null $spine_title
 * @property string|null $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RecordImage> $recordImages
 */
final class Record extends Model
{
    /** @use HasFactory<\Database\Factories\RecordFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return list<string>
     */
    public function casts(): array
    {
        return [
            'release_date' => 'datetime',
            'format' => RecordFormat::class,
        ];
    }

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
     * Query the record images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\RecordImage, $this>
     */
    public function recordImages(): HasMany
    {
        return $this->hasMany(RecordImage::class);
    }

    /**
     * Get the record's thumbnail.
     *
     * @return string|null
     */
    public function thumbnail(): ?string
    {
        $image = $this->recordImages?->first();

        if ($image === null) {
            // TODO: Make a custom default image.
            return 'https://community.mp3tag.de/uploads/default/original/2X/a/acf3edeb055e7b77114f9e393d1edeeda37e50c9.png';
        }

        return Storage::temporaryUrl($image?->path, now()->addMinutes(5));
    }
}
