<?php

namespace Tests\Feature\Auth;

use App\Models\Admin;
use App\Models\LaboratorieEmployee;
use App\Models\Message;
use App\Models\Patient;
use App\Models\PatientTranslation;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class apiTest extends TestCase
{

    // to run 
    // php artisan test .\tests\Feature\Auth --filter=test_api_get_patient

    public function test_api_get_patient(): void
    {
        // إنشاء مريض اختباري
        $patient = Patient::factory()->create();

        // إرسال طلب GET لجلب بيانات المريض
        $response = $this->getjson("patient/" . $patient->id);

        // التأكد من أن الاستجابة صحيحة
        $response->assertStatus(200)
            ->assertJson([
                'id' => $patient->id,
                'email' => $patient->email,
                'Date_Birth' => $patient->Date_Birth,
                'Phone' => $patient->Phone,
                'Gender' => $patient->Gender,
            ]);
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

        $response = $this->actingAs($admin, 'admin')->post('laboratorie_employee', $lab_employee);
        $response->assertStatus(302);
        $admin->delete();

    }
}