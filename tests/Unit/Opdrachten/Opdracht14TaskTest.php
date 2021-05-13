<?php

use App\Models\Project;
use App\Models\Activity;
use App\Models\Task;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
    $this->activity = Activity::factory()->create();
});

test('The table tasks have at least 10 items from the TaskSeeder', function () {
    $this->seed('TaskSeeder');
    $tasks = Task::all();
    expect(count($tasks))->toBeGreaterThanOrEqual(10);
})->group('Opdracht14');