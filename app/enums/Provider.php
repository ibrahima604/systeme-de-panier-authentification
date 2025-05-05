<?php

namespace App\Enums;

enum Provider: string
{
    case GOOGLE = 'google';
    case FACEBOOK = 'facebook';
    case GITHUB = 'github';
    case LINKEDIN = 'linkedin';

    public function getDisplayName(): string
    {
        return match ($this) {
            self::GOOGLE => 'Google',
            self::FACEBOOK => 'Facebook',
            self::GITHUB => 'GitHub',
            self::LINKEDIN => 'LinkedIn',
        };
    }
}