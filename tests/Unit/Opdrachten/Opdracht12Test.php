<?php

use App\Models\Status;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
    $this->status1 = Status::factory()->create();
    $this->task = Task::factory()->create([
        'user_id' => 1,
        'statuses_id' => $this->status1->id,
        'project_id' => $this->project->id
    ]);
});

// Tests voor status
test('Data from factory is in the status table', function () {
    $this->assertDatabaseHas('statuses', [
        'id' => $this->status1->id,
        'status' => $this->status1->status
    ]);
})->group('Opdracht12_13');

test('a status id is a int', function(){
    expect($this->status1->id)->toBeInt();
})->group('Opdracht12_13');

test('a status is a string', function(){
    expect($this->status1->status)->toBeString();
})->group('Opdracht12_13');

// Tests voor tasks
test('Data from factory is in the tasks table', function () {
    $this->assertDatabaseHas('tasks', [
        'id' => $this->task->id,
        'task' => $this->task->task,
        'begindate' => $this->task->begindate->toDateString(),
        'enddate' => $this->task->enddate->toDateString(),
        'user_id' => $this->task->user_id,
        'project_id' => $this->task->project_id,
        'statuses_id' => $this->task->statuses_id
    ]);
})->group('Opdracht12_13');

test('a task id is a int', function(){
    expect($this->task->id)->toBeInt();
})->group('Opdracht12_13');

test('a task is a string', function(){
    expect($this->task->task)->toBeString();
})->group('Opdracht12_13');

test('a task begindate is a datetime of Carbon', function(){
    expect($this->task->begindate)->toBeInstanceOf(Carbon::class);
})->group('Opdracht12_13');

test('a task enddate is a datetime of Carbon', function(){
    expect($this->task->enddate)->toBeInstanceOf(Carbon::class);
})->group('Opdracht12_13');

test('a task belongs to a user', function(){
    expect($this->task->user)->toBeInstanceOf(User::class); // relatie check
})->group('Opdracht12_13');

test('a task belongs to a project', function(){
    expect($this->task->project)->toBeInstanceOf(Project::class); // relatie check
})->group('Opdracht12_13');

test('a task has a status', function(){
    expect($this->task->statuses)->toBeInstanceOf(Status::class); // relatie check
})->group('Opdracht12_13');