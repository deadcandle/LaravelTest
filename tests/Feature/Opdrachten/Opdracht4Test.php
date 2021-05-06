<?php

use App\Models\Project;

beforeEach(function (){
    $this->project = Project::factory()->create();
    $this->seed('ProjectSeeder');
});

test('index page is visable with project on the page', function()
{
    $this->withoutExceptionHandling();
    $this->get(route('projects.index'))
        ->assertViewIs('admin.projects.index')
        ->assertSee($this->project->id)
        ->assertSee($this->project->name)
        ->assertStatus(200);
})->group('Opdracht3_4');
