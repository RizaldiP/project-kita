<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@comprokita.test',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        Setting::setValue('company_name', 'Compro-Kita');
        Setting::setValue('company_tagline', 'Solusi Source Code Terbaik');
        Setting::setValue('company_description', 'Kami menyediakan berbagai source code dan sistem siap pakai untuk kebutuhan bisnis dan proyek Anda. Dapatkan solusi terbaik dengan harga terjangkau.');
        Setting::setValue('contact_email', 'admin@comprokita.test');
        Setting::setValue('contact_phone', '0812-3456-7890');
        Setting::setValue('bank_name', 'Bank Mandiri');
        Setting::setValue('bank_account', '123-00-1234567-8');
        Setting::setValue('bank_holder', 'Compro-Kita');
    }
}
