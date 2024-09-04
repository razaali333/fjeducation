<?php

namespace App\Models\Enum;

enum TransactionStatus: int
{
    case PENDING = 0;
    case FAILED = 1;
    case SUCCESS = 2;

    case REFUND = 3;

    public function toString(): ?string
    {
        return match ($this) {
            self::PENDING => __('moonshine::ui.transactions.status.pending'),
            self::FAILED => __('moonshine::ui.transactions.status.failed'),
            self::SUCCESS => __('moonshine::ui.transactions.status.success'),
            self::REFUND => __('moonshine::ui.transactions.status.refund'),
        };
    }
}
