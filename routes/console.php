<?php

use App\Notifications\LoanLateMail;
use Domain\Books\Models\Book;
use Domain\Flights\Models\Flight;
use Domain\Loans\Models\Loan;
use Domain\Users\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function(){
    $flights=Flight::where(['state', 'waiting']||['state', 'full'])->where('date', '=', date('Y-m-d'))->get();
    if(count($flights)>=1){
        foreach($flights as $flight){
            $flight->forceFill([
                'state'=>'travelling',
            ])->save();
        }
    }
    $flights=Flight::where('state', 'travelling')->where('date', '>', date('Y-m-d'))->get();
    if(count($flights)>=1){
        foreach($flights as $flight){
            $flight->forceFill([
                'date' => fake()->dateTimeBetween($startDate='now', $endDate='+1 year'),
                'state'=>'waiting',
            ])->save();
        }
    }
})->timezone('Europe/Madrid')->cron('0 12 * * *');
