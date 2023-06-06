<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Project;
use Carbon\Carbon;
class EventsController extends Controller
{
    public function index()
    {
    	$projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
    	$events = Event::with('project')->get();
    	return view('events.index', compact('projects', 'events'));
    }

    public function store(Request $request)
    {

    	$this->validate(request(), [
    		'event_name'	=> 'required',
    		'description'	=> 'required',
    		'event_type'	=> 'required',
			'date' => 'required|date',
            'eventsTargetDeadline' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $start_date = $request->input('date');
                    $start_timestamp = strtotime($start_date);
                    $end_timestamp = strtotime($value);

                    if ($end_timestamp <= strtotime('yesterday')) {
                        $fail('End date cannot be yesterday.');
                    }

                    if ($end_timestamp < $start_timestamp) {
                        $fail('End date cannot be before the start date.');
                    }
                }
            ],
    		'venue'	=> 'required',
    		'project'	=> 'required',
    	]);

    	$projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
		$project = Project::findOrFail(request('project'));
		$user = auth()->user();

    	$event = Event::create([
			'creator_id'	=> $user->id,
    		'project_id'	=> $project->id,
			'events_createdby' => $user->first_name . ' ' . $user->last_name,
    		'event_name'	=> request('event_name'),
    		'description'	=> request('description'),
    		'event_type'	=> request('event_type'),
    		'venue'	=> request('venue'),
    		'date'	=> Carbon::parse(request('date')),
			'eventsTargetDeadline'	=> Carbon::parse(request('eventsTargetDeadline')),
    		'status'	=> 'Pending'
    	]);


    	return back()->with('success', 'Event has been added!');
    }

    public function edit(Event $event)
    {
    	$projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
    	return view('events.edit', compact('event','projects'));
    }

    public function update(Event $event)
    {

    	$this->validate(request(), [
    		'event_name'	=> 'required',
    		'description'	=> 'required',
    		'event_type'	=> 'required',
    		'date'	=> 'required',
    		'venue'	=> 'required',
    		'project'	=> 'required',
    	]);

    	$project = Project::find(request('project'));

    	$event->update([
    		'project_id'	=> $project->id,
    		'event_name'	=> request('event_name'),
    		'description'	=> request('description'),
    		'event_type'	=> request('event_type'),
    		'venue'	=> request('venue'),
    		'date'	=> Carbon::parse(request('date')),
    		'status'	=> 'Pending'
    	]);
    	return redirect('/pending-events')->with('info', 'Event has been updated!');
    }

    public function show(Event $event)
    {
    	return view('events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
    	$event->delete();

    	return back()->with('error', 'Event has been removed!');
    }

    public function pending()
    {
        $events = Event::where('status', 'Pending')->get();

        return view('events.pending-events', compact('events'));
    }

	public function cancelledView()
    {
        $events = Event::where('status', 'Cancelled')->get();

        return view('events.rejected-events', compact('events'));
    }

	public function approvedView()
    {
        $events = Event::where('status', 'Approved')->get();

        return view('events.approved-events', compact('events'));
    }

	public function archivedView()
    {
        $events = Event::where('status', 'Archived')->get();

        return view('events.archived-events', compact('events'));
    }


	
    public function approved(Event $event)
    {
		$user = auth()->user();
        $event->update([
			'events_approvedby' => $user->first_name . ' ' . $user->last_name,
			'approver_id'	=> $user->id,
            'status'    => 'Approved'
        ]);

        return back()->with('success', 'Event has been approved!');
    }  

    public function cancelled(Event $event)
    {
		$user = auth()->user();
        $event->update([
			'events_approvedby' => $user->first_name . ' ' . $user->last_name,
			'approver_id'	=> $user->id,
            'status'    => 'Cancelled',
			'events_comments' =>  request('description'),
        ]);

        return back()->with('success', 'Event has been cancelled!');
    }

	public function archived(Event $event)
    {
		$user = auth()->user();
        $event->update([
			'archiver_name' => $user->first_name . ' ' . $user->last_name,
			'archiver_id'	=> $user->id,
            'status'    => 'Archived',
        ]);

        return back()->with('success', 'Event has been cancelled!');
    }



	
}
