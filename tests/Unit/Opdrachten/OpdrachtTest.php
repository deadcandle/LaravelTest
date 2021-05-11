<?php

use App\Models\Project;

beforeEach(function (){
    $this->project = Project::factory()->create();
    $this->seed('ProjectSeeder');
});

test('Data from factory is in the projects table', function () {
    $this->assertDatabaseHas('projects', [
        'id' => $this->project->id,
        'name' => $this->project->name
    ]);
})->group('Opdracht1_2');

test('a project id is a int', function(){
    expect($this->project->id)->toBeInt();
})->group('Opdracht1_2');

test('a project name is a string', function(){
    expect($this->project->name)->toBeString();
})->group('Opdracht1_2');







