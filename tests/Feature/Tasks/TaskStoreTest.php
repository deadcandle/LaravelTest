<?php

use App\Models\User;
use App\Models\Project;
use App\Models\Activity;
use App\Models\Task;
use \Pest\Laravel;
use Carbon\Carbon;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('ActivitySeeder');
    $this->seed('ProjectSeeder');
    $this->seed('TaskSeeder');
    $this->project = Project::factory()->create();
    $this->activity = Activity::factory()->create();
    $this->task = Task::factory()->create();
});

test('guest can not create an task in the  task admin', function () {
    $this->postJson(route('tasks.store'))
        ->assertStatus(401);
})->group( 'TaskStore', 'Opdracht17', 'Website');

test('admin can create a task in the task admin', function () {
    $admin = User::find(3);
    $task = Task::factory()->make([
        'task' => 'de eerste taak',
        'begindate' => Carbon::now()->toDateString(),
        'enddate' => Carbon::now()->addDays(10)->toDateString(),
        'user_id' => 1,
        'project_id' => 1,
        'activity_id' => 1
    ]);

    Laravel\be($admin)
        ->postJson(route('tasks.store'), $task->toArray())
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseHas('tasks',[
        'task' => 'de eerste taak',
        'user_id' => 1,
        'project_id' => 1,
        'activity_id' => 1
    ]);
})->group( 'TaskStore', 'Opdracht17', 'Website');

test('teacher can create a task in the task admin', function () {
    $teacher = User::find(2);
    $task = Task::factory()->make([
        'task' => 'de eerste taak',
        'begindate' => Carbon::now()->toDateString(),
        'enddate' => Carbon::now()->addDays(10)->toDateString(),
        'user_id' => 1,
        'project_id' => 1,
        'activity_id' => 1
    ]);

    Laravel\be($teacher)
        ->postJson(route('tasks.store'), $task->toArray())
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseHas('tasks',[
        'task' => 'de eerste taak',
        'user_id' => 1,
        'project_id' => 1,
        'activity_id' => 1
    ]);
})->group( 'TaskStore', 'Opdracht17', 'Website');

test('student can create a task in the task admin', function () {
    $student = User::find(1);
    $task = Task::factory()->make([
        'task' => 'de eerste taak',
        'begindate' => Carbon::now()->toDateString(),
        'enddate' => Carbon::now()->addDays(10)->toDateString(),
        'user_id' => 2,
        'project_id' => 1,
        'activity_id' => 1
    ]);

    Laravel\be($student)
        ->postJson(route('tasks.store'), $task->toArray())
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseHas('tasks',[
        'task' => 'de eerste taak',
        'user_id' => 2,
        'project_id' => 1,
        'activity_id' => 1
    ]);
})->group( 'TaskStore', 'Opdracht17', 'Website');

