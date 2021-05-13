<?php

use App\Models\Activity;
use App\Models\Task;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->activity = Activity::factory()->create();
    $this->seed('ProjectSeeder');

});

test('A project has at least 2 tasks', function (){
    $tasks = Task::all()->where('project_id', '=', 1);
    expect(count($tasks))->toBeGreaterThanOrEqual(2);
})->group('Opdracht14');

test('The table tasks have at least 10 items from the ProjectSeeder', function () {
    $tasks = Task::all();
    expect(count($tasks))->toBeGreaterThanOrEqual(10);
})->group('Opdracht14');