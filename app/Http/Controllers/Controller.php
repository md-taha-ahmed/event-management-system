<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventInvitation;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function showEvent(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|exists:events,name'
        ]);
        $query1 = Event::query();
        $query2 = EventInvitation::query()
            ->join('users', 'event_invitations.guest_id', 'users.id');

        $query1->whereRaw(sql: "events.name LIKE '%" . $fields['name'] . "%'");

        return [
            'event details' => $query1->get(),
            'users invited' => $query2->get([
                'users.name AS guest_name',
                'users.email AS guest_email',
            ]),
        ];
    }
}
