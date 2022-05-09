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
            'email' => 'required|string|email',
        ]);
        $owner_id = \auth()->user()->id;
        $event_details = Event::firstWhere('owner_id', $owner_id);
        $guest_details = User::firstWhere('email', $fields['email']);
        $guest_check = DB::table('event_invitations')->where('guest_id', $guest_details->id)->get();
        if (\blank($guest_check)) {
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
        return $guest_check;
    }
}
