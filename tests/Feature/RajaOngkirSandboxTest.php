<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RajaOngkirSandboxTest extends TestCase
{
    /**
     * Test index page renders successfully.
     */
    public function test_sandbox_index_renders_successfully(): void
    {
        $response = $this->get('/rajaongkir-sandbox');

        $response->assertStatus(200);
        $response->assertSee('Cek Ongkir Tes (Sandbox)');
    }

    /**
     * Test search validation when search parameter is empty.
     */
    public function test_search_requires_non_empty_query(): void
    {
        $response = $this->getJson('/rajaongkir-sandbox/search?search=');

        $response->assertStatus(422);
        $response->assertJsonPath('meta.status', 'error');
    }

    /**
     * Test search calls RajaOngkir API and returns data.
     */
    public function test_search_returns_domestic_destinations(): void
    {
        Http::fake([
            'https://rajaongkir.komerce.id/api/v1/destination/domestic-destination*' => Http::response([
                'meta' => [
                    'message' => 'Success Get Domestic Destinations',
                    'code' => 200,
                    'status' => 'success',
                ],
                'data' => [
                    [
                        'id' => 4866,
                        'label' => 'BATUNUNGGAL, BANDUNG KIDUL, BANDUNG, JAWA BARAT, 40266',
                        'province_name' => 'JAWA BARAT',
                        'city_name' => 'BANDUNG',
                        'district_name' => 'BANDUNG KIDUL',
                        'subdistrict_name' => 'BATUNUNGGAL',
                        'zip_code' => '40266',
                    ],
                ],
            ], 200),
        ]);

        $response = $this->getJson('/rajaongkir-sandbox/search?search=bandung');

        $response->assertStatus(200);
        $response->assertJsonPath('meta.status', 'success');
        $response->assertJsonPath('data.0.id', 4866);
    }

    /**
     * Test calculate validation requires required fields.
     */
    public function test_calculate_validation_fails_when_fields_missing(): void
    {
        $response = $this->postJson('/rajaongkir-sandbox/calculate', []);

        $response->assertStatus(422);
    }

    /**
     * Test calculate returns shipping cost results.
     */
    public function test_calculate_returns_shipping_cost_options(): void
    {
        Http::fake([
            'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost' => Http::response([
                'meta' => [
                    'message' => 'Success Calculate Domestic Shipping cost',
                    'code' => 200,
                    'status' => 'success',
                ],
                'data' => [
                    [
                        'name' => 'POS Indonesia (POS)',
                        'code' => 'pos',
                        'service' => 'Pos Reguler',
                        'description' => '240',
                        'cost' => 7000,
                        'etd' => '2 day',
                    ],
                ],
            ], 200),
        ]);

        $response = $this->postJson('/rajaongkir-sandbox/calculate', [
            'origin' => 4866,
            'destination' => 4867,
            'weight' => 1000,
            'courier' => 'pos',
            'price' => 'lowest',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('meta.status', 'success');
        $response->assertJsonPath('data.0.cost', 7000);
        $response->assertJsonPath('data.0.service', 'Pos Reguler');
    }

    /**
     * Test calculate sends all 7 couriers explicitly when 'all' is selected.
     */
    public function test_calculate_sends_seven_couriers_when_all_is_selected(): void
    {
        Http::fake([
            'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost' => Http::response([
                'meta' => [
                    'message' => 'Success Calculate Domestic Shipping cost',
                    'code' => 200,
                    'status' => 'success',
                ],
                'data' => [
                    [
                        'name' => 'POS Indonesia (POS)',
                        'code' => 'pos',
                        'service' => 'Pos Reguler',
                        'description' => '240',
                        'cost' => 56000,
                        'etd' => '2 day',
                    ],
                ],
            ], 200),
        ]);

        $response = $this->postJson('/rajaongkir-sandbox/calculate', [
            'origin' => 4866,
            'destination' => 4867,
            'weight' => 1000,
            'courier' => 'all',
        ]);

        $response->assertStatus(200);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost'
                && $request['courier'] === 'pos:jne:jnt:tiki:lion:sicepat:sap';
        });
    }

    /**
     * Test calculate filters out non-regular services and keeps only regular services.
     */
    public function test_calculate_filters_only_regular_services(): void
    {
        Http::fake([
            'https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost' => Http::response([
                'meta' => [
                    'message' => 'Success Calculate Domestic Shipping cost',
                    'code' => 200,
                    'status' => 'success',
                ],
                'data' => [
                    [
                        'name' => 'POS Indonesia (POS)',
                        'code' => 'pos',
                        'service' => 'Pos Reguler',
                        'description' => '240',
                        'cost' => 56000,
                        'etd' => '2 day',
                    ],
                    [
                        'name' => 'Jalur Nugraha Ekakurir (JNE)',
                        'code' => 'jne',
                        'service' => 'JTR',
                        'description' => 'JNE Trucking',
                        'cost' => 335000,
                        'etd' => '23 day',
                    ],
                    [
                        'name' => 'Satria Antaran Prima',
                        'code' => 'sap',
                        'service' => 'UDRONS',
                        'description' => 'Nextday',
                        'cost' => 158500,
                        'etd' => '1-3 day',
                    ],
                    [
                        'name' => 'J&T Express',
                        'code' => 'jnt',
                        'service' => 'EZ',
                        'description' => 'Reguler',
                        'cost' => 108000,
                        'etd' => '2 day',
                    ],
                    [
                        'name' => 'Satria Antaran Prima',
                        'code' => 'sap',
                        'service' => 'DRGREG',
                        'description' => 'Cargo',
                        'cost' => 4950000,
                        'etd' => '11-17 day',
                    ],
                ],
            ], 200),
        ]);

        $response = $this->postJson('/rajaongkir-sandbox/calculate', [
            'origin' => 4866,
            'destination' => 4867,
            'weight' => 1000,
            'courier' => 'pos:jne:jnt:tiki:lion:sicepat:sap',
        ]);

        $response->assertStatus(200);
        $data = $response->json('data');

        // Only Pos Reguler and J&T EZ should remain; Cargo and Nextday must be filtered out
        $this->assertCount(2, $data);
        $services = array_column($data, 'service');
        $this->assertContains('Pos Reguler', $services);
        $this->assertContains('EZ', $services);
        $this->assertNotContains('JTR', $services);
        $this->assertNotContains('UDRONS', $services);
        $this->assertNotContains('DRGREG', $services);

        // Should be sorted by cost ascending
        $this->assertEquals(56000, $data[0]['cost']);
        $this->assertEquals(108000, $data[1]['cost']);
    }
}
