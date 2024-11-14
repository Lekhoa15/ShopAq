<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'subject' => 'Inquiry about product',
            'message' => 'Can I get more details about product 1?',
        ]);

        Contact::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'subject' => 'Order issue',
            'message' => 'I have an issue with my recent order.',
        ]);
    }
}
