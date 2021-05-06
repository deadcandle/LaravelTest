<?php

use App\Models\User;
use App\Models\Project;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
});

test('a project cant be updated with empty name in the database', function () {
    $admin = User::find(3);
    $project = Project::factory()->make(['name' => null, 'description' => 'dit is een test project']);
    Laravel\be($admin)->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertStatus(422);
})->group('ProjectUpdateCheck', 'Opdracht11', 'Website');

test('A project cant be updated when the name is less then 5 characters long', function () {
    $admin = User::find(3);
    $project = Project::factory()->make(['name' => 'test', 'description' => 'dit is een test project']);
    Laravel\be($admin)->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertStatus(422);
})->group('ProjectUpdateCheck', 'Opdracht11', 'Website');

test('A project cant be updated when the name is more then 45 characters long', function () {
    $admin = User::find(3);
    $project = Project::factory()->make(['name' => 'TestingIfThisNameCanBeMoreThen45CharactersLong', 'description' => 'dit is een test project']);
    Laravel\be($admin)->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertStatus(422);
})->group('ProjectUpdateCheck', 'Opdracht11', 'Website');

test('when updating a project the name is unique', function () {
    $admin = User::find(3);
    $project1 = Project::factory()->create(['name' => 'testing123']);
    $project2 = Project::factory()->make(['name' => 'testing123', 'description' => 'dit is een test project']);
    Laravel\be($admin)->patchJson(route('projects.update',['project' => $this->project->id]), $project2->toArray())
        ->assertStatus(422);
})->group('ProjectUpdateCheck', 'Opdracht11', 'Website');

test('a project cant be updated with empty description in the database', function () {
    $admin = User::find(3);
    $project = Project::factory()->make(['name' => 'testing123', 'description' => null]);
    Laravel\be($admin)->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertStatus(422);
})->group('ProjectUpdateCheck', 'Opdracht11', 'Website');
