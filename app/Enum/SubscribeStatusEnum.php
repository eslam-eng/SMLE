<?php

namespace App\Enum;

enum SubscribeStatusEnum:string
{
    case PENDING = 'pending';
    case INPROGRESS = 'in_progress';
    case IN_REVIEW = 'in_review';
    case COMPLETED = 'completed';
    case FINISHED = 'finished';
}
