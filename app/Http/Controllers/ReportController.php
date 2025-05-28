<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Validate date inputs
        $validated = $request->validate([
            'from' => 'sometimes|date|before_or_equal:to',
            'to' => 'sometimes|date|after_or_equal:from'
        ]);

        // Set default date range (current month)
        $from = $validated['from'] ?? Carbon::now()->startOfMonth()->toDateString();
        $to = $validated['to'] ?? Carbon::now()->endOfMonth()->toDateString();

        // Get transactions with optimized query
        $transactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->whereBetween('date', [$from, $to])
            ->orderBy('date', 'desc')
            ->get();

        // Calculate summary statistics more efficiently
        $summary = $transactions->groupBy('category.type')
            ->mapWithKeys(function ($items, $type) {
                return [$type => $items->sum('amount')];
            });

        $income = $summary->get('income', 0);
        $expense = abs($summary->get('expense', 0)); // Using abs() for consistent positive numbers
        $balance = $income - $expense;

        // Prepare chart data with better structure
        $chartData = $transactions->groupBy('category.name')
            ->map(function ($items) {
                return [
                    'amount' => abs($items->sum('amount')),
                    'count' => $items->count(),
                    'type' => $items->first()->category->type
                ];
            })
            ->sortByDesc('amount')
            ->take(10); // Limit to top 10 categories

        return view('reports.index', [
            'transactions' => $transactions,
            'summary' => [
                'income' => $income,
                'expense' => $expense,
                'balance' => $balance,
                'start_date' => $from,
                'end_date' => $to
            ],
            'chartData' => $chartData,
            'dateRange' => [
                'from' => $from,
                'to' => $to
            ]
        ]);
    }
}