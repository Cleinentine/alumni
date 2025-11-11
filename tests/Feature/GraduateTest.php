<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GraduateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_tracer_on_a_correct_data(): void
    {
        $response = $this->post('/tracer', [
            'first_name' => 'Clein',
            'middle_name' => '',
            'last_name' => 'Wepee',
            'birth_date' => '07/09/1998',
            'year_graduated' => '2019',
            'gender' => 'Male',
            'program' => '8',

            'title' => 'Customer Service Representative',
            'company' => 'Conduent',
            'time_to_first_job' => '3',
            'progression' => '',
            'status' => 'Full-time',
            'industry' => '5',
            'search_methods' => 'JobStreet',
            'unemployment' => '',

            'relevance' => '5',
            'skills' => '4',
            'competency' => '3',
            'post_graduate' => 'Yes',
            'engagement' => 'No',
            'entrepreneurship' => 'Yes',

            'email' => 'cleinentine@gmail.com',
            'contact_number' => '+639694856292',
            'password' => 'clein0709',
            'password_confirmation' => 'clein0709',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_tracer_on_an_incorrect_data(): void
    {
        $response = $this->post('/tracer', [
            'first_name' => 'Clein!',
            'middle_name' => '!!!!',
            'last_name' => 'Wepee!!!',
            'birth_date' => '07/09/2023',
            'year_graduated' => '1900',
            'gender' => 'Males',
            'program' => '100',

            'title' => 'Customer Service Associate !!!',
            'company' => 'Conduent!',
            'time_to_first_job' => 'a',
            'progression' => '',
            'status' => 'Full-Times',
            'industry' => 'Call Centre & Customer Service',
            'search_methods' => 'Jobstreets',
            'unemployment' => '',

            'relevance' => 'Yes',
            'skills' => 'No',
            'competency' => '0',
            'post_graduate' => '1',
            'engagement' => '2',
            'entrepreneurship' => 'Yess',

            'email' => 'cleinentine',
            'contact_number' => 'abc',
            'password' => 'clein0709',
            'password_confirmation' => 'clein0709',
        ]);

        $response->assertSessionHasErrors();
    }
}
