<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Donation;
use App\Event;
use App\Project;
class ReportsController extends Controller
{
    public function index()
    {
        
        $expensesReport = Expense::whereNull('archive');
    
        if (request()->has('from') && request()->has('to')) {
            $from = \Carbon\Carbon::parse(request('from'))->format('Y-m-d');
            $to = \Carbon\Carbon::parse(request('to'))->format('Y-m-d');
            $expensesReport->whereBetween('date', [$from, $to]);
        }

        $events = Event::where('status', 'Approved')->pluck('event_name', 'id');
        $selectedEvent = request('event_filter');

        if ($selectedEvent && $selectedEvent !== 'All Donations') {
            $expensesReport->where('event_id', $selectedEvent);
        }
        $expenses = $expensesReport->get();
        // $expenses = Expense::with('event')->->get();
        return view('reports.index', compact('expenses', 'events', 'selectedEvent'));
    }

    // public function donationsOriginal()
    // {
     

    //     $donationsReport = Donation::whereNull('archive');
    //     $donations = Donation::whereNull('archive')->get();
    //     if (request()->has('from') && request()->has('to')) {
    //         $from = \Carbon\Carbon::parse(request('from'))->format('Y-m-d');
    //         $to = \Carbon\Carbon::parse(request('to'))->format('Y-m-d');
    //         $donationsReport->whereBetween('date', [$from, $to]);
    //     }

    //     $projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
    //     $selectedProject = request('project_filter');

    //     if ($selectedProject && $selectedProject !== 'All Approved Projects') {
    //         $donationsReport->where('project_id', $selectedProject);
    //         $donations = $donationsReport->get();
    //     }
        
       
    //     return view('reports.donation', compact('donations', 'selectedProject', 'projects'));
    // }

    public function donations()
    {
        $donationsReport = Donation::whereNull('archive');
    
        if (request()->has('from') && request()->has('to')) {
            $from = \Carbon\Carbon::parse(request('from'))->format('Y-m-d');
            $to = \Carbon\Carbon::parse(request('to'))->format('Y-m-d');
            $donationsReport->whereBetween('date', [$from, $to]);
        }

        $projects = Project::where('status', 'Approved')->pluck('project_name', 'id');
        $selectedProject = request('project_filter');

        if ($selectedProject && $selectedProject !== 'All Approved Projects') {
            $donationsReport->where('project_id', $selectedProject);
        }
        $donations = $donationsReport->get();
        // $expenses = Expense::with('event')->->get();
        return view('reports.donation', compact('donations', 'projects', 'selectedProject'));
    }
}
