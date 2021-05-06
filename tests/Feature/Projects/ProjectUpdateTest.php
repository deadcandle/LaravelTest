<?php

use App\Models\User;
use App\Models\Project;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
});

test('an admin can update a project in the database', function () {
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin);
    $project = Project::factory()->make(['name' => 'testproject', 'description' => 'dit is een test project']);

    $this->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertRedirect(route('projects.index'));

    $this->assertDatabaseHas('projects',[
        'id' => $this->project->id,
        'name' => 'testproject',
        'description' => 'dit is een test project'
    ]);
})->group('ProjectUpdate', 'Opdracht11', 'Website');

test('a teacher can update a project in the database', function () {
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher);
    $project = Project::factory()->make(['name' => 'testproject', 'description' => 'dit is een test project']);

    $this->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertRedirect(route('projects.index'));

    $this->assertDatabaseHas('projects',[
        'id' => $this->project->id,
        'name' => 'testproject',
        'description' => 'dit is een test project'
    ]);
})->group('ProjectUpdate', 'Opdracht11', 'Website');

test('a student can update a project in the database', function () {
    $this->withoutExceptionHandling();
    $student = User::find(1);
    Laravel\be($student);
    $project = Project::factory()->make(['name' => 'testproject', 'description' => 'dit is een test project']);

    $this->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertRedirect(route('projects.index'));

    $this->assertDatabaseHas('projects',[
        'id' => $this->project->id,
        'name' => 'testproject',
        'description' => 'dit is een test project'
    ]);
})->group('ProjectUpdate', 'Opdracht11', 'Website');

test('a guest can not update a project in the database', function () {
    $project = Project::factory()->make(['name' => 'testproject', 'description' => 'dit is een test project']);

    $this->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertStatus(401);
})->group('ProjectUpdate', 'Opdracht11', 'Website');

