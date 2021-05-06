<?php

use App\Models\User;
use App\Models\Project;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
});

test('admin can see the project edit page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('projects.edit',['project' => $this->project->id]))
        ->assertViewIs('admin.projects.edit')
        ->assertSee($this->project->name)
        ->assertSee($this->project->description)
        ->assertStatus(200);
})->group('ProjectEdit', 'Opdracht11', 'Website');

test('teacher can see the product edit page', function()
{
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher)
        ->get(route('projects.edit',['project' => $this->project->id]))
        ->assertViewIs('admin.projects.edit')
        ->assertSee($this->project->name)
        ->assertSee($this->project->description)
        ->assertStatus(200);
})->group('ProjectEdit', 'Opdracht11', 'Website');

test('student can see the product edit page', function()
{
    $this->withoutExceptionHandling();
    $student = User::find(1);
    Laravel\be($student)
        ->get(route('projects.edit',['project' => $this->project->id]))
        ->assertViewIs('admin.projects.edit')
        ->assertSee($this->project->name)
        ->assertSee($this->project->description)
        ->assertStatus(200);
})->group('ProjectEdit', 'Opdracht11', 'Website');

test('guest can not see the project edit page', function(){
    $this->get(route('projects.edit',['project' => $this->project->id]))
        ->assertRedirect(route('login'));
})->group('ProjectEdit', 'Opdracht11', 'Website');



