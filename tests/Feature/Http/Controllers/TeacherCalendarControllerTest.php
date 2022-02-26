<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Calendar\TeacherCalendarController
 */
class TeacherCalendarControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->get(route('teachersCalendar'));

        $response->assertOk();
        $response->assertViewIs('calendars.overview');
        $response->assertViewHas('events');
        $response->assertViewHas('unassigned_events');
        $response->assertViewHas('resources');
        $response->assertViewHas('leaves');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $teacher = factory(\App\Models\Teacher::class)->create();

        $response = $this->get(route('teacherCalendar', [$teacher]));

        $response->assertOk();
        $response->assertViewIs('calendars.simple');
        $response->assertViewHas('events');
        $response->assertViewHas('resource');
        $response->assertViewHas('leaves');

        // TODO: perform additional assertions
    }

    // test cases...
}
