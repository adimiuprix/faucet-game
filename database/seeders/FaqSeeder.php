<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'I want to create multiple accounts, is it allowed?',
                'answer' => 'Why would you want to do that? You can only have one account per person. If you create multiple accounts, we will ban all of them without any warning.',
            ],
            [
                'question' => 'I want to use Adblocker, ads irretate me. Is it allowed?',
                'answer' => 'If you block ads, how site will earn money to pay you? So, using Adblocker is not allowed and if you do so,',
            ],
            [
                'question' => 'I am innocent, why my account is banned?',
                'answer' => 'There are many reasons for banning an account. If you think you are innocent, contact us on Telegram.',
            ],
            [
                'question' => 'I cant login to my account?',
                'answer' => 'Please clear your browser browsing history, cookies & site data, cached images & files',
            ],
            [
                'question' => 'How long does it take to get my money to my FaucetPay wallet?',
                'answer' => 'All Claims & Withdrawals are processed instantly',
            ],
        ];

        Faq::insert($faqs);
    }
}
