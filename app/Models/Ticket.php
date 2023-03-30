<?php

namespace App\Models;

use App\Enums\Priority;
use App\Enums\UserRole;
use App\Traits\Searchable;
use App\Enums\TicketStatus;
use App\Traits\CheckTicketStatus;
use App\Traits\ChangeTicketStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    use HasFactory,
        ChangeTicketStatus,
        CheckTicketStatus,
        Searchable;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'priority',
        'role',
        'status',
        'resolved',
    ];

    protected $casts = [
        'priority' => Priority::class,
        'status' => TicketStatus::class,
        'role' => UserRole::class,
    ];

    protected $searchable = [
        'title',
        'description',
    ];

    protected $appends = [
        'is_new',
        'is_close',
        'is_archive',
        'is_open',
        'create_at_diff_humans'
    ];

    public function createAtDiffHumans(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->created_at->diffForHumans()
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

}
