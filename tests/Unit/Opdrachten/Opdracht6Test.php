<?php
use App\Models\Project;

beforeEach(function (){
    $this->project = Project::factory()->create();
    $this->seed('ProjectSeeder');
});

test('a project name is minimal 5 characters long', function(){
    expect(strlen($this->project->name))->toBeGreaterThanOrEqual(5);
})->group('Opdracht6');

test('a project name is maximum 45 characters long', function(){
    expect(strlen($this->project->name))->toBeLessThanOrEqual(45);
})->group('Opdracht6');


