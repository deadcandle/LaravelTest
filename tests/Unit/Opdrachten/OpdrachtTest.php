<?php

use App\Models\Project;
use App\Models\User;

beforeEach(function (){
    $this->project = Project::factory()->create();
    $this->seed('ProjectSeeder');
});

test('Data from factory is in the projects table', function () {
    $this->assertDatabaseHas('projects', [
        'id' => $this->project->id,
        'name' => $this->project->name
    ]);
})->group('Opdracht1_2');

test('a project id is a int', function(){
    expect($this->project->id)->toBeInt();
})->group('Opdracht1_2');

test('a project name is a string', function(){
    expect($this->project->name)->toBeString();
})->group('Opdracht1_2');

test('a project name is minimal 5 characters long', function(){
    expect(strlen($this->project->name))->toBeGreaterThanOrEqual(5);
})->group('Opdracht6');

test('a project name is maximum 45 characters long', function(){
    expect(strlen($this->project->name))->toBeLessThanOrEqual(45);
})->group('Opdracht6');

test('the student user is correct in the database', function(){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $user = User::find(1);
    expect($user->name)->toBe('student');
    expect($user->email)->toBe('student@tcrmbo.nl');
})->group('Opdracht10');

test('the teacher user is correct in the database', function(){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $user = User::find(2);
    expect($user->name)->toBe('teacher');
    expect($user->email)->toBe('teacher@tcrmbo.nl');
})->group('Opdracht10');

test('the admin user is correct in the database', function(){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $user = User::find(3);
    expect($user->name)->toBe('admin');
    expect($user->email)->toBe('admin@tcrmbo.nl');
})->group('Opdracht10');





