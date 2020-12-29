<?php

use App\Models\{Permission,User,Profile};
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $user = User::create([
            'name' => 'Admin Seveprox',
            'email' => 'admin@seveprox.ne',
            'phone' => '90000000',
            'email_verified_at' => Carbon::now(),
            'password' => 'admin'
        ]);
        $permissions = Permission::all();
        $profiles = Profile::all();
        $user->permissions()->sync($permissions);
        $user->profiles()->sync($profiles);
    }
}
