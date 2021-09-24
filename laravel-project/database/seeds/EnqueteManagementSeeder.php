<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnqueteManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_enquete_management')->truncate();
        $enquete = factory(App\Models\EnqueteManagement::class, 100)->create();
    }
}
