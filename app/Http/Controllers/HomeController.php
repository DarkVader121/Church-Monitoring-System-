<?php

namespace App\Http\Controllers;
use App\Project;
use App\Event;
use App\Donation;
use App\Expense;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->take(5)->get();
        $events = Event::orderBy('id', 'desc')->take(5)->get();
        $donations = Donation:: orderBy('id', 'desc')->whereNull('archive')->take(5)->get();
        $expenses = Expense:: orderBy('id', 'desc')->whereNull('archive')->take(5)->get();
        return view('home', compact('projects', 'events','donations', 'expenses'));
    }
}
