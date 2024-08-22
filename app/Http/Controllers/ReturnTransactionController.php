<?php

namespace App\Http\Controllers;

use App\Models\Return_Transaction;
use App\Models\Loan_Transaction;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReturn_TransactionRequest;
use App\Http\Requests\UpdateReturn_TransactionRequest;
use Illuminate\Support\Facades\Validator;

class ReturnTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('returns.index', [
            'title' => 'Return Transactions',
            'active' => 'returns',
            'returns' => Return_Transaction::with('book', 'user')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('returns.add', [
            'title' => 'Create Return Transaction',
            'active' => 'returns',
            'loans' => Loan_Transaction::with('book', 'user')->get()
        ]);
    }

    public function price(Request $request)
    {
        $loan = Loan_Transaction::where([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
        ])->first();
        $book = Book::find($request->book_id);
        $user = User::find($request->user_id);

        return view('returns.price', [
            'title' => 'Create Return Transaction',
            'active' => 'returns',
            'loan' => $loan,
            'book' => $book,
            'user' => $user,
            'return_date' => $request->return_date,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReturn_TransactionRequest $request)
    {
         $rules = [
            'book_id' => 'required|numeric|exists:books,id',
            'user_id' => 'required|numeric|exists:users,id',
            'return_date' => 'required|date',
            'price' => 'required|numeric',
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

        $loan = Loan_Transaction::where([
            'user_id' => $data['user_id'],
            'book_id' => $data['book_id'],
        ])->first();

        if (!$loan) {
            return redirect()->back()->with('error', 'This loan transaction is not available');
        }

        $loan->delete();
        $book = Book::find($data['book_id']);
        $book->stock += 1;
        $book->save();
        Return_Transaction::create($data);

        return redirect()->route('returns.index')->with('success', 'Return transaction created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Return_Transaction $return_Transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Return_Transaction $return_Transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReturn_TransactionRequest $request, Return_Transaction $return_Transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Return_Transaction $return_Transaction, $id)
    {
        $return = Return_Transaction::find($id);
        $return->delete();
        return redirect()->route('returns.index')->with('success', 'Return transaction deleted successfully');
    }
}
