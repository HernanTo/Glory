<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = Role::create(['name' => 'Administrador']);
        $gerente = Role::create(['name' => 'Gerente']);
        $clienteWeb = Role::create(['name' => 'Cliente Web']);
        $cliente = Role::create(['name' => 'Cliente']);
        $servicios = Role::create(['name' => 'Servicios']);
        $vendedor = Role::create(['name' => 'Vendedor']);

    // Permission Global
        Permission::create(['name' => 'getInto.administration'])->syncRoles([$administrador, $gerente, $servicios, $vendedor]);
    // Permission Global

    // Permission Users
        Permission::create(['name' => 'see.users'])->syncRoles([$administrador, $gerente, $servicios, $vendedor]);
        Permission::create(['name' => 'see.admin'])->syncRoles([$administrador]);
        Permission::create(['name' => 'see.manager'])->syncRoles([$administrador]);
        Permission::create(['name' => 'see.workers'])->syncRoles([$administrador, $gerente]);
        Permission::create(['name' => 'see.clientes'])->syncRoles([$administrador, $gerente, $vendedor, $servicios]);

        Permission::create(['name' => 'create.users'])->syncRoles([$administrador, $gerente, $servicios, $vendedor]);
        Permission::create(['name' => 'create.admin'])->syncRoles([$administrador]);
        Permission::create(['name' => 'create.manager'])->syncRoles([$administrador, $gerente]);
        Permission::create(['name' => 'create.workers'])->syncRoles([$administrador, $gerente]);
        Permission::create(['name' => 'create.clientes'])->syncRoles([$administrador, $gerente, $vendedor, $servicios]);

        Permission::create(['name' => 'edit.admin'])->syncRoles([$administrador]);
        Permission::create(['name' => 'edit.manager'])->syncRoles([$administrador]);
        Permission::create(['name' => 'edit.workers'])->syncRoles([$administrador, $gerente]);
        Permission::create(['name' => 'edit.clientes'])->syncRoles([$administrador, $gerente, $vendedor, $servicios]);

        Permission::create(['name' => 'delete.admin'])->syncRoles([$administrador]);
        Permission::create(['name' => 'delete.manager'])->syncRoles([$administrador]);
        Permission::create(['name' => 'delete.workers'])->syncRoles([$administrador, $gerente]);
        Permission::create(['name' => 'delete.clientes'])->syncRoles([$administrador, $gerente, $vendedor, $servicios]);
    // Permission Users

    // Permission Product
        Permission::create(['name' => 'see.products.dash'])->syncRoles([$administrador, $gerente, $servicios, $vendedor]);
        Permission::create(['name' => 'create.products.dash'])->syncRoles([$administrador, $gerente]);
        Permission::create(['name' => 'see.cost.product.dash'])->syncRoles([$administrador, $gerente]);
        Permission::create(['name' => 'edit.products.dash'])->syncRoles([$administrador, $gerente]);
        Permission::create(['name' => 'destroy.products.dash'])->syncRoles([$administrador, $gerente]);
    // Permission Product
}
}