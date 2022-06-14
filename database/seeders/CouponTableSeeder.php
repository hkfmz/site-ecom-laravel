<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Coupon;

class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'ABCD',
            'percentage' => '40',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
