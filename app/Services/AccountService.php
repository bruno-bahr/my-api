<?php

namespace App\Services;

class AccountService
{
    protected $accounts;

    public function reset()
    {
        $this->accounts = array();
    }

    public function getBalance($accountId)
    {
        return $this->accounts[$accountId] ?? null;
    }

    public function handleEvent($data)
    {
        switch ($data['type']) {
            case 'deposit':
                return $this->handleDeposit($data);
            case 'withdraw':
                return $this->handleWithdraw($data);
            case 'transfer':
                return $this->handleTransfer($data);
            default:
                return null;
        }
    }

    protected function handleDeposit($data)
    {   
        $destination = $data['destination'];
        $amount = $data['amount'];
        
        if (!isset($this->accounts[$destination])) {
            $this->accounts[$destination] = 0;
        }

        $this->accounts[$destination] += $amount;

        return [
            'destination' => [
                'id' => $destination,
                'balance' => $this->accounts[$destination]
            ]
        ];
    }


    protected function handleWithdraw($data)
    {
        $origin = $data['origin'];
        $amount = $data['amount'];

        if (!isset($this->accounts[$origin]) || $this->accounts[$origin] < $amount) {
            return null;
        }

        $this->accounts[$origin] -= $amount;

        return [
            'origin' => [
                'id' => $origin,
                'balance' => $this->accounts[$origin]
            ]
        ];
    }

    protected function handleTransfer($data)
    {
        $origin = $data['origin'];
        $destination = $data['destination'];
        $amount = $data['amount'];

        if (!isset($this->accounts[$origin]) || $this->accounts[$origin] < $amount) {
            return null;
        }

        if (!isset($this->accounts[$destination])) {
            $this->accounts[$destination] = 0;
        }

        $this->accounts[$origin] -= $amount;
        $this->accounts[$destination] += $amount;

        return [
            'origin' => [
                'id' => $origin,
                'balance' => $this->accounts[$origin]
            ],
            'destination' => [
                'id' => $destination,
                'balance' => $this->accounts[$destination]
            ]
        ];
    }

    public function getAllAccounts(){
        return $this->accounts;
    }
}
