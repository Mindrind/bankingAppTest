<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions as a statement.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Assuming each user only has one account
        $transactions = Auth::user()->transactions()->latest()->paginate(10);

        return view('accounts.statement', compact('transactions'));
    }

    /**
     * Show the form for creating a new deposit.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDeposit()
    {
        return view('transactions.deposit');
    }

    /**
     * Store a newly created deposit in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDeposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        // Start a database transaction
        DB::beginTransaction();
        try {
            // Assuming you have a method in your User model to calculate the balance
            $user = Auth::user();
            $newBalance = $user->calculateBalance() + $request->amount;

            // Create the transaction record
            $transaction = new Transaction([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'balance' => $newBalance,
                'type' => 'deposit',
                'details' => 'Deposit',
            ]);
            $transaction->save();

            // Commit the transaction
            DB::commit();

            Auth::user()->balance += $request->amount;
            Auth::user()->save();
            Auth::user()->updateBalance();

            // Redirect to home with success message
            return redirect()->route('home')->with('success', 'Deposit successful.');
        } catch (\Exception $e) {
            // An error occurred; cancel the transaction
            DB::rollback();

            // Redirect back with an error message
            return back()->withErrors('Deposit failed: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for creating a new withdrawal.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWithdrawal()
    {
        return view('transactions.withdraw');
    }

    /**
     * Store a newly created withdrawal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWithdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $currentBalance = $user->balance;

        // Check if the user has enough balance to withdraw
        if ($request->amount > $currentBalance) {
            return back()->withErrors(['msg' => 'Insufficient funds for withdrawal.']);
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Deduct the amount from the user's balance
            $newBalance = $currentBalance - $request->amount;

            // Create a new transaction record for the withdrawal
            $user->transactions()->create([
                'amount' => -$request->amount, // Negative amount for withdrawal
                'balance' => $newBalance,
                'type' => 'withdrawal',
                'details' => 'Withdrawal'
            ]);

            // Update the user's balance
            $user->balance = $newBalance;
            $user->save();

            // Commit the transaction
            DB::commit();

            return redirect()->route('home')->with('success', 'Withdrawal successful.');
        } catch (\Exception $e) {
            // An error occurred; rollback the transaction
            DB::rollback();

            return back()->withErrors(['msg' => 'Withdrawal failed: ' . $e->getMessage()]);
        }
    }


    /**
     * Show the form for creating a new transfer.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransfer()
    {
        return view('transactions.transfer');
    }

    /**
     * Store a newly created transfer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTransfer(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $sender = Auth::user();
        $recipient = User::where('email', $request->email)->first();
        $amountToTransfer = $request->amount;

        if ($amountToTransfer > $sender->balance) {
            return back()->withErrors(['msg' => 'Insufficient funds for transfer.']);
        }

        DB::beginTransaction();
        try {
            // Deduct the amount from sender's balance
            $sender->balance -= $amountToTransfer;
            $sender->save();

            // Add the amount to recipient's balance
            $recipient->balance += $amountToTransfer;
            $recipient->save();

            // Record transaction for sender
            $sender->transactions()->create([
                'type' => 'debit',
                'amount' => -$amountToTransfer,
                'balance' => $sender->balance,
                'details' => 'Transfer to ' . $recipient->email
            ]);

            // Record transaction for recipient
            $recipient->transactions()->create([
                'type' => 'credit',
                'amount' => $amountToTransfer,
                'balance' => $recipient->balance,
                'details' => 'Transfer from ' . $sender->email
            ]);

            DB::commit();
            return redirect()->route('home')->with('success', 'Transfer successful.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['msg' => 'Transfer failed: ' . $e->getMessage()]);
        }
    }
}
