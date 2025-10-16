<?php

namespace App\Enums;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

trait EnumHelper
{
    public function title(): string
    {
        return Str::of($this->name)
            ->replace('_', ' ')
            ->title()
            ->value();
    }

    public static function collect(): Collection
    {
        return collect(self::cases());
    }

    public static function options(): array
    {
        return self::collect()->mapWithKeys(function (self $item) {
            return [$item->value => $item->title()];
        })->toArray();
    }
}
