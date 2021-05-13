<?php

use App\Models\User;
use App\Models\Project;
use App\Models\Activity;
use App\Models\Task;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
    $this->activity = Activity::factory()->create();
    $this->task = Task::factory()->create();
});

test('admin can see the task admin index page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('tasks.index'))
        ->assertViewIs('admin.tasks.index')
        ->assertSee($this->task->id)
        ->assertSee($this->task->task)
        ->assertSee($this->task->begindate->toDateString())
        ->assertSee($this->task->enddate->toDateString())
        ->assertSee($this->task->user->name)
        ->assertSee($this->task->project->name)
        ->assertSee($this->task->activity->name)
        ->assertStatus(200);
})->group( 'TaskIndex', 'Opdracht16', 'Website');

test('teacher can see the task admin index page', function()
{
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher)
        ->get(route('tasks.index'))
        ->assertViewIs('admin.tasks.index')
        ->assertSee($this->task->id)
        ->assertSee($this->task->task)
        ->assertSee($this->task->begindate->toDateString())
        ->assertSee($this->task->enddate->toDateString())
        ->assertSee($this->task->user->name)
        ->assertSee($this->task->project->name)
        ->assertSee($this->task->activity->name)
        ->assertStatus(200);
})->group( 'TaskIndex', 'Opdracht16', 'Website');

test('student can see the task admin index page', function()
{
    $this->withoutExceptionHandling();
    $student = User::find(1);
    Laravel\be($student)
        ->get(route('tasks.index'))
        ->assertViewIs('admin.tasks.index')
        ->assertSee($this->task->id)
        ->assertSee($this->task->task)
        ->assertSee($this->task->begindate->toDateString())
        ->assertSee($this->task->enddate->toDateString())
        ->assertSee($this->task->user->name)
        ->assertSee($this->task->project->name)
        ->assertSee($this->task->activity->name)
        ->assertStatus(200);
})->group( 'TaskIndex', 'Opdracht16', 'Website');

test('guest can not see the task admin index page', function(){
    $this->get(route('tasks.index'))
        ->assertRedirect(route('login'));
})->group('TaskIndex', 'Opdracht16', 'Website');





