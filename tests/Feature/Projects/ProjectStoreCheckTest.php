<?php

use App\Models\User;
use App\Models\Project;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
});

test('when posting a project it requires a name', function () {
    $admin = User::find(3);
    $project = Project::factory()->make(['name' => null, 'description' => 'dit is een test project']);
    Laravel\be($admin)->postJson(route('projects.store'), $project->toArray())
        ->assertStatus(422);
})->group('ProjectStoreCheck', 'Opdracht11', 'Website');

test('when posting a project the name is minimal 5 characters long', function () {
    $admin = User::find(3);
    $project = Project::factory()->make(['name' => 'test', 'description' => 'dit is een test project']);
    Laravel\be($admin)->postJson(route('projects.store'), $project->toArray())
        ->assertStatus(422);
})->group('ProjectStoreCheck', 'Opdracht11', 'Website');

test('when posting a project the name is maximal 45 characters long', function () {
    $admin = User::find(3);
    $project = Project::factory()->make(['name' => 'TestingIfThisNameCanBeMoreThen45CharactersLong', 'description' => 'dit is een test project']);
    Laravel\be($admin)->postJson(route('projects.store'), $project->toArray())
        ->assertStatus(422);
})->group('ProjectStoreCheck', 'Opdracht11', 'Website');

test('when posting a project the name is unique', function () {
    $admin = User::find(3);
    $project1 = Project::factory()->create(['name' => 'testing123']);
    $project2 = Project::factory()->make(['name' => 'testing123', 'description' => 'dit is een test project']);
    Laravel\be($admin)->postJson(route('projects.store'), $project2->toArray())
        ->assertStatus(422);
})->group('ProjectStoreCheck', 'Opdracht11', 'Website');

test('when posting a project it requires a description', function () {
    $admin = User::find(3);
    $project = Project::factory()->make(['name' => 'testing123', 'description' => null]);
    Laravel\be($admin)->postJson(route('projects.store'), $project->toArray())
        ->assertStatus(422);
})->group('ProjectStoreCheck', 'Opdracht11', 'Website');
