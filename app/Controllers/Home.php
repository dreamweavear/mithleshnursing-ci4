<?php

namespace App\Controllers;

use App\Models\DoctorModel;
use App\Models\ServiceModel;
use App\Models\InquiryModel;

class Home extends BaseController
{
    protected $doctorModel;
    protected $serviceModel;
    protected $inquiryModel;
    
    public function __construct()
    {
        $this->doctorModel = new DoctorModel();
        $this->serviceModel = new ServiceModel();
        $this->inquiryModel = new InquiryModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Mithlesh Nursing Home - Quality Healthcare Services',
            'services' => $this->serviceModel->getActiveServices(),
            'doctors' => $this->doctorModel->getActiveDoctors()
        ];
        
        return view('public/home', $data);
    }
    
    public function about()
    {
        $data = [
            'title' => 'About Us - Mithlesh Nursing Home'
        ];
        
        return view('public/about', $data);
    }
    
    public function services()
    {
        $data = [
            'title' => 'Our Services - Mithlesh Nursing Home',
            'services' => $this->serviceModel->getActiveServices()
        ];
        
        return view('public/services', $data);
    }
    
    public function serviceDetail($slug)
    {
        $service = $this->serviceModel->getServiceBySlug($slug);
        
        if (!$service) {
            return redirect()->to('services')
                            ->with('error', 'Service not found.');
        }
        
        $data = [
            'title' => $service['title'] . ' - Mithlesh Nursing Home',
            'service' => $service
        ];
        
        return view('public/service_detail', $data);
    }
    
    public function doctors()
    {
        $data = [
            'title' => 'Our Doctors - Mithlesh Nursing Home',
            'doctors' => $this->doctorModel->getActiveDoctors()
        ];
        
        return view('public/doctors', $data);
    }
    
    public function contact()
    {
        $data = [
            'title' => 'Contact Us - Mithlesh Nursing Home'
        ];
        
        return view('public/contact', $data);
    }
    
    public function submitInquiry()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'phone' => 'required|max_length[20]',
            'subject' => 'required|max_length[200]',
            'message' => 'required',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
            'status' => 'New',
        ];
        
        $this->inquiryModel->insert($data);
        
        return redirect()->to('contact')
                        ->with('success', 'Thank you for your inquiry. We will get back to you soon.');
    }
    
    public function camps()
    {
        $campsDir = FCPATH . 'images/camps/';
        $camps = [];
        
        if (is_dir($campsDir)) {
            $files = scandir($campsDir);
            foreach ($files as $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $camps[] = [
                        'image' => 'images/camps/' . $file,
                        'title' => ucfirst(str_replace(['.jpg', '.jpeg', '.png', '.gif'], '', $file)),
                        'description' => $this->getCampDescription($file)
                    ];
                }
            }
        }
        
        $data = [
            'title' => 'Medical Camps - Mithlesh Nursing Home',
            'camps' => $camps
        ];
        
        return view('public/camps', $data);
    }
    
    private function getCampDescription($filename)
    {
        $descriptions = [
            'apendex.jpg' => 'Advanced laparoscopic appendix surgery camp with expert surgeons.',
            'ayushman.jpg' => 'Ayushman Bharat health camp providing free medical checkups.',
            'gathiya.jpg' => 'Arthritis treatment and joint care awareness camp.',
            'gyanee.jpg' => 'General health awareness and educational camp.',
            'laproscopy.jpg' => 'Minimally invasive laparoscopic surgery demonstrations and consultations.',
            'ortho.jpg' => 'Orthopedic health camp for bone and joint problems.',
        ];
        
        return $descriptions[strtolower($filename)] ?? 'Medical camp organized by Mithlesh Nursing Home.';
    }
}
