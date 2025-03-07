<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth;
use Illuminate\Notifications\Notifiable;

/**
 * @property-read int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Record> $records
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RecordCategory> $recordCategories
 */
class User extends Auth\User
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Query the records.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Record, $this>
     */
    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }

    /**
     * Query the record categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Record, $this>
     */
    public function recordCategories(): HasMany
    {
        return $this->hasMany(RecordCategory::class);
    }
}
