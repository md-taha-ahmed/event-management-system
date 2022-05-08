<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventInvitationRequest;
use App\Http\Requests\UpdateEventInvitationRequest;
use App\Models\EventInvitation;

class EventInvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventInvitationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventInvitationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventInvitation  $eventInvitation
     * @return \Illuminate\Http\Response
     */
    public function show(EventInvitation $eventInvitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventInvitation  $eventInvitation
     * @return \Illuminate\Http\Response
     */
    public function edit(EventInvitation $eventInvitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventInvitationRequest  $request
     * @param  \App\Models\EventInvitation  $eventInvitation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventInvitationRequest $request, EventInvitation $eventInvitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventInvitation  $eventInvitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventInvitation $eventInvitation)
    {
        //
    }
}
