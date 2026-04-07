<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
    public function login()
    {
        // If already logged in, redirect to dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('admin/dashboard');
        }
        
        $data = [
            'title' => 'Admin Login - Mithlesh Nursing Home'
        ];
        
        return view('admin/auth/login', $data);
    }
    
    public function authenticate()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        $user = $this->userModel->authenticate($email, $password);
        
        if ($user) {
            // Set session data
            $sessionData = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
                'isLoggedIn' => true
            ];
            
            session()->set($sessionData);
            
            return redirect()->to('admin/dashboard')
                            ->with('success', 'Welcome back, ' . $user['name'] . '!');
        } else {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Invalid email or password.');
        }
    }
    
    public function logout()
    {
        session()->destroy();
       // return redirect()->to('admin/login')
         //  ->with('success', 'You have been logged out successfully.');
         // below is correction for the above line to redirect to home page after logout instead of login page 
        //  return view('public/home');     
         return redirect()->to('/');

                    
    }
}
