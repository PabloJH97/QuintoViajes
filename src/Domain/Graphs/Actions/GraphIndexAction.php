<?php

namespace Domain\Graphs\Actions;

use Domain\Books\Models\Book;
use Domain\Flights\Models\Flight;
use Domain\Users\Models\User;
use Domain\Zones\Models\Zone;

class GraphIndexAction
{
    public function __invoke()
    {
        $userData=[];
        $users=User::withCount('tickets')->get();
        foreach($users as $user){
            if($user->tickets_count>0){
                $user->totalActions=$user->tickets_count;
                array_push($userData, $user);
            }
        }
        $userData=collect($userData)->sortBy('totalActions', 0 , 'desc')->toArray();
        $userData=array_values($userData);
        $userData=array_slice($userData, 0, 10);
        $flightData=[];
        $flights=Flight::withCount('tickets')->get();
        foreach($flights as $flight){
            if($flight->tickets_count>0){
                $flight->totalActions=$flight->tickets_count;
                array_push($flightData, $flight);
            }
        }
        $flightData=collect($flightData)->sortBy('totalActions', 0 , 'desc')->toArray();
        $flightData=array_values($flightData);
        $flightData=array_slice($flightData, 0, 10);
        // $zoneData=[];
        // $zones=Zone::with('bookshelves.books')->get();
        // foreach($zones as $zone){
        //     $totalLoans=0;
        //     $totalReservations=0;
        //     foreach($zone->bookshelves as $bookshelf){
        //         foreach($bookshelf->books as $book){
        //             $totalLoans+=$book->loans->count();
        //             $totalReservations+=$book->reservations->count();
        //         }
        //     }
        //     array_push($zoneData, [$zone, $totalLoans, $totalReservations]);
        // }


        $data=['userData'=>$userData, 'flightData'=>$flightData];


        return $data;
    }
}
