<?php

namespace Database\Seeders;

//use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'zamshed@gmail.com',
            'email' => 'admin@gmail.com',
            'phone' => '01843215702',
            'password' => bcrypt('12345678'),
        ]);

        $account_person = User::create([
            'name' => 'Account person',
            'email' => 'account@gmail.com',
            'phone' => '01843215702',
            'password' => bcrypt('12345678'),
        ]);
        // permission create
        $permissions = [
            'user-access',
            'user-lists',
            'user-create',
            'user-edit',
            'user-show',
            'user-delete',
            'user-profile',
            'role-permission-access',
            'role-permission-lists',
            'role-permission-create',
            'role-permission-edit',
            'role-permission-show',
            'role-permission-delete',
            'permission-assign',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name'=>$permission,
            ]);
        }

        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => 'web'])
            ->givePermissionTo([
                'user-access',
                'user-lists',
                'user-create',
                'user-edit',
                'user-show',
                'user-delete',
                'user-profile',
                'role-permission-access',
                'role-permission-lists',
                'role-permission-create',
                'role-permission-edit',
                'role-permission-show',
                'role-permission-delete',
                'permission-assign',

            ]);
        $acountRole = Role::create(['name' => 'Account Person', 'guard_name' => 'web'])
            ->givePermissionTo([
                'user-access',
                'user-lists',
                'user-show',
                'user-profile',
            ]);

        // user role assign
        $admin->assignRole([$adminRole->id]);
        $account_person->assignRole([$acountRole->id]);

    }
}
