<?php

namespace App\Controllers;

class Home extends BaseController {
    public function index(): string {
        return view('welcome_message');
    }
    
    public function about(): string {
        return view('about');
    }
    
    public function contact(): string {
        return view('contact');
    }
    
    public function home(): string {
        return view('home');
    }
    
    public function login(): string {
        return view('login');
    }
    
    public function register(): string {
        return view('register');
    }
    
    public function profile(): string {
        return view('profile');
    }
    
    public function logout(): string {
        return view('logout');
    }
    
    public function paymentform(): string {
        return view('paymentform');
    }
    
    public function paymenttotal(): string {
        return view('paymenttotal');
    }
}
