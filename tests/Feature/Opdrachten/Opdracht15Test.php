<?php

use App\Models\Project;
use App\Models\Activity;
use App\Models\Task;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
    $this->activity = Activity::factory()->create();
    $this->task = Task::factory()->create();
});

test('index page of the task admin is visable with tasks on the page', function()
{
    $this->withoutExceptionHandling();
    $this->get(route('tasks.index'))
        ->assertViewIs('admin.tasks.index')
        ->assertSee($this->task->id)
        ->assertSee($this->task->task)
        ->assertSee($this->task->begindate->toDateString())
        ->assertSee($this->task->enddate->toDateString())
        ->assertSee($this->task->user->name)
        ->assertSee($this->task->project->name)
        ->assertSee($this->task->activity->name)
        ->assertStatus(200);
})->group('Opdracht15');
