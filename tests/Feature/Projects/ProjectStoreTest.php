<?php

use App\Models\User;
use App\Models\Project;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
});

test('an admin can store a project in the database', function () {
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    $project = Project::factory()->make(['name' => 'testproject', 'description' => 'dit is een test project']);

    Laravel\be($admin)
        ->postJson(route('projects.store'), $project->toArray())
        ->assertRedirect(route('projects.index'));

    $this->assertDatabaseHas('projects',[
        'name' => 'testproject',
        'description' => 'dit is een test project'
    ]);
})->group('ProjectStore', 'Opdracht11', 'Website');

test('a teacher can store a project in the database', function () {
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    $project = Project::factory()->make(['name' => 'testproject', 'description' => 'dit is een test project']);

    Laravel\be($teacher)
        ->postJson(route('projects.store'), $project->toArray())
        ->assertRedirect(route('projects.index'));

    $this->assertDatabaseHas('projects',[
        'name' => 'testproject',
        'description' => 'dit is een test project'
    ]);
})->group('ProjectStore', 'Opdracht11', 'Website');

test('a student can store a project in the database', function () {
    $this->withoutExceptionHandling();
    $student = User::find(1);
    $project = Project::factory()->make(['name' => 'testproject', 'description' => 'dit is een test project']);

    Laravel\be($student)
        ->postJson(route('projects.store'), $project->toArray())
        ->assertRedirect(route('projects.index'));

    $this->assertDatabaseHas('projects',[
        'name' => 'testproject',
        'description' => 'dit is een test project'
    ]);
})->group('ProjectStore', 'Opdracht11', 'Website');

test('a guest can not store a project in the database', function () {
    $project = Project::factory()->make(['name' => 'testproject', 'description' => 'dit is een test project']);
    $this->postJson(route('projects.store'), $project->toArray())
        ->assertStatus(401);
})->group('ProjectStore', 'Opdracht11', 'Website');

