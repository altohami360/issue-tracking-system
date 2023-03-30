<?php

namespace App\Traits;

use App\Enums\TicketStatus;

trait ChangeTicketStatus
{
    public function scopeSolve()
    {
        $this->update(['resolved' => true]);
    }

    public function scopeOpen()
    {
        $this->update(['status' => TicketStatus::OPENED->value]);
    }

    public function scopeReopen()
    {
        $this->update(['status' => TicketStatus::OPENED->value]);
    }

    public function scopeClose()
    {
        $this->update(['status' => TicketStatus::CLOSED->value]);
    }

    public function scopeArchive()
    {
        $this->update(['status' => TicketStatus::ARCHIVED->value]);
    }

    public function scopeUnarchived()
    {
        $this->update(['status' => TicketStatus::OPENED->value]);
    }
}
