<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::create(['name' => 'TI / Suporte', 'code' => 'TI']);
        Department::create(['name' => 'Sistemas & Software', 'code' => 'SOFT']);
        Department::create(['name' => 'Recursos Humanos', 'code' => 'RH']);
        Department::create(['name' => 'Infraestrutura & Manutenção', 'code' => 'INFRA']);
    }
}