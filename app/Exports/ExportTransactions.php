<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ExportTransactions implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch transactions and format them into a structured collection
        $transactions = Transaction::all();

        // Map transactions to a structured collection with properly named keys
        $formattedTransactions = $transactions->map(function ($transaction) {
            return [
                'ID' => $transaction->id ?? '',
                'Date' => $transaction->created_at ? $transaction->created_at->toDateString() : '',
                'Customer Name' => $transaction-> order->name ?? '',
                'Items Sold' => $transaction->order->details->count() ?? '',
                'Cost' => $transaction->transac_amount ?? '',
                'Amount Paid' => $transaction->paid_amount ?? '',
                'Balance' => $transaction->balance ?? '',
                'Payment Method' => $transaction->payment_method ?? '',
                'Cashier' => $transaction->user->name ?? '',
            ];
        });

        return $formattedTransactions;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Date',
            'Customer Name',
            'Items Sold',
            'Cost',
            'Amount Paid',
            'Balance',
            'Payment Method',
            'cashier',
        ];
    }
}
