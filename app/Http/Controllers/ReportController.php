<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Filtrai
        $from = $request->input('from') ?? Carbon::now()->startOfMonth()->toDateString();
        $to = $request->input('to') ?? Carbon::now()->endOfMonth()->toDateString();

        // Įrašai pagal laikotarpį
        $transactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->whereBetween('date', [$from, $to])
            ->get();

        // Grupavimas ir skaičiavimas
        $income = $transactions->where('category.type', 'income')->sum('amount');
        $expense = $transactions->where('category.type', 'expense')->sum('amount');
        $balance = $income - $expense;

        // Grupavimas diagramai pagal kategoriją
        $chartLabels = [];
        $chartData = [];

        $grouped = $transactions->groupBy(function ($item) {
            return $item->category->name;
        });

        foreach ($grouped as $name => $items) {
            $chartLabels[] = $name;
            $chartData[] = $items->sum('amount');
        }

        return view('reports.index', [
            'summary' => [
                'income' => $income,
                'expense' => $expense,
                'balance' => $balance
            ],
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
        ]);
    }
}
