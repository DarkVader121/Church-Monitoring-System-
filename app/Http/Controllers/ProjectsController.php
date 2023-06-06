<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Carbon\Carbon;
class ProjectsController extends Controller
{


    public function index()
    {
    	$projects = Project::all();

    	return view('projects.index', compact('projects'));
    }

	

    public function store(Request $request)
    {
    	$this->validate(request(), [
    		'project_name'	        => 'required',
    		'description'	        => 'required',
            'date' => 'required|date',
            'projectTargetDeadline' => [
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
    		'budget'	            => 'required|numeric',
            'commission'	            => 'required',
    	]);
        $user = auth()->user();

    	Project::create([
    		'user_id'		=> auth()->id(),
            'project_createdby' => $user->first_name . ' ' . $user->last_name,
            'projectTargetDeadline' => $request->projectTargetDeadline,	
    		'project_name'	=> $request->project_name,
    		'description'	=> $request->description,
    		'date'	=> Carbon::parse($request->date),
    		'budget'	=> $request->budget,
    		'status'	=> 'Pending',
            'commission' => $request->commission,
    	]);
    	return back()->with('success', 'Project has been added!');
    }

    public function edit(Project $project)
    {
    	return view('projects.edit', compact('project'));
    }

    public function show(Project $project)
    {
    	return view('projects.show', compact('project'));
    }

    public function update(Project $project, Request $request)
    {
    	$this->validate(request(), [
    		'project_name'	=> 'required',
    		'description'	=> 'required',
    		'date'	=> 'required',
    		'budget'	=> 'required|numeric',
    	]);

        $user = auth()->user();

    	$project->update([
    		'user_id'	            	=> $user->id,
            'project_createdby' => $user->first_name . ' ' . $user->last_name,
    		'project_name'	=> $request->project_name,
    		'description'	=> $request->description,
    		'date'	=> Carbon::parse($request->date),
             'projectTargetDeadline'	=> Carbon::parse($request->date),
    		'budget'	=> $request->budget,
    		'status'	=> 'Pending',
    	]);

    	return redirect('/pending-projects')->with('info', 'Project has been updated!');
    }

    public function destroy(Project $project)
    {
    	$project->delete();

    	return back()->with('error', 'Project has been removed!');
    }

    public function pending()
    {
        $projects = Project::where('status', 'Pending')->get();

        return view('projects.pending-projects', compact('projects'));
    }

	public function cancelledP()
    {
        $projects = Project::where('status', 'Cancelled')->get();

        return view('projects\cancelled-projects', compact('projects'));
    }

    public function approvedP()
    {
        $projects = Project::where('status', 'Approved')->get();

        return view('projects\approved-projects', compact('projects'));
    }
    public function archivedP()
    {
        $projects = Project::where('status', 'Archived')->get();

        return view('projects\archived-projects', compact('projects'));
    }


	

    public function approved(Project $project)
    {
        
        $user = auth()->user();

        $project->update([
            'approver_id'  => $user->id,
            'project_approvedby'  => $user->first_name . ' ' . $user->last_name,
            'status'    => 'Approved'
        ]);

        return back()->with('success', 'Project has been approved!');
    }  

    public function cancelled(Project $project, Request $request)
    {
        $user = auth()->user();
        $project->update([
            'approver_id'  => $user->id,
            'project_approvedby'  => $user->first_name . ' ' . $user->last_name,
            'status'    => 'Cancelled',
            'project_comments' => $request->description,
        ]);
    
        return back()->with('success', 'Project has been cancelled!');
    }
    
    public function archived(Project $project, Request $request)
    {
        $user = auth()->user();
        $project->update([
            'archiver_id'  => $user->id,
            'archiver_name'  => $user->first_name . ' ' . $user->last_name,
            'status'    => 'Archived',
        ]);
    
        return back()->with('success', 'Project has been Archived!');
    }

}
