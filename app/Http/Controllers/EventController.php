<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreEventRequest;
// use App\Http\Requests\UpdateEventRequest;
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
<<<<<<< HEAD
        $query = Event::query()->where('owner_id', $owner_id);
=======
        // $all = Event::select('*')->where('owner_id', $owner_id)->paginate(1);
        // return $all;
        // $query->where('owner_id', $owner_id)->paginate(1);
        // $query->whereRaw(sql: "owner_id='$owner_id'")->paginate(1);
        // $query = DB::table('events')->select('*')->get()->paginate(2);
        // return $query;

        $query = Event::query();
>>>>>>> d51bd84f02ce5fe36d7fdf6f6f49ec4f9909e044
        if ($search = $request->input(key: 'search')) {
            $query->whereRaw(sql: "name LIKE '%" . $search . "%'");
        }
        if ($sort = $request->input(key: 'sort')) {
            $query->orderBy('date', $sort);
        }
        if ($request->input(key: 'from') &&  $request->input(key: 'to')) {
            $from = $request->input(key: 'from');
            $to = $request->input(key: 'to');
<<<<<<< HEAD
            $query->whereRaw(sql: "date between  '$from' AND '$to' ");
=======
            // $query->whereRaw(sql: "date between  '2020-01-01' AND '2022-01-01' ");
            $query->whereRaw(sql: "date between  '$from' AND '$to' ");
            // echo "date between '$from'AND'$to'";
            // echo $from, $to;
>>>>>>> d51bd84f02ce5fe36d7fdf6f6f49ec4f9909e044
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
