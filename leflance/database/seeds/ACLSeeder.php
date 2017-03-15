<?php

use Illuminate\Database\Seeder;
use App\Models\ACL\Role;

class ACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create base roles
         */
        $user = new Role();
        $user->name         = $user::USER_ROLE;
        $user->save();

        $admin = new Role();
        $admin->name         = $user::ADMIN_ROLE;
        $admin->save();
    }
}
