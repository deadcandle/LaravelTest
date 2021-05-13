<?php

use App\Models\User;
use App\Models\Project;
use App\Models\Activity;
use App\Models\Task;
use Carbon\Carbon;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('ActivitySeeder');
    $this->seed('ProjectSeeder');
    $this->seed('TaskSeeder');
    $this->project = Project::factory()->create();
    $this->activity = Activity::factory()->create();
    $this->task = Task::factory()->create(['task' => 'de eerste taak',
        'begindate' => Carbon::now()->toDateString(),
        'enddate' => Carbon::now()->addDays(10)->toDateString(),
        'user_id' => 1,
        'project_id' => 1,
        'activity_id' => 1]);
});

test('admin can see the task admin delete page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('tasks.delete',['task' => $this->task->id]))
        ->assertViewIs('admin.tasks.delete')
        ->assertSee($this->task->task)
        ->assertSee($this->task->begindate)
        ->assertSee($this->task->enddate)
        ->assertSee($this->task->user->name)
        ->assertSee($this->task->project->name)
        ->assertSee($this->task->activity->name)
        ->assertStatus(200);
})->group('TaskDelete', 'Opdracht20', 'Website');

test('teacher can see the task admin delete page', function()
{
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher)
        ->get(route('tasks.delete',['task' => $this->task->id]))
        ->assertViewIs('admin.tasks.delete')
        ->assertSee($this->task->task)
        ->assertSee($this->task->begindate)
        ->assertSee($this->task->enddate)
        ->assertSee($this->task->user->name)
        ->assertSee($this->task->project->name)
        ->assertSee($this->task->activity->name)
        ->assertStatus(200);
})->group('TaskDelete', 'Opdracht20', 'Website');

test('student can see the task admin delete page', function()
{
    $this->withoutExceptionHandling();
    $student = User::find(1);
    Laravel\be($student)
        ->get(route('tasks.delete',['task' => $this->task->id]))
        ->assertViewIs('admin.tasks.delete')
        ->assertSee($this->task->task)
        ->assertSee($this->task->begindate)
        ->assertSee($this->task->enddate)
        ->assertSee($this->task->user->name)
        ->assertSee($this->task->project->name)
        ->assertSee($this->task->activity->name)
        ->assertStatus(200);
})->group('TaskDelete', 'Opdracht20', 'Website');

test('guest can not see the task admin delete page', function(){
    $this->get(route('tasks.delete',['task' => $this->task->id]))
        ->assertRedirect(route('login'));
})->group('TaskDelete', 'Opdracht20', 'Website');



