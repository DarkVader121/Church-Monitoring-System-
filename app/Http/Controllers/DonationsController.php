<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donation;
use App\Event;
use Carbon\Carbon;
use App\Project;

class DonationsController extends Controller
{
	public function index(Request $request)
{
    $events = Event::where('status', 'Approved')->pluck('event_name', 'id', );
    $projects = Project::where('status', 'Approved')->pluck('project_name', 'id');

    $selectedProject = $request->input('project');
    $totalDonation = Donation::where('project_id', $selectedProject)->sum('amount');
    if ($selectedProject && $selectedProject != 'All Approved Projects') {
        $donations = Donation::with('project')
            ->where('project_id', $selectedProject)
            ->whereNull('archive')
            ->get();
    } else {
        $donations = Donation::whereNull('archive')->get();
    }
    return view('donations.index', compact('events', 'projects', 'donations', 'selectedProject', 'totalDonation'));
}

    public function store(Request $request)
    {
    	$this->validate(request(), [
			// 'first_name'	=> 'required',
			// 'last_name'	=> 'required',
    		'amount'	=> 'required|numeric',
    		'date'	=> 'required',
    		'project'	=> 'required',
    		'donation_type'	=> 'required',
			'donor_name'	=> 'required',
    	]);

    	$event = Event::find(request('event'));
		$project = Project::find(request('project'));
    	Donation::create([
    		'user_id'	=> auth()->id(),
    		'project_id'	=> $project->id,
			'donor_name'	=> request('donor_name'),
			// 'first_name'	=> request('first_name'),
			// 'last_name'	=> request('last_name'),
    		'amount'	=> request('amount'),
    		'donation_type'	=> request('donation_type'),
    		'date'	=> Carbon::parse(request('date')),
    	]);

    	return back()->with('success', 'Donation has been added!');
    }

    public function edit(Donation $donation)
    {
    	$events = Event::where('status', 'Approved') ->pluck('event_name', 'id');
		$projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
    	return view('donations.edit', compact('donation', 'events', 'projects'));
    }

    public function update(Donation $donation)
    {
    	$this->validate(request(), [
    		'donor_name'	=> 'required',
			// 'first_name'	=> 'required',
			// 'last_name'	=> 'required',
    		'amount'	=> 'required',
    		'date'	=> 'required',
    		'project'	=> 'required',
    		'donation_type'	=> 'required',
    	]);

    	$event = Event::find(request('event'));
		$project = Project::find(request('project'));
    	$donation->update([
    		'user_id'	=> auth()->id(),
    		'project_id'	=> $project->id,
    		'donor_name'	=> request('donor_name'),
			// 'first_name'	=> request('first_name'),
			// 'last_name'	=> request('last_name'),
    		'amount'	=> request('amount'),
    		'donation_type'	=> request('donation_type'),
    		'date'	=> Carbon::parse(request('date')),
    	]);

    	return redirect('/donations')->with('info', 'Donation has been updated!');
    }

    public function destroy(Donation $donation)
    {
    	$donation->delete();

    	return back()->with('error', 'Donation has been removed!');
    }

	public function archiveDonations()
	{
		$donations = Donation::whereNotNull('archive')->get();
	
		return view('donations/archive', compact('donations'));
	}
	
	public function archive(Donation $donation)
	{
		$donation->update([
			'archive' => 'Approved'
		]);
		return redirect()->back()->with('success', 'Donation has been archived!');
	}
	
}
