<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventInvitationController extends Controller
{
    public function create(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|exists:events,name',
            'email' => 'required|string|email|exists:users,email',
        ]);
        $event_details = Event::firstWhere('name', $fields['name']);
        $guest_details = User::firstWhere('email', $fields['email']);
        $guest_check = EventInvitation::query()
            ->where('guest_id', $guest_details->id)
            ->where('event_id', $event_details->id)->get();
        if (!\blank($guest_check)) {
            return 'the user is already invited';
        }
        $event_invitation = EventInvitation::create([
            'event_id' => $event_details->id,
            'guest_id' => $guest_details->id,
        ]);

        $response = [
            'event' => $event_invitation,
        ];
        return response($response, 201);
    }

    public function show(Request $request)
    {
        $guest_id = \auth()->user()->id;
        $query = EventInvitation::query()
            ->join('events', 'events.id', 'event_invitations.event_id')
            ->join('users', 'users.id', 'events.owner_id')
            ->where('guest_id', $guest_id);
        if ($search = $request->input(key: 'search')) {
            $query->whereRaw(sql: "events.name LIKE '%" . $search . "%'");
        }
        if ($sort = $request->input(key: 'sort')) {
            $query->orderBy('events.date', $sort);
        }
        if ($request->input(key: 'from') &&  $request->input(key: 'to')) {
            $from = $request->input(key: 'from');
            $to = $request->input(key: 'to');
            $query->whereRaw(sql: "events.date between  '$from' AND '$to' ");
        }
        $perPage = 9;
        $page = $request->input(key: 'page', default: 1);
        $total = $query->count();
        $result = $query->offset(\value($page - 1) * $perPage)->limit($perPage)
            ->get([
                'events.name AS event_name',
                'users.name AS owner_name',
                'events.description AS event_description',
                'events.location AS event_location',
                'events.date AS event_date',
            ]);
        return [
            'data' => $result,
            'total' => $total,
            'page' => $page,
            'last page' => \ceil(num: $total / $perPage)
        ];
    }
}
