<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventInvitationsRequest;
use App\Http\Requests\UpdateEventInvitationsRequest;
use App\Models\EventInvitations;

class EventInvitationsController extends Controller
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
     * @param  \App\Http\Requests\StoreEventInvitationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventInvitationsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventInvitations  $eventInvitations
     * @return \Illuminate\Http\Response
     */
    public function show(EventInvitations $eventInvitations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventInvitations  $eventInvitations
     * @return \Illuminate\Http\Response
     */
    public function edit(EventInvitations $eventInvitations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventInvitationsRequest  $request
     * @param  \App\Models\EventInvitations  $eventInvitations
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventInvitationsRequest $request, EventInvitations $eventInvitations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventInvitations  $eventInvitations
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventInvitations $eventInvitations)
    {
        //
    }
}
