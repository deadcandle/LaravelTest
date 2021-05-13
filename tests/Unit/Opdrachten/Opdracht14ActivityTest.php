<?php

use App\Models\Activity;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->project = Project::factory()->create();
    $this->seed('ActivitySeeder');
});

// Tests voor activity
test('a activity id seeded with the ActivitySeeder is a int', function(){
    $activity = Activity::find(1);
    expect($activity->id)->toBeInt();
})->group('Opdracht14');

test('a activity name seeded with the ActivitySeeder is a string', function(){
    $activity = Activity::find(1);
    expect($activity->name)->toBeString();
})->group('Opdracht14');

test('The activity Todo has id 1', function (){
    $activity = Activity::find(1);
    expect($activity->name)->toBe('Todo');
})->group('Opdracht14');

test('The activity Doing has id 2', function (){
    $activity = Activity::find(2);
    expect($activity->name)->toBe('Doing');
})->group('Opdracht14');

test('The activity Testing has id 3', function (){
    $activity = Activity::find(3);
    expect($activity->name)->toBe('Testing');
})->group('Opdracht14');

test('The activity Verify has id 4', function (){
    $activity = Activity::find(4);
    expect($activity->name)->toBe('Verify');
})->group('Opdracht14');

test('The activity Done has id 5', function (){
    $activity = Activity::find(5);
    expect($activity->name)->toBe('Done');
})->group('Opdracht14');

test('The table activities have at least 5 items from the ActivitySeeder', function () {
    $activities = Activity::all();
    expect(count($activities))->toBeGreaterThanOrEqual(5);
})->group('Opdracht14');