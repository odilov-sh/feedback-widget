<?php

namespace App\Enums;

enum TicketStatusEnum: string
{
    use EnumHelper;

    case NEW = 'new';

    case IN_PROGRESS = 'in_progress';

    case DONE = 'done';

    public function isDone(): bool
    {
        return $this === self::DONE;
    }
}
