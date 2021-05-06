<?php

use App\Models\Project;

beforeEach(function (){
    $this->project = Project::factory()->create();
    $this->seed('ProjectSeeder');
});

test('edit project page is visable', function()
{
    $this->withoutExceptionHandling();
    $this->get(route('projects.edit',['project' => $this->project->id]))
        ->assertViewIs('admin.projects.edit')
        ->assertSee($this->project->name)
        ->assertSee($this->project->description)
        ->assertStatus(200);
})->group('Opdracht8');

test('a project can be updated in the database', function () {
    $project = Project::factory()->make(['name' => 'testproject', 'description' => 'dit is een test project']);

    $this->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertRedirect(route('projects.index'));

    $this->assertDatabaseHas('projects',[
        'id' => $this->project->id,
        'name' => 'testproject',
        'description' => 'dit is een test project'
    ]);
})->group('Opdracht8');

test('a project cant be updated with empty name in the database', function () {
    $project = Project::factory()->make(['name' => null, 'description' => 'dit is een test project']);

    $this->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertStatus(422);
})->group('Opdracht8');

test('a project cant be updated with empty description in the database', function () {
    $project = Project::factory()->make(['name' => 'testproject', 'description' => null]);

    $this->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertStatus(422);
})->group('Opdracht8');

test('A project cant be updated when the name is less then 5 characters long', function () {
    $project = Project::factory()->make(['name' => 'test', 'description' => 'dit is een test project']);

    $this->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertStatus(422);
})->group('Opdracht8');

test('A project cant be updated when the name is more then 45 characters long', function () {
    $project = Project::factory()->make(['name' => 'TestingIfThisNameCanBeMoreThen45CharactersLong', 'description' => 'dit is een test project']);

    $this->patchJson(route('projects.update',['project' => $this->project->id]), $project->toArray())
        ->assertStatus(422);
})->group('Opdracht8');

test('when updating a project the name is unique', function () {
    $project1 = Project::factory()->create(['name' => 'testing123']);
    $project2 = Project::factory()->make(['name' => 'testing123', 'description' => 'dit is een test project']);

    $this->patchJson(route('projects.update',['project' => $this->project->id]), $project2->toArray())
        ->assertStatus(422);
})->group('Opdracht8');


