<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;


class EventController extends Controller
{

    public function create(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|unique:events,name',
            'description' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date'
        ]);
        $event = Event::create([
            'name' => $fields['name'],
            'description' => $fields['description'],
            'owner_id' => \auth()->user()->id,
            'location' => $fields['location'],
            'date' => $fields['date']
        ]);

        $response = [
            'event' => $event,
        ];
        return response($response, 201);
    }
}
