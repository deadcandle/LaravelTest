<?php

use App\Models\User;
use App\Models\Project;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
});

test('admin can see the project delete page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('projects.delete',['project' => $this->project->id]))
        ->assertViewIs('admin.projects.delete')
        ->assertSee($this->project->name)
        ->assertSee($this->project->description)
        ->assertStatus(200);
})->group('ProjectDelete', 'Opdracht11', 'Website');

test('teacher can see the product delete page', function()
{
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher)
        ->get(route('projects.delete',['project' => $this->project->id]))
        ->assertViewIs('admin.projects.delete')
        ->assertSee($this->project->name)
        ->assertSee($this->project->description)
        ->assertStatus(200);
})->group('ProjectDelete', 'Opdracht11', 'Website');

test('student can not see the project delete page', function(){
    $student = User::find(1);
    Laravel\be($student);
    $this->get(route('projects.delete',['project' => $this->project->id]))
        ->assertForbidden();
})->group('ProjectDelete', 'Opdracht11', 'Website');

test('guest can not see the project delete page', function(){
    $this->get(route('projects.delete',['project' => $this->project->id]))
        ->assertRedirect(route('login'));
})->group('ProjectDelete', 'Opdracht11', 'Website');



