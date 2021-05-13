<?php

use App\Models\Status;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('StatusSeeder');
    $this->seed('TaskSeeder');
});

// Tests voor status
test('The table statuses have at least 5 items from the StatusSeeder', function () {
    $statuses = Status::all();
    expect(count($statuses))->toBeGreaterThanOrEqual(5);
})->group('Opdracht14');
