<?php

namespace App\Traits;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait CheckTicketStatus
{
    public function isNew(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status == TicketStatus::NEW->value
        );
    }

    public function isOpen(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status == TicketStatus::OPENED->value
        );
    }

    public function isClose(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status == TicketStatus::CLOSED->value
        );
    }

    public function isArchive(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status == TicketStatus::ARCHIVED->value
        );
    }
}
