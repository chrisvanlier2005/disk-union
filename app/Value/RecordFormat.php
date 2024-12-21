<?php

namespace App\Value;

enum RecordFormat: string
{
    case LP = 'lp';
    case CD = 'cd';

    public function displayName(): string
    {
        return match ($this) {
            self::LP => 'LP',
            self::CD => 'CD',
        };
    }
}
