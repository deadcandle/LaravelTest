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

test('an admin can update a task in the task admin', function () {
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin);
    $task = Task::factory()->make(['task' => 'de tweede taak',
        'begindate' => Carbon::now()->addDays(1)->toDateString(),
        'enddate' => Carbon::now()->addDays(11)->toDateString(),
        'user_id' => 2,
        'project_id' => 2,
        'activity_id' => 2]);

    $this->patchJson(route('tasks.update',['task' => $this->task->id]), $task->toArray())
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseHas('tasks',[
        'id' => $this->task->id,
        'task' => 'de tweede taak',
        'begindate' => $task->begindate,
        'enddate' => $task->enddate,
        'user_id' => 2,
        'project_id' => 2,
        'activity_id' => 2
    ]);
})->group('TaskUpdate', 'Opdracht19', 'Website');

test('a teacher can update a task in the task admin', function () {
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher);
    $task = Task::factory()->make(['task' => 'de tweede taak',
        'begindate' => Carbon::now()->addDays(1)->toDateString(),
        'enddate' => Carbon::now()->addDays(11)->toDateString(),
        'user_id' => 2,
        'project_id' => 2,
        'activity_id' => 2]);

    $this->patchJson(route('tasks.update',['task' => $this->task->id]), $task->toArray())
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseHas('tasks',[
        'id' => $this->task->id,
        'task' => 'de tweede taak',
        'begindate' => $task->begindate,
        'enddate' => $task->enddate,
        'user_id' => 2,
        'project_id' => 2,
        'activity_id' => 2
    ]);
})->group('TaskUpdate', 'Opdracht19', 'Website');

test('a student can update a task in the task admin', function () {
    $this->withoutExceptionHandling();
    $student = User::find(1);
    Laravel\be($student);
    $task = Task::factory()->make(['task' => 'de tweede taak',
        'begindate' => Carbon::now()->addDays(1)->toDateString(),
        'enddate' => Carbon::now()->addDays(11)->toDateString(),
        'user_id' => 2,
        'project_id' => 2,
        'activity_id' => 2]);

    $this->patchJson(route('tasks.update',['task' => $this->task->id]), $task->toArray())
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseHas('tasks',[
        'id' => $this->task->id,
        'task' => 'de tweede taak',
        'begindate' => $task->begindate,
        'enddate' => $task->enddate,
        'user_id' => 2,
        'project_id' => 2,
        'activity_id' => 2
    ]);
})->group('TaskUpdate', 'Opdracht19', 'Website');

test('a guest can not update a task in the task admin', function () {
    $task = Task::factory()->make(['task' => 'de tweede taak',
        'begindate' => Carbon::now()->addDays(1)->toDateString(),
        'enddate' => Carbon::now()->addDays(11)->toDateString(),
        'user_id' => 2,
        'project_id' => 2,
        'activity_id' => 2]);

    $this->patchJson(route('tasks.update',['task' => $this->task->id]), $task->toArray())
        ->assertStatus(401);
})->group('TaskUpdate', 'Opdracht19', 'Website');

