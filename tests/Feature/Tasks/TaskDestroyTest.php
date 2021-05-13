<?php

use App\Models\User;
use App\Models\Project;
use App\Models\Activity;
use App\Models\Task;
use Carbon\Carbon;
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

test('an admin can delete a task in the task admin', function () {
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin);

    $this->json('DELETE', route('tasks.destroy',['task' => $this->task->id]))
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseMissing('tasks',['id' => $this->task->id]);
})->group('TaskDestroy', 'Opdracht20', 'Website');

test('a teacher can update a task in the task admin', function () {
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher);
    $this->json('DELETE', route('tasks.destroy',['task' => $this->task->id]))
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseMissing('tasks',['id' => $this->task->id]);
})->group('TaskDestroy', 'Opdracht20', 'Website');

test('a student can update a task in the task admin', function () {
    $this->withoutExceptionHandling();
    $student = User::find(1);
    Laravel\be($student);
    $this->json('DELETE', route('tasks.destroy',['task' => $this->task->id]))
        ->assertRedirect(route('tasks.index'));

    $this->assertDatabaseMissing('tasks',['id' => $this->task->id]);
})->group('TaskDestroy', 'Opdracht20', 'Website');

test('a guest can not update a task in the task admin', function () {
    $this->json('DELETE', route('tasks.destroy',['task' => $this->task->id]))
        ->assertStatus(401);
})->group('TaskDestroy', 'Opdracht20', 'Website');

