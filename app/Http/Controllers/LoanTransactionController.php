<?php

namespace App\Http\Controllers;

use App\Models\Loan_Transaction;
use App\Models\Book;
use App\Models\User;
use App\Http\Requests\StoreLoan_TransactionRequest;
use App\Http\Requests\UpdateLoan_TransactionRequest;
use Illuminate\Support\Facades\Validator;

class LoanTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loans.index', [
            'title' => 'Loan Transaction',
            'active' => 'loans',
            'loans' => Loan_Transaction::with('book', 'user')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loans.add', [
            'title' => 'Create Loan Transaction',
            'active' => 'loans',
            'books' => Book::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoan_TransactionRequest $request)
    {
        $rules = [
            'book_id' => 'required|numeric|exists:books,id',
            'user_id' => 'required|numeric|exists:users,id',
            'loan_date' => 'required|date',
        ];

        $data  = $request->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $isBookAvailable = Book::where('id', $data['book_id'])
            ->first();

        if (!$isBookAvailable) {
            return redirect()->back()->with('error', 'This book is not available');
        }
        
        $isUserAvailable = User::where('id', $data['user_id']) ->first();
        if (!$isUserAvailable) {
            return redirect()->back()->with('error', 'This user is not available');
        }

        $book = Book::find($data['book_id']);
        if ($book->stock == 0) {
            return redirect()->back()->with('error', 'This book is out of stock');
        }

        $book->stock = $book->stock - 1;
        $book->save();

        Loan_Transaction::create($data);
        return redirect()->route('loans.index')->with('success', 'Loan Transaction created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan_Transaction $loan_Transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan_Transaction $loan_Transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoan_TransactionRequest $request, Loan_Transaction $loan_Transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan_Transaction $loan_Transaction, $id)
    {
        $loan = Loan_Transaction::find($id);
        $book = Book::find($loan->book_id);
        $book->stock = $book->stock + 1;
        $book->save();
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'loan deleted successfully');
    }
}
