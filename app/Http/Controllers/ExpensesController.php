<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Event;

use App\ExpenseItem;
use App\Donation;
use Carbon\Carbon;
class ExpensesController extends Controller
{
    // public function index()
    // {
    // 	$expenses = Expense::with('event')->whereNull('archive')->get();
    // 	$events    = Event::where('status', 'Approved') ->pluck('event_name', 'id');
    // 	return view('expenses.index', compact('events', 'expenses'));
    // }

	public function index(Request $request)
	{
		$events = Event::where('status', 'Approved')->pluck('event_name', 'id');
		$selectedEventId = $request->input('event_filter');
		$selectedEvent = $selectedEventId == 'All Approved Events' ? 'All Approved Events' : Event::findOrFail($selectedEventId)->event_name;
		$totalDonation = Donation::where('event_id', $selectedEventId)->sum('amount');
		$totalExpense = Expense::where('event_id', $selectedEventId)->sum('amount');
		if ($selectedEventId && $selectedEventId != 'All Approved Events') {
			$expenses = Expense::with('event')
				->where('event_id', $selectedEventId)
				->whereNull('archive')
				->get();
		} else {
			$expenses = Expense::with('event')
				->whereNull('archive')
				->get();
			$totalDonation = Donation::whereNull('archive')->sum('amount');
			$totalExpense = Expense::whereNull('archive')->sum('amount');
		}
	
		return view('expenses.index', compact('events', 'expenses', 'selectedEvent', 'totalDonation', 'totalExpense'));
	}
	
	

	public function store(Request $request)
	{
		$this->validate($request, [
			'expense_name' => 'required',
			'description' => 'required',
			'event' => 'required',
			'date' => 'required',
			'amount' => 'required|numeric',
			'reference_id' => 'required|unique:expenses,reference_id',
		]);
	
		$event = Event::find($request->input('event'));
		$expense = new Expense([
			'user_id' => auth()->id(),
			'event_id' => $event->id,
			'amount' => $request->input('amount'),
			'expense_name' => $request->input('expense_name'),
			'date' => Carbon::parse($request->input('date')),
			'reference_id' => $request->input('reference_id'),
			'description' => $request->input('description'),
		]);
		$expense->save();
	
		return back()->with('success', 'Expense has been added!');
	}
	

    public function edit(Expense $expense)
    {
    	$events    = Event::where('status', 'Approved')->pluck('event_name', 'id');
		// $expenseItems   = ExpenseItem::where('expense_id', $expense->id)->get();
    	return view('expenses.edit', compact('events','expense'));
    }

	public function show(Expense $expense)
    {
    	$events    = Event::where('status', 'Approved')->pluck('event_name', 'id');
		// $expenseItems   = ExpenseItem::where('expense_id', $expense->id)->get();
    	return view('expenses.show', compact('events','expense'));
    }

	public function update(Expense $expense)
	{
		$this->validate(request(), [
			'expense_name' => 'required',
			'item_name.*' => 'required',
			'amount_item.*' => 'required|numeric',
			'event' => 'required',
			'date' => 'required',
			'amount'	=> 'required|numeric',
			'reference_id' => 'required',
			'description' => 'required',
		]);
	
		$event = Event::find(request('event'));
    	$expense->update([
    		'user_id'	=> auth()->id(),
    		'event_id'	=> $event->id,
			'amount'	=> request('amount'),
    		'expense_name'	=> request('expense_name'),
    		'date'	=> Carbon::parse(request('date')),
    		'reference_id'	=> request('reference_id'),
			'description'   => request('description'),
    	]);

		// $itemNames = $request->input('item_name');
		// $amounts = $request->input('amount_item');
	
		// foreach ($itemNames as $key => $value) {
		// 	$expenseItem = ExpenseItem::create([
		// 		'item_name'   => $value,
		// 		'amount_item' => $amounts[$key],
		// 		'expense_id'  => $expense->id,
		// 	]);
		// }

		return redirect()->route('expenses.index', $expense);
	}
	

    public function destroy(Expense $expense)
    {
    	$expense->delete();
    	return back()->with('error', 'Expense has been removed!');
    }

	public function archive(Expense $expense)
	{
		$expense->update([
			'archive' => 'Archived',
		]);
	
		return redirect()->back()->with('success', 'Expense has been archived!');
	}
	
	public function archiveExpenses(Expense $expense)
	{
		$expenses = Expense::with('event')->whereNotNull('archive')->get();
    	$events    = Event::where('status', 'Approved') ->pluck('event_name', 'id');
    	return view('expenses.archived', compact('events', 'expenses'));
	}

}
