<?php

use Illuminate\Database\Seeder;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;
use App\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolAdmin=Role::create([
            'name'=>'Administrador',
            'slug'=>'admin',
            'description'=>'Administrador',
            'full-access'=>'yes'
        ]);
        $rolMusico=Role::create([
            'name'=>'Músico',
            'slug'=>'musico',
            'description'=>'Músico',
            'full-access'=>'no'
        ]);

        $rolCurador=Role::create([
            'name'=>'Curador',
            'slug'=>'curador',
            'description'=>'Curador',
            'full-access'=>'no'
        ]);

        // $user1=User::find(1);
        // $user2=User::find(2);

        // $user1->roles()->sync([$rolAdmin->id]);
        // $user2->roles()->sync([$rolAdmin->id]);

        //permisos
        $permission_all=[];
        $permission_mus=[];
        $permission_cur=[];


        ///////////////permisos para Usuarios//////////////////////////////////////////////////////////////////////////
        $permission=Permission::create([
            'name'=>'Curador',
            'slug'=>'curador.perm',
            'description'=>'El usuario es un Curador'
        ]);
        $permission_all[]=$permission->id;
        $permission_cur[]=$permission->id;

        $permission=Permission::create([
            'name'=>'Musico',
            'slug'=>'musico.perm',
            'description'=>'El usuario es un Músico'
        ]);
        $permission_all[]=$permission->id;
        $permission_mus[]=$permission->id;


        $rolAdmin->permissions()->sync($permission_all);
        $rolCurador->permissions()->sync($permission_cur);
        $rolMusico->permissions()->sync($permission_mus);
    }
}
