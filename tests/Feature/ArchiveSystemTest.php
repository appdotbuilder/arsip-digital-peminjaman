<?php

namespace Tests\Feature;

use App\Models\Archive;
use App\Models\ArchiveCategory;
use App\Models\Borrowing;
use App\Models\District;
use App\Models\User;
use App\Models\Village;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArchiveSystemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_welcome_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(function ($page) {
            $page->component('welcome');
        });
    }

    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::where('role', 'admin')->first();

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(function ($page) {
            $page->component('dashboard')
                ->has('user')
                ->has('stats');
        });
    }

    public function test_employee_can_access_dashboard(): void
    {
        $employee = User::where('role', 'employee')->first();

        $response = $this->actingAs($employee)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(function ($page) {
            $page->component('dashboard')
                ->has('user')
                ->has('stats');
        });
    }

    public function test_officer_can_access_dashboard(): void
    {
        $officer = User::where('role', 'officer')->first();

        $response = $this->actingAs($officer)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(function ($page) {
            $page->component('dashboard')
                ->has('user')
                ->has('stats');
        });
    }

    public function test_archive_categories_exist(): void
    {
        $this->assertDatabaseHas('archive_categories', [
            'code' => 'BT',
            'name' => 'Buku Tanah'
        ]);

        $this->assertDatabaseHas('archive_categories', [
            'code' => 'SU',
            'name' => 'Surat Ukur'
        ]);

        $this->assertDatabaseHas('archive_categories', [
            'code' => 'GU',
            'name' => 'Gambar Ukur'
        ]);

        $this->assertDatabaseHas('archive_categories', [
            'code' => 'WR',
            'name' => 'Warkah'
        ]);
    }

    public function test_sample_archives_exist(): void
    {
        $bukuTanah = ArchiveCategory::where('code', 'BT')->first();
        
        $this->assertDatabaseHas('archives', [
            'archive_category_id' => $bukuTanah->id,
            'archive_number' => 'BT-HM-001-2024'
        ]);
    }

    public function test_districts_and_villages_exist(): void
    {
        $this->assertDatabaseHas('districts', [
            'name' => 'Purwodadi',
            'code' => 'PWD'
        ]);

        $district = District::where('name', 'Purwodadi')->first();
        $this->assertGreaterThan(0, $district->villages()->count());
    }

    public function test_users_with_different_roles_exist(): void
    {
        $this->assertDatabaseHas('users', [
            'role' => 'admin',
            'email' => 'admin@archive.com'
        ]);

        $this->assertDatabaseHas('users', [
            'role' => 'officer',
            'email' => 'officer@archive.com'
        ]);

        $this->assertDatabaseHas('users', [
            'role' => 'employee',
            'email' => 'employee1@archive.com'
        ]);
    }

    public function test_api_routes_work(): void
    {
        $user = User::first();
        $district = District::first();

        $response = $this->actingAs($user)
            ->get("/api/districts/{$district->id}/villages");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'code', 'district_id']
        ]);
    }

    public function test_borrowing_number_generation(): void
    {
        $borrowingNumber = Borrowing::generateBorrowingNumber();
        
        $this->assertStringStartsWith('BRW', $borrowingNumber);
        $this->assertEquals(15, strlen($borrowingNumber)); // BRW + 8 digits (date) + 4 digits (sequence)
    }
}