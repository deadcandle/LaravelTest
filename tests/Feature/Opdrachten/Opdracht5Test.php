<?php

use App\Models\Project;

beforeEach(function (){
    $this->project = Project::factory()->create();
    $this->seed('ProjectSeeder');
});

test('create project page is visable', function()
{
    $this->withoutExceptionHandling();
    $this->get(route('projects.create'))
        ->assertViewIs('admin.projects.create')
        ->assertStatus(200);
})->group('Opdracht5');

test('a project can de stored in the database', function () {
    $project = Project::factory()->make(['name' => 'testproject', 'description' => 'dit is een test project']);

    $this->postJson(route('projects.store'), $project->toArray())
        ->assertRedirect(route('projects.index'));

    $this->assertDatabaseHas('projects',[
        'name' => 'testproject',
        'description' => 'dit is een test project'
    ]);
})->group('Opdracht5');
