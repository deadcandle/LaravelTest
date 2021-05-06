<?php

use App\Models\Project;

beforeEach(function (){
    $this->project = Project::factory()->create();
    $this->seed('ProjectSeeder');
});

test('when posting a project it requires a name', function () {
    $project = Project::factory()->make(['name' => null, 'description' => 'dit is een test project']);

    $this->postJson(route('projects.store'), $project->toArray())
        ->assertStatus(422);
})->group('Opdracht6');

test('when posting a project the name is minimal 5 characters long', function () {
    $project = Project::factory()->make(['name' => 'test', 'description' => 'dit is een test project']);

    $this->postJson(route('projects.store'), $project->toArray())
        ->assertStatus(422);
})->group('Opdracht6');

test('when posting a project the name is maximal 45 characters long', function () {
    $project = Project::factory()->make(['name' => 'TestingIfThisNameCanBeMoreThen45CharactersLong', 'description' => 'dit is een test project']);

    $this->postJson(route('projects.store'), $project->toArray())
        ->assertStatus(422);
})->group('Opdracht6');

test('when posting a project the name is unique', function () {
    $project1 = Project::factory()->create(['name' => 'testing123']);
    $project2 = Project::factory()->make(['name' => 'testing123', 'description' => 'dit is een test project']);

    $this->postJson(route('projects.store'), $project2->toArray())
        ->assertStatus(422);
})->group('Opdracht6');

test('when posting a project it requires a description', function () {
    $project = Project::factory()->make(['name' => 'testing123', 'description' => null]);

    $this->postJson(route('projects.store'), $project->toArray())
        ->assertStatus(422);
})->group('Opdracht6');
