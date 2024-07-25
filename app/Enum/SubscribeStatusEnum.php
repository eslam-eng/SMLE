<?php

namespace App\Enum;

enum SubscribeStatusEnum:string
{
    case PENDING = 'pending';
    case INPROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case FINISHED = 'finished';
}
