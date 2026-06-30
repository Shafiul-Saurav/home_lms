<?php

namespace Tests\Feature;

use App\Models\Servicetwocategory;
use App\Models\Servicetwo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceConsultationTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_consultation_can_be_submitted(): void
    {
        $category = Servicetwocategory::create([
            'title' => 'Cyber Security',
            'slug' => 'cyber-security',
            'is_active' => true,
        ]);

        $service = Servicetwo::create([
            'servicetwocategory_id' => $category->id,
            'title' => 'SOC Setup',
            'description' => 'Test service',
            'service_type' => 'Consultation',
            'url' => 'https://example.com',
            'is_active' => true,
        ]);

        $response = $this->post(route('service.consultations.store'), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'phone' => '01700000000',
            'company_name' => 'Example Ltd',
            'service_id' => $service->id,
            'expected_timeline' => '2-4 weeks',
            'project_requirement' => 'We need a full security review.',
            'timeslot_id' => null,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('message', 'Consultation request sent successfully.');
        $this->assertDatabaseHas('service_consultations', [
            'email' => 'jane@example.com',
            'service_id' => $service->id,
            'company_name' => 'Example Ltd',
        ]);
    }

    public function test_services_page_loads_and_displays_service_categories(): void
    {
        $category = Servicetwocategory::create([
            'title' => 'Managed Security',
            'slug' => 'managed-security',
            'is_active' => true,
        ]);

        Servicetwo::create([
            'servicetwocategory_id' => $category->id,
            'title' => 'Security Audit',
            'description' => 'Test service',
            'service_type' => 'Consultation',
            'url' => 'https://example.com',
            'is_active' => true,
        ]);

        $response = $this->get(route('services'));

        $response->assertOk();
        $response->assertSee($category->title);
        $response->assertSee('Security Audit');
    }
}
