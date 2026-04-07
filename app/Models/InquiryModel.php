<?php

namespace App\Models;

use CodeIgniter\Model;

class InquiryModel extends Model
{
    protected $table = 'inquiries';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'email', 'phone', 'subject', 'message', 'status',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|max_length[100]',
        'phone' => 'required|max_length[20]',
        'subject' => 'required|max_length[200]',
        'message' => 'required',
    ];
    
    public function getNewInquiryCount()
    {
        return $this->where('status', 'New')->countAllResults();
    }
}
