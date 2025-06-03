<?php

namespace Database\Seeders;

use Domain\Flight_Ticket\Models\Flight_Ticket;
use Domain\Flights\Models\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class Flight_TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Flight_Ticket::factory(20)->create();
    }
}
