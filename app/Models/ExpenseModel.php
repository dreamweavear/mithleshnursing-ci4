<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    protected $table = 'expenses';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'expense_date',
        'category',
        'description',
        'amount',
        'paid_to',
        'payment_method',
        'notes'
    ];

    protected $useTimestamps = false;
}