<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        $owner = User::factory()->create([
            'name' => 'UPNEZ Owner',
            'email' => 'owner@upnez.com',
            'role' => 'owner',
            'department' => 'Management',
        ]);
        $owner->assignRole('owner');

        $manager = User::factory()->create([
            'name' => 'UPNEZ Manager',
            'email' => 'manager@upnez.com',
            'role' => 'manager',
            'department' => 'Operations',
        ]);
        $manager->assignRole('manager');

        User::factory(3)->create(['role' => 'staff'])->each(fn (User $user) => $user->assignRole('staff'));

        Lead::factory(5)->create();
        Client::factory(3)->create();
        Project::factory(2)->create();
        Invoice::factory(3)->create();
    }
}
