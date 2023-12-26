<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display the user's account dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $accounts = $user->accounts;

        if ($accounts === null) {
            // Handle the case where the user has no accounts or the relationship is not defined
            $accounts = collect();
        }

        return view('accounts.index', compact('accounts'));
    }


    /**
     * Display the account statement for a specific account.
     *
     * @param Account $account
     * @return \Illuminate\Http\Response
     */
    public function statement()
    {
        // Fetch all transactions for the authenticated user
        $transactions = Auth::user()->transactions()->latest()->paginate(10);

        return view('accounts.statement', compact('transactions'));
    }
}
