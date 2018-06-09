<?php

namespace App\Http\Controllers;

use App\User;
use App\Movement;
use App\MovementCategorie;
use App\Charts\StatisticsChart;

use Illuminate\Http\Request;

use Illuminate\Support\Collection;

class DashboardController extends Controller
{

    const NUM_PER_PAGE = 10;

    public function show(User $user)
    {
        $statisticsRevenue = new StatisticsChart;
        $statisticsExpense = new StatisticsChart;

        $allAccount = $user->accounts()->withTrashed()->with('accountType')->paginate(static::NUM_PER_PAGE);
        $accountSum = $user->accounts()->pluck('current_balance')->sum();

        /*
            Chart
        */

        //User Accounts IDs
        $userAccountsIDs = \Auth::user()->accounts()->pluck('id');

        //User All movements
        $userMovements = Movement::latest()
            ->filter(request(['start_date', 'end_date']))
            ->whereIn('account_id', $userAccountsIDs)->get();
        
        if (count($userMovements)) {
            //Grouped By Type
            $groupedByType = $userMovements->groupBy('type');

            if (array_has($groupedByType, 'expense')) {
                // Expense
                $typeExpense = $groupedByType['expense']->groupBy('movement_category_id');
                foreach ($typeExpense as $key => $value) {
                    $categoryExpense[0][] = MovementCategorie::find($key)->name;
                    $categoryExpense[1][] = $value->sum('value');
                }

                $statisticsExpense->dataset('Value', 'bar', array_values($categoryExpense[1]));
                $statisticsExpense->labels(array_values($categoryExpense[0]))->options(['legend' => ['display' => false]]);
            }
            if (array_has($groupedByType, 'revenue')) {
                // Revenue
                $typeRevenue = $groupedByType['revenue']->groupBy('movement_category_id');
                foreach ($typeRevenue as $key => $value) {
                    $categoryRevenue[0][] = MovementCategorie::find($key)->name;
                    $categoryRevenue[1][] = $value->sum('value');
                }

                $statisticsRevenue->dataset('Value', 'bar', array_values($categoryRevenue[1]));
                $statisticsRevenue->labels(array_values($categoryRevenue[0]))->options(['legend' => ['display' => false]]);
            }
            return view('dashboard.show', compact('accountSum', 'allAccount', 'statisticsRevenue', 'statisticsExpense'));
        }
        return view('dashboard.show', compact('accountSum', 'allAccount'));
    }
}
