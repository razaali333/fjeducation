<?php

namespace App\Models\Enum;

enum TransactionType: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAW = 'withdraw';
    case TRANSFER = 'transfer';
}
