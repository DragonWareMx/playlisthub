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
            'full-access'=>'no'
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

         $user1=User::find(5);
        // $user2=User::find(2);

         $user1->roles()->sync([$rolAdmin->id]);
        // $user2->roles()->sync([$rolAdmin->id]);

        //permisos
        $permission_all=[];
        $permission_mus=[];
        $permission_cur=[];
        $permission_adm=[];


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

        $permission=Permission::create([
            'name'=>'Admin',
            'slug'=>'admin.perm',
            'description'=>'El usuario es un Admin'
        ]); 
        $permission_all[]=$permission->id;
        $permission_adm[]=$permission->id; 

        $rolAdmin->permissions()->sync($permission_adm);
        $rolCurador->permissions()->sync($permission_cur);
        $rolMusico->permissions()->sync($permission_mus);
    }
}
