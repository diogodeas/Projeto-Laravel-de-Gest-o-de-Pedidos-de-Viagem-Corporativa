<?php

namespace Tests\Feature;

use App\Models\TravelRequests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TravelRequestsTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_travel_request_with_missing_fields()
    {
        $data = [
            'destination' => 'Rio de Janeiro',
            'status' => 'solicitado'
        ];

        $response = $this->actingAsApiUser()->postJson('/api/travel-requests', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['applicant_name', 'start_date']);
    }

    public function test_create_travel_request_with_invalid_dates()
    {
        $data = [
            'applicant_name' => 'Diogo',
            'destination' => 'Rio de Janeiro',
            'start_date' => '2024-11-11',
            'return_date' => '2024-11-09',
            'status' => 'solicitado',
        ];

        $response = $this->actingAsApiUser()->postJson('/api/travel-requests', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['return_date']);
    }

    public function test_update_travel_request_with_invalid_status()
    {
        $travelRequest = TravelRequests::factory()->create(['status' => 'solicitado']);

        $response = $this->actingAsApiUser()->putJson('/api/travel-requests/' . $travelRequest->id, [
            'status' => 'invalido',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['status']);
    }

    public function test_get_travel_requests_with_no_records()
    {
        $response = $this->actingAsApiUser()->getJson('/api/travel-requests');

        $response->assertStatus(200)
            ->assertJsonCount(0);
    }

    public function test_can_create_travel_request()
    {
        $data = [
            'applicant_name' => 'Diogo',
            'destination' => 'Rio de Janeiro',
            'start_date' => '2024-11-09',
            'return_date' => '2024-11-11',
            'status' => 'solicitado',
        ];

        $response = $this->actingAsApiUser()->postJson('/api/travel-requests', $data);

        $response->assertStatus(201)
            ->assertJsonFragment($data);
    }

    public function test_can_get_travel_requests_with_status_filter()
    {
        TravelRequests::factory()->create(['status' => 'solicitado']);
        TravelRequests::factory()->create(['status' => 'aprovado']);
        TravelRequests::factory()->create(['status' => 'cancelado']);

        $response = $this->actingAsApiUser()->getJson('/api/travel-requests');
        $response->assertStatus(200)->assertJsonCount(3);

        $response = $this->actingAsApiUser()->getJson('/api/travel-requests?status=aprovado');
        $response->assertStatus(200)->assertJsonCount(1)
            ->assertJsonFragment(['status' => 'aprovado']);

        $response = $this->actingAsApiUser()->getJson('/api/travel-requests?status=solicitado');
        $response->assertStatus(200)->assertJsonCount(1)
            ->assertJsonFragment(['status' => 'solicitado']);
    }

    public function test_can_update_travel_request_status()
    {
        $travelRequest = TravelRequests::factory()->create(['status' => 'solicitado']);

        $response = $this->actingAsApiUser()->putJson('/api/travel-requests/' . $travelRequest->id, [
            'status' => 'aprovado',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['status' => 'aprovado']);
    }
}
