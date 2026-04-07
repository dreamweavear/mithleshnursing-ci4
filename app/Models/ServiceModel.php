<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'slug', 'description', 'icon', 'image', 'status', 'display_order',
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[200]',
        'slug' => 'required|is_unique[services.slug]',
        'description' => 'required',
    ];
    
    public function getActiveServices()
    {
        return $this->where('status', 'active')
                    ->orderBy('display_order', 'ASC')
                    ->findAll();
    }
    
    public function getServiceBySlug($slug)
    {
        return $this->where('slug', $slug)
                    ->where('status', 'active')
                    ->first();
    }
}
