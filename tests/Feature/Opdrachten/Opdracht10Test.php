<?php

use App\Models\User;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
});

test('the student user can login with email and correct password', function()
{
    $this->withoutExceptionHandling();
    $user = User::find(1);
    $this->post('/login', ['email' => $user->email, 'password' => 'student']);
    $this->assertAuthenticated();
})->group('Opdracht10');

test('the teacher user can login with email and correct password', function()
{
    $this->withoutExceptionHandling();
    $user = User::find(2);
    $this->post('/login', ['email' => $user->email, 'password' => 'teacher']);
    $this->assertAuthenticated();
})->group('Opdracht10');

test('the admin user can login with email and correct password', function()
{
    $this->withoutExceptionHandling();
    $user = User::find(3);
    $this->post('/login', ['email' => $user->email, 'password' => 'admin']);
    $this->assertAuthenticated();
})->group('Opdracht10');

