<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{

    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {

        // try {

        //     DB::beginTransaction();

            // Reset cached roles and permissions
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            // create permissions

            Permission::create([ 'name'     => 'edit articles'      ]);
            Permission::create([ 'name'     => 'delete articles'    ]);
            Permission::create([ 'name'     => 'publish articles'   ]);
            Permission::create([ 'name'     => 'unpublish articles' ]);

            // create roles and assign existing permissions

            $role1 = Role::create([ 'name'  => 'writer'          ]);

            $role1->givePermissionTo('edit articles');
            $role1->givePermissionTo('delete articles');

            $role2 = Role::create([ 'name'  => 'admin'           ]);

            $role2->givePermissionTo('publish articles');
            $role2->givePermissionTo('unpublish articles');

            $role3 = Role::create([ 'name'  => 'super-admin'     ]);

            // gets all permissions via Gate::before rule; see AuthServiceProvider

            // create demo users

            $user = User::create([

                'name'      => 'Example User',
                'email'     => 'test@example.com',
                'password'  => md5('11')
            ]);

            $user->assignRole($role1);

//          dd('here');
            $user =  User::create([

                'name'      => 'Example Admin User',
                'email'     => 'admin@example.com',
                'password'  => md5('11')
            ]);

            $user->assignRole($role2);

            $user =  User::create([
                'name'      => 'Example Super-Admin User',
                'email'     => 'superadmin@example.com',
                'password'  => md5('11')
            ]);

            $user->assignRole($role3);

        //     DB::commit();
        // }
        // catch (\Exception $exception) {

        //     DB::rollBack();

        //     \Log::error('Loi:' . $exception->getMessage() . $exception->getLine());
        // }
    }
}
