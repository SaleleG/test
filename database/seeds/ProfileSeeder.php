<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\{Permission,User,Profile};

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->delete();
        DB::table('profiles')->insert([
            [
                'name' => 'Cassier',
                'slug' => 'cassier'
            ],
            [
                'name' => 'Gestionnaire',
                'slug' => 'gestionnaire'
            ],
            [
                'name' => 'Administrateur',
                'slug' => 'administrateur'
            ]
        ]);
    }
}
