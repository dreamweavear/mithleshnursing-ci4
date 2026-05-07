<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ExpenseModel;

class Expenses extends BaseController
{
    protected $expenseModel;

    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
    }

    // Expense List

public function index()
{
    $builder = $this->expenseModel;

    // From Date
    if ($this->request->getGet('from')) {
        $builder = $builder->where('expense_date >=', $this->request->getGet('from'));
    }

    // To Date
    if ($this->request->getGet('to')) {
        $builder = $builder->where('expense_date <=', $this->request->getGet('to'));
    }

    // Category Filter
    if ($this->request->getGet('category')) {
        $builder = $builder->where('category', $this->request->getGet('category'));
    }

    // Keyword Search
    if ($this->request->getGet('keyword')) {
        $keyword = $this->request->getGet('keyword');

        $builder = $builder->groupStart()
            ->like('paid_to', $keyword)
            ->orLike('description', $keyword)
            ->groupEnd();
    }

    $data['expenses'] = $builder
        ->orderBy('expense_date', 'DESC')
        ->orderBy('id', 'DESC')
        ->findAll();

    return view('admin/expenses/index', $data);
}

    // Add Form
    public function create()
    {
        return view('admin/expenses/create');
    }

    // Save Expense
    public function store()
    {
        $this->expenseModel->insert([
            'expense_date'   => $this->request->getPost('expense_date'),
            'category'       => $this->request->getPost('category'),
            'description'    => $this->request->getPost('description'),
            'amount'         => $this->request->getPost('amount'),
            'paid_to'        => $this->request->getPost('paid_to'),
            'payment_method' => $this->request->getPost('payment_method'),
            'notes'          => $this->request->getPost('notes'),
        ]);

        return redirect()->to(base_url('admin/expenses'))
                         ->with('success', 'Expense added successfully.');
    }

    // Edit Form
    public function edit($id)
    {
        $expense = $this->expenseModel->find($id);

        if (!$expense) {
            return redirect()->to(base_url('admin/expenses'))
                             ->with('error', 'Expense not found.');
        }

        return view('admin/expenses/edit', ['expense' => $expense]);
    }

    // Update Expense
    public function update($id)
    {
        $expense = $this->expenseModel->find($id);

        if (!$expense) {
            return redirect()->to(base_url('admin/expenses'))
                             ->with('error', 'Expense not found.');
        }

        $this->expenseModel->update($id, [
            'expense_date'   => $this->request->getPost('expense_date'),
            'category'       => $this->request->getPost('category'),
            'description'    => $this->request->getPost('description'),
            'amount'         => $this->request->getPost('amount'),
            'paid_to'        => $this->request->getPost('paid_to'),
            'payment_method' => $this->request->getPost('payment_method'),
            'notes'          => $this->request->getPost('notes'),
        ]);

        return redirect()->to(base_url('admin/expenses'))
                         ->with('success', 'Expense updated successfully.');
    }

    // Delete Expense
    public function delete($id)
    {
        $expense = $this->expenseModel->find($id);

        if (!$expense) {
            return redirect()->to(base_url('admin/expenses'))
                             ->with('error', 'Expense not found.');
        }

        $this->expenseModel->delete($id);

        return redirect()->to(base_url('admin/expenses'))
                         ->with('success', 'Expense deleted successfully.');
    }
}