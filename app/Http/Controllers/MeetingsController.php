<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\Project;
use Illuminate\Support\Facades\Storage;

class MeetingsController extends Controller
{
    public function index()
    {
    	$projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
    	$meetings = Meeting::with('project')->get();
    	return view('meetings.index', compact('projects','meetings'));
    }

	public function pending()
    {
    	$projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
    	$meetings = Meeting::where('status', 'Pending')->get();
    	return view('meetings.pending', compact('projects','meetings'));
    }

	public function approvedMeetings()
    {
    	$projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
    	$meetings = Meeting::where('status', 'Approved')->get();
    	return view('meetings.approved', compact('meetings','projects'));
    }

	public function rejectedMeetings()
    {
		$projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
    	$meetings = Meeting::where('status', 'Cancelled')->get();
    	return view('meetings.rejected', compact('meetings','projects'));
    }

	public function archivedMeetings()
    {
		$projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
    	$meetings = Meeting::where('status', 'Archived')->get();
    	return view('meetings.archived', compact('meetings','projects'));
    }




	public function store(Meeting $meeting,Request $request)
	{
		$this->validate(request(), [
    		'meeting_name'		=> 'required',
    		'description'		=> 'required', 
    		'date_time'			=> 'required',
    		'venue'				=> 'required', 
    		'minutes'			=> 'image', 
    		'attendance_image'	=> 'image', 
			'agenda'		=> 'required',
    	]);


    	$project = Project::find(request('project'));
		
		if ($request->hasFile('attendance_image')) {
			$image = $request->file('attendance_image');
			$imageName = time() . '.' . $image->getClientOriginalName();
			$path = $image->storeAs('public/images', $imageName);
		} else{
			$imageName= null;
		}
	
		if ($request->hasFile('minutes')) {
			$imageMinutes = $request->file('minutes');
			$minutesName = time() . '.' . $imageMinutes->getClientOriginalName();
			$minutesPath = $imageMinutes->storeAs('public/minutes', $minutesName);
		} else{
			$minutesName= null;
		}
		$user = auth()->user();

		$project_id = request('project') ? request('project') : null;
    	$meeting::create([
    		'project_id'	=> $project_id,
			'meeting_sponsor'	=> request('meeting_sponsor'),
    		'meeting_name'	=> request('meeting_name'),
    		'description'	=> request('description'),
    		'date_time'		=> request('date_time'),
    		'venue'			=> request('venue'),
    		'minutes'		=> $minutesName,
    		'attendance_image'	=> $imageName,
			'status'		=>	'Pending', 
			'creator_id' => $user->id, 
			'creator_name'	=> $user->first_name . ' ' . $user->last_name,
			'agenda'		=> request('agenda'),
    	]);
	
		return back()->with('success', 'Meeting has been added!');
	}
	
	

    public function edit(Meeting $meeting)
    {
    	$projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
    	return view('meetings.edit', compact('meeting', 'projects'));
    }

    public function update(Meeting $meeting, Request $request)
    {
    	$this->validate(request(), [
    		'project'			=> 'required',
    		'meeting_name'		=> 'required',
    		'description'		=> 'required', 
    		'date_time'			=> 'required',
    		'venue'				=> 'required', 
			'minutes'			=> 'image', 
    		'attendance_image'	=> 'image', 
			'previous_minutes'  => 'image', 
			'agenda'            => 'required',
    	]);


    	$project = Project::find(request('project'));

		if ($request->hasFile('attendance_image')) {
			$image = $request->file('attendance_image');
			$imageName = time() . '.' . $image->getClientOriginalName();
			$path = $image->storeAs('public/images', $imageName);
		}else {
			$imageName = $meeting->attendance_image;
		}

		if ($request->hasFile('minutes')) {
			$imageMinutes = $request->file('minutes');
			$minutesName = time() . '.' . $imageMinutes->getClientOriginalName();
			$minutesPath = $imageMinutes->storeAs('public/minutes', $minutesName);
		}else {
			$minutesName = $meeting->minutes;
		}

		if ($request->hasFile('previous_minutes')) {
			$previous_imageMinutes = $request->file('previous_minutes');
			$previous_minutesName = time() . '.' . $previous_imageMinutes->getClientOriginalName();
			$previous_minutesPath = $previous_imageMinutes->storeAs('public/previous_minutes', $previous_minutesName);
		}else {
			$previous_minutesName = $meeting->previous_meeting;
		}

    	$meeting->update([
    		'project_id'	=> $project->id,
    		'meeting_name'	=> request('meeting_name'),
    		'description'	=> request('description'),
    		'date_time'		=> request('date_time'),
    		'venue'			=> request('venue'),
    		'minutes'		=> $minutesName,
    		'attendance_image'	=> $imageName,
			'previous_meeting' => $previous_minutesName,
			'agenda'		=> request('agenda'),
    	]);

    	return redirect('/pending-meetings')->with('info', 'Meeting has been updated!');
    }

		public function show(Meeting $meeting)
		{
			return view('meetings.show', compact('meeting'));
		}


    public function destroy(Meeting $meeting)
    {
    	$meeting->delete();

    	return back()->with('error', 'Meeting has been removed!');
    }

	public function approved(Meeting $meeting){
		$user = auth()->user();
        $meeting->update([
            'decider_id'  => $user->id,
            'decider_name'  => $user->first_name . ' ' . $user->last_name,
            'status'    => 'Approved'
        ]);
        return back()->with('success', 'Project has been approved!');
	}

	public function rejected(Meeting $meeting){
		$user = auth()->user();
        $meeting->update([
            'decider_id'  => $user->id,
            'decider_name'  => $user->first_name . ' ' . $user->last_name,
            'status'    => 'Cancelled'
        ]);
        return back()->with('error', 'Project has been rejected!');
	}

	public function archive(Meeting $meeting){
		$user = auth()->user();
        $meeting->update([
            'archiver_id'  => $user->id,
            'archiver_name'  => $user->first_name . ' ' . $user->last_name,
            'status'    => 'Archived', 
        ]);
        return back()->with('warning', 'Project has been archived!');
	}
	
}
