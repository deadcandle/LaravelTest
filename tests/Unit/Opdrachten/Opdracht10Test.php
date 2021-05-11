<?php

use App\Models\Project;
use App\Models\User;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('ProjectSeeder');
    $this->project = Project::factory()->create();
});

test('the student user is correct in the database', function(){
    $user = User::find(1);
    expect($user->name)->toBe('student');
    expect($user->email)->toBe('student@tcrmbo.nl');
})->group('Opdracht10');

test('the teacher user is correct in the database', function(){
    $user = User::find(2);
    expect($user->name)->toBe('teacher');
    expect($user->email)->toBe('teacher@tcrmbo.nl');
})->group('Opdracht10');

test('the admin user is correct in the database', function(){
    $user = User::find(3);
    expect($user->name)->toBe('admin');
    expect($user->email)->toBe('admin@tcrmbo.nl');
})->group('Opdracht10');