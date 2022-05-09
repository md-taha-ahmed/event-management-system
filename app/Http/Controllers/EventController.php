<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function show(Request $request)
    {
        $owner_id = \auth()->user()->id;
        $query = Event::query()->where('owner_id', $owner_id);


        $query = Event::query();
        if ($search = $request->input(key: 'search')) {
            $query->whereRaw(sql: "name LIKE '%" . $search . "%'");
        }
        if ($sort = $request->input(key: 'sort')) {
            $query->orderBy('date', $sort);
        }
        if ($request->input(key: 'from') &&  $request->input(key: 'to')) {
            $from = $request->input(key: 'from');
            $to = $request->input(key: 'to');
            $query->whereRaw(sql: "date between  '$from' AND '$to' ");
            $query->whereRaw(sql: "date between  '$from' AND '$to' ");
        }
        $perPage = 9;
        $page = $request->input(key: 'page', default: 1);
        $total = $query->count();
        $result = $query->offset(\value($page - 1) * $perPage)->limit($perPage)->get();
        return [
            'data' => $result,
            'total' => $total,
            'page' => $page,
            'last page' => \ceil(num: $total / $perPage)
        ];
    }
}
