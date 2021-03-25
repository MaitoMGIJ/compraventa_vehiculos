<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('role:Admin');
    }

    public function index(){
        return view('admin.index');
    }

    public function expense(){
        $expenses = TransactionType::where('expense', true)->get();
        return view('admin.expense', [
            'expenses' => $expenses
        ]);
    }

    public function createExpense(){
        return view('admin.create_expense');
    }

    public function storeExpense(Request $request){
        $message = __('messages.expense.created.fail');
        $error = true;

        $this->validate($request, [
            'name' => 'required',
        ]);

        TransactionType::create([
            'description' => Str::upper($request->name),
            'entry' => false,
            'end' => false,
            'expense' => true,
            'income' => false,
            'is_active' => true
        ]);

        $message = __('messages.expense.created.done');
        $error = false;

        return redirect()->route('admin.expense.list')
                        ->with([
                            'error' => $error,
                            'message' => $message
                        ]);
    }
}
