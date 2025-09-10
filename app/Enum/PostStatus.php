<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PostStatus: string implements HasLabel, HasColor, HasIcon
{
    case Draft = 'draft';
//    case Reviewing = 'reviewing';
    case Published = 'published';
//    case Rejected = 'rejected';
    case Archived = 'archived';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => __('Draft'),
//            self::Reviewing => 'Reviewing',
            self::Published => __('Published'),
//            self::Rejected => 'Rejected',
            self::Archived => __('Archived'),
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Draft => 'gray',
//            self::Reviewing => 'warning',
            self::Published => 'success',
//            self::Rejected => 'danger',
            self::Archived => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Draft => 'heroicon-m-pencil',
//            self::Reviewing => 'heroicon-m-eye',
            self::Published => 'heroicon-m-check',
//            self::Rejected => 'heroicon-m-x-mark',
            self::Archived => 'tabler-archive',
        };
    }
}
