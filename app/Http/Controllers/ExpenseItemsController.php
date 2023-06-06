<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseItem;
use App\Expense;

class ExpenseItemsController extends Controller
{
    public function store(Request $request, Expense $expense)
    {
        $items = $request->input('item_name');
        $amounts = $request->input('amount_item');
        
        foreach($items as $key => $item) {
            $expenseItem = new ExpenseItem();
            $expenseItem->expense_id = $expense->id;
            $expenseItem->item_name = $item;
            $expenseItem->amount = $amounts[$key];
            $expenseItem->save();
        }
    
        return redirect()->route('expenses.edit', $expense)->with('success', 'Expense item created successfully.');
    }
    
}
