<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AccountService;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function reset()
    {
        $this->accountService->reset();
        return response()->json([], 200);
    }

    public function getBalance(Request $request)
    {
        $accountId = $request->query('account_id');
        $balance = $this->accountService->getBalance($accountId);
        
        if ($balance === null) {
            return response()->json(0, 404);
        }

        return response()->json($balance, 200);
    }

    public function handleEvent(Request $request)
    {
        $data = $request->all();
        $result = $this->accountService->handleEvent($data);

        if ($result === null) {
            return response()->json(0, 404);
        }

        return response()->json($result, 201);
    }

    public function getAllAccounts()
    {
        $accounts = $this->accountService->getAllAccounts();
        return response()->json($accounts, 200);
    }
}
