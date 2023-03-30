<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::factory(20)->create()->each(function ($ticket) {

            $ticket->labels()->attach([rand(1, 2), rand(2, 3)]);

            $ticket->categories()->attach([rand(1, 2), rand(2, 3)]);
        });
    }
}
