<?php

use Illuminate\Database\Seeder;

class InvestorRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Md\Investor_request::truncate();


        DB::table('investor_requests')->insert([
            'investor_email' => 'investor@bongo.com',
            'first_name' => 'Investor',
            'last_name' => 'Investor',
            'company' => 'Bongo Afrika',
            'job_title' => 'Programmer',
            'request_status' => '2',
            'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at'  =>  \Carbon\Carbon::now()->toDateTimeString(),

        ]);
    }
}
