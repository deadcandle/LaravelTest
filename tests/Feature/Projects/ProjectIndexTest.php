<?php

use App\Models\User;
use App\Models\Project;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
});

test('admin can see the project index page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('projects.index'))
        ->assertViewIs('admin.projects.index')
        ->assertSee($this->project->id)
        ->assertSee($this->project->name)
        ->assertStatus(200);
})->group('ProjectIndex', 'Opdracht11', 'Website');

test('teacher can see the product index page', function()
{
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher)
        ->get(route('projects.index'))
        ->assertViewIs('admin.projects.index')
        ->assertSee($this->project->id)
        ->assertSee($this->project->name)
        ->assertStatus(200);
})->group('ProjectIndex', 'Opdracht11', 'Website');

test('student can see the product index page', function()
{
    $this->withoutExceptionHandling();
    $student = User::find(1);
    Laravel\be($student)
        ->get(route('projects.index'))
        ->assertViewIs('admin.projects.index')
        ->assertSee($this->project->id)
        ->assertSee($this->project->name)
        ->assertStatus(200);
})->group('ProjectIndex', 'Opdracht11', 'Website');

test('guest can not see the project index page', function(){
    $this->get(route('projects.index'))
        ->assertRedirect(route('login'));
})->group('ProjectIndex', 'Opdracht11', 'Website');



