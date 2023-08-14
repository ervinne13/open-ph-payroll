<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $acme = new Company();
        $acme->short_name = 'ACME';
        $acme->display_name = 'ACME Corporation';
        $acme->address = 'Road Runner/Wile E. Coyote Fictional company address';
        $acme->save();
    }
}
