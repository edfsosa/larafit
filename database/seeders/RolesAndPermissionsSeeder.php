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
     */
    public function run(): void
    {
        $models = [
            'usuario',
            'rol',
            'permiso',
            'miembro',
            'entrenador',
            'asistencia',
            'equipo',
            'ejercicio',
            'membresia',
            'pago',
            'rutina',
            'reseña',
        ];

        $actions = ['Crear', 'Ver', 'Editar', 'Borrar'];

        foreach ($models as $model) {
            foreach ($actions as $action) {
                $permissionName = "{$action} {$model}";
                Permission::firstOrCreate(['name' => $permissionName]);
            }
        }

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $trainer = Role::firstOrCreate(['name' => 'Entrenador']);
        $member = Role::firstOrCreate(['name' => 'Miembro']);

        $admin->givePermissionTo(Permission::all());
        $trainer->givePermissionTo([
            'Ver miembro',
            'Editar miembro',
            'Crear asistencia',
            'Ver asistencia',
            'Editar asistencia',
            'Borrar asistencia',
            'Crear ejercicio',
            'Ver ejercicio',
            'Editar ejercicio',
            'Borrar ejercicio',
            'Crear rutina',
            'Ver rutina',
            'Editar rutina',
            'Borrar rutina',
            'Crear reseña',
            'Ver reseña',
            'Editar reseña',
            'Borrar reseña',
        ]);
        $member->givePermissionTo([
            'Ver ejercicio',
            'Ver rutina',
            'Ver membresia',
            'Ver asistencia',
            'Crear reseña',
            'Ver reseña',
            'Editar reseña',
            'Borrar reseña',
            'Crear pago',
            'Ver pago',
            'Editar pago',
            'Borrar pago'
        ]);
    }
}
