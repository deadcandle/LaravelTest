<?php

use App\Models\User;
use App\Models\Project;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
});

test('admin can see the project create page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('projects.create'))
        ->assertViewIs('admin.projects.create')
        ->assertStatus(200);
})->group('ProjectCreate', 'Opdracht11', 'Website');

test('teacher can see the product create page', function()
{
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher)
        ->get(route('projects.create'))
        ->assertViewIs('admin.projects.create')
        ->assertStatus(200);
})->group('ProjectCreate', 'Opdracht11', 'Website');

test('student can see the product create page', function()
{
    $this->withoutExceptionHandling();
    $student = User::find(1);
    Laravel\be($student)
        ->get(route('projects.create'))
        ->assertViewIs('admin.projects.create')
        ->assertStatus(200);
})->group('ProjectCreate', 'Opdracht11', 'Website');

test('guest can not see the project create page', function(){
    $this->get(route('projects.create'))
        ->assertRedirect(route('login'));
})->group('ProjectCreate', 'Opdracht11', 'Website');



