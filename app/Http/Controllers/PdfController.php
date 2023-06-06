<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Donation;
use PDF;

class PdfController extends Controller
{
    public function index(Request $request)
    {
        $expensesReport = Expense::whereNull('archive');
        
        if ($request->has('from') && $request->has('to')) {
            $from = \Carbon\Carbon::parse($request->from)->format('Y-m-d');
            $to = \Carbon\Carbon::parse($request->to)->format('Y-m-d');
            $expensesReport->whereBetween('date', [$from, $to]);
        }
    
        if ($request->has('event_filter') && $request->event_filter !== 'All Donations') {
            $selectedEvent = $request->event_filter;
            $expensesReport->whereHas('event', function ($query) use ($selectedEvent) {
                $query->where('id', $selectedEvent);
            });
        }
    
        $expenses = $expensesReport->with('event')->get();
        $total = $expenses->sum('amount');
    
        $pdf = PDF::loadView('pdf.index', compact('expenses', 'total'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }
    

    public function donations(Donation $donation)
    {
        $donationsReport = Donation::whereNull('archive');
    
        if (request()->has('from') && request()->has('to')) {
            $from = \Carbon\Carbon::parse(request('from'))->format('Y-m-d');
            $to = \Carbon\Carbon::parse(request('to'))->format('Y-m-d');
            $donationsReport->whereBetween('date', [$from, $to]);
        }
    
        if (request()->has('project_filter') && request('project_filter') !== 'All Approved Projects') {
            $projectFilter = request('project_filter');
            $donationsReport->whereHas('project', function ($query) use ($projectFilter) {
                $query->where('id', $projectFilter);
            });
        }
    
        $donations = $donationsReport->with('project')->get();
        $total = $donations->sum('amount');
    
        $pdf = PDF::loadView('pdf.donation', compact('donations', 'total'));
        $pdf->setPaper('legal', 'portrait');
        return $pdf->stream();
    }
    
    
}
