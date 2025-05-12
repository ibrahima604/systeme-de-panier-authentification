<?php

namespace App\Enums;

enum Provider: string
{
    case GOOGLE = 'google';
    case GITHUB = 'github';
    case LINKEDIN = 'linkedin';

    public function getDisplayName(): string
    {
        return match ($this) {
            self::GOOGLE => 'Google',
            self::GITHUB => 'GitHub',
            self::LINKEDIN => 'LinkedIn',
        };
    }
}