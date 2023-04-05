<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $acnt = Account::select('accounts.*', 'users.email')
        ->leftJoin('users', 'accounts.user_id', '=', 'users.id')
        ->where('user_id', Auth::user()->id)
        ->latest()
        ->first();

        return view('home',compact('acnt'));
    }

    //deposit

    public function deposit()
    {
       
        return view('deposit');
    }
    public function storedeposit(Request $request)
    {
        $user_id = Auth::user()->id;
    
        // Get the new transaction details
        $account_amt = $request->account_amt;
        $type = $request->type;
        $details = $request->details;
    
        // Get the latest transaction record for the user
        $latest_transaction = Account::where('user_id', $user_id)->latest()->first();
        $current_balance = $latest_transaction ? $latest_transaction->balance : 0;
    
        // Calculate the new balance
        $new_balance = $current_balance + $account_amt;
    
        // Save the new transaction to the database
        $transaction = new Account();
        $transaction->user_id = $user_id;
        $transaction->account_amt = $account_amt;
        $transaction->type = $type;
        $transaction->details = $details;
        $transaction->balance = $new_balance;
        $transaction->save();

        
        
    return back()->with('message','Add Successfully');
}

//withdraw

    public function withdraw()
    {
        return view('withdraw');
    }
    public function storewithdraw(Request $request)
{
    $user_id = Auth::user()->id;
    
        // Get the new transaction details
        $account_amt = $request->account_amt;
        $type = $request->type;
        $details = $request->details;
    
        // Get the latest transaction record for the user
        $latest_transaction = Account::where('user_id', $user_id)->latest()->first();
        $current_balance = $latest_transaction ? $latest_transaction->balance : 0;
    
        // Calculate the new balance
        $new_balance = $current_balance - $account_amt;
    
        // Save the new transaction to the database
        $transaction = new Account();
        $transaction->user_id = $user_id;
        $transaction->account_amt = $account_amt;
        $transaction->type = $type;
        $transaction->details = $details;
        $transaction->balance = $new_balance;
        $transaction->save();

    return back()->with('message','Withdrawal Successfully');
}
   

//transfer fund uaer to another user
public function transfer_money()
{
    $users = User::where('id', '!=', Auth::id())->get(['id', 'name', 'email']);

    return view('transfer_money',compact('users'));
}


public function strore_transfer_money(Request $request)
{
    $sender_id = Auth::user()->id;
    $recipient_id = $request->recipient_user_id;
    $transfer_amount = $request->transfer_amount;

    // Check if the sender has sufficient balance
    $sender_balance = Account::where('user_id', $sender_id)->orderBy('created_at', 'desc')->value('balance');
    if ($transfer_amount > $sender_balance) {
        return back()->with('error', 'Insufficient balance');
    }

    // Update the sender's account balance
    $sender_new_balance = $sender_balance - $transfer_amount;
    $sender_account = new Account();
    $sender_account->user_id = $sender_id;
    $sender_account->account_amt = -$transfer_amount;
    $sender_account->type = 'TransferDebit';
    $sender_account->details = 'Transfer to '.$recipient_id;
    $sender_account->balance = $sender_new_balance;
    $sender_account->save();

    // Update the recipient's account balance
    $recipient_balance = Account::where('user_id', $recipient_id)->orderBy('created_at', 'desc')->value('balance');
    $recipient_new_balance = $recipient_balance + $transfer_amount;
    $recipient_account = new Account();
    $recipient_account->user_id = $recipient_id;
    $recipient_account->account_amt = $transfer_amount;
    $recipient_account->type = 'TransferCredit';
    $recipient_account->details = 'Transfer from '.$sender_id;
    $recipient_account->balance = $recipient_new_balance;
    $recipient_account->save();

    return back()->with('message', 'Successfully transferred funds');
}


//statement

public function statement()
{
    $account = Account::select('accounts.*', 'sender.email as sender_email', 'recipient.email as recipient_email')
    ->join('users as sender', 'accounts.user_id', '=', 'sender.id')
    ->join('users as recipient', 'accounts.user_id', '=', 'recipient.id')
    ->get();

    return view('statement',compact('account'));
}

}
