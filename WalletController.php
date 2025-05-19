<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use BitWasp\Bitcoin\Bip39\Bip39;
use BitWasp\Bitcoin\Key\Factory\KeyFactory;

class WalletController extends Controller
{
    public function create()
    {
        return view('wallet.create');
    }

    public function store(Request $request)
    {
        $mnemonic = Bip39::createMnemonic();
        $seed = Bip39::mnemonicToSeed($mnemonic);
        $keyFactory = new KeyFactory();
        $hdWallet = $keyFactory->fromSeed($seed);

        $wallet = new Wallet();
        $wallet->user_id = Auth::id();
        $wallet->wallet_name = $request->wallet_name;
        $wallet->recovery_phrase = $mnemonic;
        $wallet->save();

        return view('wallet.create', ['mnemonic' => $mnemonic]);
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'recipient_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.0001',
        ]);

        $senderWallet = Wallet::where('user_id', Auth::id())->first();
        $recipientWallet = Wallet::where('user_id', $request->recipient_user_id)->first();

        if ($senderWallet->balance < $request->amount) {
            return back()->withErrors(['amount' => 'Insufficient balance']);
        }

        $senderWallet->balance -= $request->amount;
        $recipientWallet->balance += $request->amount;
        $senderWallet->save();
        $recipientWallet->save();

        return redirect()->route('dashboard')->with('status', 'Transfer successful');
    }
}
