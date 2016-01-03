<?php

use Illuminate\Database\Seeder;

class ExpertRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Md\Bongo_request::truncate();

        DB::table('bongo_requests')->insert([
            'bongo_email' => 'expert@bongo.com',
            'first_name' => 'Expert',
            'last_name' => 'Expert',
            'company' => 'Bongo Afrika',
            'job_title' => 'Programmer',
            'field'    => 'php,laravel',
            'request_status' => '2',
            'created_at'  => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at'  =>  \Carbon\Carbon::now()->toDateTimeString(),

        ]);
    }
}
