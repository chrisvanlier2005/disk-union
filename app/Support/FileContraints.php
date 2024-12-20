<?php

namespace App\Support;

class FileContraints
{
    public static function maxImageSize(): int
    {
        return 2048; // 2MB
    }
}
