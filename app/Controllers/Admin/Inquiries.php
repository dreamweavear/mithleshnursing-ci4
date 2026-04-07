<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InquiryModel;

class Inquiries extends BaseController
{
    protected $inquiryModel;
    
    public function __construct()
    {
        $this->inquiryModel = new InquiryModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Inquiry Management - Mithlesh Nursing Home',
            'inquiries' => $this->inquiryModel->orderBy('created_at', 'DESC')->findAll()
        ];
        
        return view('admin/inquiries/index', $data);
    }
    
    public function view($id)
    {
        $inquiry = $this->inquiryModel->find($id);
        
        if (!$inquiry) {
            return redirect()->to('admin/inquiries')
                            ->with('error', 'Inquiry not found.');
        }
        
        // Mark as read if it's new
        if ($inquiry['status'] === 'New') {
            $this->inquiryModel->update($id, ['status' => 'Read']);
        }
        
        $data = [
            'title' => 'View Inquiry - Mithlesh Nursing Home',
            'inquiry' => $inquiry
        ];
        
        return view('admin/inquiries/view', $data);
    }
    
    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        
        if (!in_array($status, ['New', 'Read', 'Replied'])) {
            return redirect()->back()
                            ->with('error', 'Invalid status.');
        }
        
        $this->inquiryModel->update($id, ['status' => $status]);
        
        return redirect()->back()
                        ->with('success', 'Inquiry status updated.');
    }
    
    public function delete($id)
    {
        $inquiry = $this->inquiryModel->find($id);
        
        if (!$inquiry) {
            return redirect()->to('admin/inquiries')
                            ->with('error', 'Inquiry not found.');
        }
        
        $this->inquiryModel->delete($id);
        
        return redirect()->to('admin/inquiries')
                        ->with('success', 'Inquiry deleted successfully.');
    }
}
