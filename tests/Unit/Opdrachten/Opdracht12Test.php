<?php

use App\Models\Activity;
use App\Models\Status;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
    $this->activity = Activity::factory()->create();
    $this->task = Task::factory()->create([
        'user_id' => 1,
        'activity_id' => $this->activity->id,
        'project_id' => $this->project->id
    ]);
});

// Tests voor activity
test('Data from factory is in the activity table', function () {
    $this->assertDatabaseHas('activities', [
        'id' => $this->activity->id,
        'name' => $this->activity->name
    ]);
})->group('Opdracht12_13');

test('a activity id is a int', function(){
    expect($this->activity->id)->toBeInt();
})->group('Opdracht12_13');

test('a activity name is a string', function(){
    expect($this->activity->name)->toBeString();
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
        'activity_id' => $this->task->activity_id
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

/*
test('a task has a activity', function(){
    expect($this->task->activities)->toBeInstanceOf(Activity::class); // relatie check
})->group('Opdracht12_13');
*/