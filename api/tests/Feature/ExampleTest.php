<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UsersWeather;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Jobs\GetUsersWeather;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');
        $response->assertStatus(204);// Returning empty if no Users.

        User::factory(20)->create();
        $response = $this->get('/');

        $response->assertStatus(200);

       
        

    }

    public function test_database_works()
    {
        User::factory(20)->create();

        $this->assertEquals(20, User::all()->count());
    }
    
    //Test the Job if works.
    public function test_job_get_users_weather_works()
    {
        $this->assertEquals(0, UsersWeather::get()->count()); //Making sure no data before
        User::factory(2)->create();
        dispatch(new GetUsersWeather);
        $this->assertEquals(2, UsersWeather::get()->count());        
    }
}
