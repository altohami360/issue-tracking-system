<?php

namespace App\Enums;

enum TicketStatus: String
{
    case NEW = 'new';
    case OPENED = 'opened';
    case CLOSED = 'closed';
    case ARCHIVED = 'archived';
}
