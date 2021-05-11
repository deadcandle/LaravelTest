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
    $this->status = Status::factory()->create();
    $this->task = Tasks::factory()->create([
        'user_id' => 1,
        'status_id' => $this->status->id,
        'project_id' => $this->project->id
    ]);
});

// Tests voor status
test('Data from factory is in the status table', function () {
    $this->assertDatabaseHas('statuses', [
        'id' => $this->status->id,
        'name' => $this->status->status
    ]);
})->group('Opdracht12');

test('a status id is a int', function(){
    expect($this->status->id)->toBeInt();
})->group('Opdracht12');

test('a status is a string', function(){
    expect($this->status->name)->toBeString();
})->group('Opdracht12');

// Tests voor tasks
test('Data from factory is in the tasks table', function () {
    $this->assertDatabaseHas('tasks', [
        'id' => $this->task->id,
        'task' => $this->task->task,
        'begindate' => $this->task->begindate,
        'enddate' => $this->task->enddate,
        'user_id' => $this->task->user_id,
        'project_id' => $this->task->project_id,
        'status_id' => $this->status->id
    ]);
})->group('Opdracht12');

test('a task id is a int', function(){
    expect($this->task->id)->toBeInt();
})->group('Opdracht12');

test('a task is a string', function(){
    expect($this->task->task)->toBeString();
})->group('Opdracht12');

test('a task begindate is a datetime of Carbon', function(){
    expect($this->task->begindate)->toBeInstanceOf(Carbon::class);
})->group('Opdracht12');

test('a task enddate is a datetime of Carbon', function(){
    expect($this->task->enddate)->toBeInstanceOf(Carbon::class);
})->group('Opdracht12');

test('a task belongs to a user', function(){
    expect($this->task->user)->toBeInstanceOf(User::class); // relatie check
})->group('Opdracht12');

test('a task belongs to a project', function(){
    expect($this->task->project)->toBeInstanceOf(Project::class); // relatie check
})->group('Opdracht12');

test('a task has a status', function(){
    expect($this->task->status)->toBeInstanceOf(Status::class); // relatie check
})->group('Opdracht12');
