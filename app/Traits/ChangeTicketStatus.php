<?php

namespace App\Traits;

use App\Enums\TicketStatus;

trait ChangeTicketStatus
{
    public function scopeSolve()
    {
        if (!$this->resolved) {
            $this->update(['resolved' => true]);
        }
    }

    public function scopeOpen()
    {
        if ($this->status == TicketStatus::NEW->value) {
            $this->update(['status' => TicketStatus::OPENED->value]);
        }
    }

    public function scopeReopen()
    {
        if ($this->status == TicketStatus::CLOSED->value) {
            $this->update(['status' => TicketStatus::OPENED->value]);
        }
    }

    public function scopeClose()
    {
        if ($this->status != TicketStatus::CLOSED->value) {
            $this->update(['status' => TicketStatus::CLOSED->value]);
        }
    }

    public function scopeArchive()
    {
        if ($this->status != TicketStatus::ARCHIVED->value) {
            $this->update(['status' => TicketStatus::ARCHIVED->value]);
        }
    }

    public function scopeUnarchived()
    {
        if ($this->status == TicketStatus::ARCHIVED->value) {
            $this->update(['status' => TicketStatus::OPENED->value]);
        }
    }
}
