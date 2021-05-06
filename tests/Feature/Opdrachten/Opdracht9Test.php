<?php

use App\Models\Project;

beforeEach(function (){
    $this->project = Project::factory()->create();
    $this->seed('ProjectSeeder');
});

test('delete project page is visable', function()
{
    $this->withoutExceptionHandling();
    $this->get(route('projects.delete',['project' => $this->project->id]))
        ->assertViewIs('admin.projects.delete')
        ->assertSee($this->project->name)
        ->assertSee($this->project->description)
        ->assertStatus(200);
})->group('Opdracht9');

test('a project can be deleted', function(){
    $this->json('DELETE', route('projects.destroy', ['project' => $this->project->id]))
        ->assertRedirect(route('projects.index'));
    $this->assertDatabaseMissing('projects', ['id' => $this->project->id]);
})->group('Opdracht9');
