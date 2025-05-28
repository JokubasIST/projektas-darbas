<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('category')
            ->where('user_id', auth()->id())
            ->orderBy('date', 'desc')
            ->paginate(15);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                }),
            ],
            'date' => ['required', 'date'],
        ]);

        $validated['user_id'] = auth()->id();

        try {
            Transaction::create($validated);
            return redirect()->route('transactions.index')
                ->with('success', 'Transakcija sėkmingai pridėta!');
        } catch (\Throwable $e) {
            return back()->withInput()
                ->with('error', 'Nepavyko pridėti transakcijos: ' . $e->getMessage());
        }
    }

    public function edit(Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        $categories = Category::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $this->authorize('update', $transaction);

        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string', 'max:255'],
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                }),
            ],
            'date' => ['required', 'date'],
        ]);

        try {
            $transaction->update($validated);
            return redirect()->route('transactions.index')
                ->with('success', 'Transakcija sėkmingai atnaujinta!');
        } catch (\Throwable $e) {
            return back()->withInput()
                ->with('error', 'Nepavyko atnaujinti transakcijos: ' . $e->getMessage());
        }
    }

    public function destroy(Transaction $transaction)
    {
        $this->authorize('delete', $transaction);

        try {
            $transaction->delete();
            return redirect()->route('transactions.index')
                ->with('success', 'Transakcija sėkmingai ištrinta!');
        } catch (\Throwable $e) {
            return back()->with('error', 'Nepavyko ištrinti transakcijos: ' . $e->getMessage());
        }
    }
}
