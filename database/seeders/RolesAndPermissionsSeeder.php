<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        // Create permissions for users
        Permission::create(['name' => 'show user']);
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        // Create permissions for articles
        Permission::create(['name' => 'add article']);
        Permission::create(['name' => 'edit my article']);
        Permission::create(['name' => 'edit every article']);
        Permission::create(['name' => 'delete my article']);
        Permission::create(['name' => 'delete every article']);

        // Create permissions for categories
        Permission::create(['name' => 'show category']);
        Permission::create(['name' => 'add category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);

        // Create permissions for tags
        Permission::create(['name' => 'show tag']);
        Permission::create(['name' => 'add tag']);
        Permission::create(['name' => 'edit tag']);
        Permission::create(['name' => 'delete tag']);

        // Create permissions for comment
        Permission::create(['name' => 'show comment']);
        Permission::create(['name' => 'add comment']);
        Permission::create(['name' => 'edit my comment']);
        Permission::create(['name' => 'edit every comment']);
        Permission::create(['name' => 'delete my comment']);
        Permission::create(['name' => 'delete every comment']);


        // create role admin and assign permissions (3)
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());

        // create role author and assign permissions (2)
        Role::create(['name' => 'author'])
            ->givePermissionTo([
                'add article',
                'edit my article',
                'delete my article',
                'add comment',
                'edit my comment',
                'delete my comment'
            ]);

        // create role user and assign permissions (1)
        Role::create(['name' => 'user'])
            ->givePermissionTo([
                'add comment',
                'edit my comment',
                'delete my comment',
            ]);


    }
}
