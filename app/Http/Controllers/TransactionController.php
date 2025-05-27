<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function index()
{
    $transactions = Transaction::with('category')->where('user_id', auth()->id())->get();
    return view('transactions.index', compact('transactions'));
}

public function create()
{
    $categories = Category::where('user_id', auth()->id())->get();
    return view('transactions.create', compact('categories'));
}

public function edit(Transaction $transaction)
{
    $this->authorize('update', $transaction);
    $categories = Category::where('user_id', auth()->id())->get();
    return view('transactions.edit', compact('transaction', 'categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
   

     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
