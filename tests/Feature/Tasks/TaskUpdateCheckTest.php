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

test('the task need to be at least 10 characters', function () {
    $admin = User::find(3);
    $task = Task::factory()->make(['task' => 'tekort']);

    Laravel\be($admin)
        ->patchJson(route('tasks.update',['task' => $this->task->id]), $task->toArray())
        ->assertStatus(422);
})->group( 'TaskUpdate', 'Opdracht19', 'Website');

test('the task can only be 200 characters max', function () {
    $admin = User::find(3);
    $task = Task::factory()->make(['task' => $this->faker->paragraph(6)]);

    Laravel\be($admin)
        ->patchJson(route('tasks.update',['task' => $this->task->id]), $task->toArray())
        ->assertStatus(422);
})->group( 'TaskUpdate', 'Opdracht19', 'Website');

test('the task needs a begindate', function () {
    $admin = User::find(3);
    $task = Task::factory()->make(['begindate' => null]);

    Laravel\be($admin)
        ->patchJson(route('tasks.update',['task' => $this->task->id]), $task->toArray())
        ->assertStatus(422);
})->group( 'TaskUpdate', 'Opdracht19', 'Website');

test('the task needs a project', function () {
    $admin = User::find(3);
    $task = Task::factory()->make(['project_id' => null]);

    Laravel\be($admin)
        ->patchJson(route('tasks.update',['task' => $this->task->id]), $task->toArray())
        ->assertStatus(422);
})->group( 'TaskUpdate', 'Opdracht19', 'Website');

test('the task needs an activity', function () {
    $admin = User::find(3);
    $task = Task::factory()->make(['activity_id' => null]);

    Laravel\be($admin)
        ->patchJson(route('tasks.update',['task' => $this->task->id]), $task->toArray())
        ->assertStatus(422);
})->group( 'TaskUpdate', 'Opdracht19', 'Website');
