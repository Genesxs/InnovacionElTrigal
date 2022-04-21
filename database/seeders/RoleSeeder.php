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
        $role1=Role::create(['name'=>'Admin']);
        $role2=Role::create(['name'=>'Innovador']);

        Permission::create(['name'=>'admin.home.admin'])->syncRoles([$role1]); //para luego proteger la ruta del home del admin
        Permission::create(['name'=>'admin.home.innovador'])->syncRoles([$role2]); //para luego proteger la ruta del home del admin
        Permission::create(['name'=>'admin.ideas.index'])->syncRoles([$role1,$role2]);//para ver la lista de ideas tanto en rol administrador como innovador
        Permission::create(['name'=>'admin.ideas.crear'])->syncRoles([$role2]);
        Permission::create(['name'=>'admin.ideas.editar'])->syncRoles([$role2]);
        Permission::create(['name'=>'admin.ideas.eliminar'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.ideas.evaluar'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.ideas.participantes'])->syncRoles([$role2]);
    }
}
