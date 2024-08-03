<?php

namespace Tests\Feature\Auth;

use App\Models\Admin;
use App\Models\LaboratorieEmployee;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class loginTest extends TestCase
{

    // to run 
    // php artisan test .\tests\Feature\Auth --filter=test_get_appointment
    // php artisan test .\tests\Feature\Auth --filter=test_login_admin_to_get_appointment
    // php artisan test .\tests\Feature\Auth --filter=test_update_appointment
    // php artisan test .\tests\Feature\Auth --filter=test_delete_appointment
    // php artisan test .\tests\Feature\Auth --filter=test_store_lab_employee

    public function test_get_appointment(): void
    {
        $response = $this->get('appointments');
        $response->assertStatus(200);
        $response->assertViewIs('Dashboard.appointments.index');
        $response->assertViewHas('appointments');
    }

    public function test_login_admin_to_get_appointment(): void
    {

        $admin = Admin::factory()->create();
        $response = $this->actingAs($admin, 'admin')->get('appointments');
        $response->assertStatus(200);
        $response->assertViewIs('Dashboard.appointments.index');
        $response->assertViewHas('appointments');
        $admin->delete();
    }

    public function test_update_appointment(): void
    {
        $admin = Admin::factory()->create();
        $response = $this->actingAs($admin, 'admin')->put('appointments/approval/1');
        $admin->delete();

    }

    public function test_delete_appointment(): void
    {
        $admin = Admin::factory()->create();
        $response = $this->actingAs($admin, 'admin')->delete('appointments/destroy/3');
        $admin->delete();
    }

    public function test_store_lab_employee(): void
    {

        $admin = Admin::factory()->create();
        $lab_employee = [
            'name' => 'samaa',
            'email' => 'samaa55@gmail.com',
            'password' => Hash::make('12345678'),
        ];

        $response = $this->post('laboratorie_employee', $lab_employee);
        $response->assertStatus(302);
        $admin->delete();

    }

}