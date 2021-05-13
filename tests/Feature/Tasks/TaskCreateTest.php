<?php

use App\Models\User;
use App\Models\Project;
use App\Models\Activity;
use App\Models\Task;
use \Pest\Laravel;

beforeEach(function (){
    $this->seed('RoleAndPermissionSeeder');
    $this->seed('UserSeeder');
    $this->seed('ActivitySeeder');
    $this->seed('ProjectSeeder');
    $this->seed('TaskSeeder');
    $this->project = Project::factory()->create();
    $this->activity = Activity::factory()->create();
    $this->task = Task::factory()->create();
});

test('admin can see the task admin create page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('tasks.create'))
        ->assertViewIs('admin.tasks.create')
        ->assertSee(User::find(1)->name)
        ->assertSee(User::find(2)->name)
        ->assertSee(User::find(3)->name)
        ->assertSee(Project::find(1)->name)
        ->assertSee(Project::find(2)->name)
        ->assertSee(Project::find(3)->name)
        ->assertSee(Activity::find(1)->name)
        ->assertSee(Activity::find(2)->name)
        ->assertSee(Activity::find(3)->name)
        ->assertStatus(200);
})->group( 'TaskIndex', 'Opdracht17', 'Website');

test('teacher can see the task admin create page', function()
{
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher)
        ->get(route('tasks.create'))
        ->assertViewIs('admin.tasks.create')
        ->assertSee(User::find(1)->name)
        ->assertSee(User::find(2)->name)
        ->assertSee(User::find(3)->name)
        ->assertSee(Project::find(1)->name)
        ->assertSee(Project::find(2)->name)
        ->assertSee(Project::find(3)->name)
        ->assertSee(Activity::find(1)->name)
        ->assertSee(Activity::find(2)->name)
        ->assertSee(Activity::find(3)->name)
        ->assertStatus(200);
})->group( 'TaskIndex', 'Opdracht17', 'Website');

test('student can see the task admin create page', function()
{
    $this->withoutExceptionHandling();
    $student = User::find(1);
    Laravel\be($student)
        ->get(route('tasks.create'))
        ->assertViewIs('admin.tasks.create')
        ->assertSee(User::find(1)->name)
        ->assertSee(User::find(2)->name)
        ->assertSee(User::find(3)->name)
        ->assertSee(Project::find(1)->name)
        ->assertSee(Project::find(2)->name)
        ->assertSee(Project::find(3)->name)
        ->assertSee(Activity::find(1)->name)
        ->assertSee(Activity::find(2)->name)
        ->assertSee(Activity::find(3)->name)
        ->assertStatus(200);
})->group( 'TaskIndex', 'Opdracht17', 'Website');

test('guest can not see the task admin create page', function(){
    $this->get(route('tasks.create'))
        ->assertRedirect(route('login'));
})->group('TaskIndex', 'Opdracht17', 'Website');





