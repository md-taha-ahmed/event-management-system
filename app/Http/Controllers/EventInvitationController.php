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
    public function invite(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
        ]);
        // $owner_id = \auth()->user()->id;
        $event_details = Event::firstWhere('name', $fields['name']);
        $guest_details = User::firstWhere('email', $fields['email']);
        // $guest_check = DB::table('event_invitations')->where('guest_id', $guest_details->id)->get();
        $guest_check = EventInvitation::firstWhere('guest_id', $guest_details->id);
        if (empty($guest_check)) {
            $event_invitation = EventInvitation::create([
                'event_id' => $event_details->id,
                'guest_id' => $guest_details->id,
            ]);

            $response = [
                'event' => $event_invitation,
            ];
            return response($response, 201);
        } else {
            return 'the user is already invited';
        }
        // return ([
        //     'event_details' => $event_details,
        //     'guest_details' => $guest_details,
        //     'guest_check' => $guest_check
        // ]);
    }
}
