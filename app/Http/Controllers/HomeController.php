<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->latest()->take(6)->get();
        $companyName = Setting::getValue('company_name', 'Compro-Kita');
        $companyTagline = Setting::getValue('company_tagline', 'Solusi Source Code Terbaik');
        $companyDescription = Setting::getValue('company_description', 'Kami menyediakan berbagai source code dan sistem siap pakai untuk kebutuhan Anda.');
        $contactEmail = Setting::getValue('contact_email', '');
        $contactPhone = Setting::getValue('contact_phone', '');
        $bankName = Setting::getValue('bank_name', '');
        $bankAccount = Setting::getValue('bank_account', '');
        $bankHolder = Setting::getValue('bank_holder', '');

        return view('home', compact(
            'products', 'companyName', 'companyTagline', 'companyDescription',
            'contactEmail', 'contactPhone', 'bankName', 'bankAccount', 'bankHolder'
        ));
    }
}
