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
    $this->task = Task::factory()->create(['task' => 'de eerste taak',
        'begindate' => Carbon::now()->toDateString(),
        'enddate' => Carbon::now()->addDays(10)->toDateString(),
        'user_id' => 1,
        'project_id' => 1,
        'activity_id' => 1]);
});

test('admin can see the task admin edit page', function()
{
    $this->withoutExceptionHandling();
    $admin = User::find(3);
    Laravel\be($admin)
        ->get(route('tasks.edit',['task' => $this->task->id]))
        ->assertViewIs('admin.tasks.edit')
        ->assertSee($this->task->task)
        ->assertSee($this->task->begindate)
        ->assertSee($this->task->enddate)
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
})->group('TaskEdit', 'Opdracht19', 'Website');

test('teacher can see the product edit page', function()
{
    $this->withoutExceptionHandling();
    $teacher = User::find(2);
    Laravel\be($teacher)
        ->get(route('tasks.edit',['task' => $this->task->id]))
        ->assertViewIs('admin.tasks.edit')
        ->assertSee($this->task->task)
        ->assertSee($this->task->begindate)
        ->assertSee($this->task->enddate)
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
})->group('TaskEdit', 'Opdracht19', 'Website');

test('student can see the product edit page', function()
{
    $this->withoutExceptionHandling();
    $student = User::find(1);
    Laravel\be($student)
        ->get(route('tasks.edit',['task' => $this->task->id]))
        ->assertViewIs('admin.tasks.edit')
        ->assertSee($this->task->task)
        ->assertSee($this->task->begindate)
        ->assertSee($this->task->enddate)
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
})->group('TaskEdit', 'Opdracht19', 'Website');

test('guest can not see the task admin edit page', function(){
    $this->get(route('tasks.edit',['task' => $this->task->id]))
        ->assertRedirect(route('login'));
})->group('TaskEdit', 'Opdracht19', 'Website');



