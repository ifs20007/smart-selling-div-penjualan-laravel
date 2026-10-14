<?php

namespace Tests\Feature;

use App\Models\KategoriKompetitor;
use App\Models\Kompetitor;
use App\Models\User;
use Database\Seeders\CompetitorMigrationSeeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CompetitorMigrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id('users_id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('role')->default('Pegawai');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('kategori_kompetitor')) {
            Schema::create('kategori_kompetitor', function (Blueprint $table) {
                $table->id('kategori_kompetitor_id');
                $table->string('nama_kategori');
                $table->string('inisial', 10)->nullable();
                $table->string('keterangan');
                $table->string('kode_warna', 10);
            });
        }

        if (! Schema::hasTable('kompetitor')) {
            Schema::create('kompetitor', function (Blueprint $table) {
                $table->id('kompetitor_id');
                $table->unsignedBigInteger('kategori_kompetitor_id');
                $table->unsignedBigInteger('users_id');
                $table->string('nama_kompetitor');
                $table->text('alamat');
                $table->decimal('latitude', 10, 8);
                $table->decimal('longitude', 11, 8);
                $table->text('url')->nullable();
                $table->timestamps();
            });
        }

        $this->seed(CompetitorMigrationSeeder::class);
    }

    /**
     * Test that competitor categories and branches exist and match migration.
     */
    public function test_competitor_categories_and_branches_are_migrated(): void
    {
        $this->assertGreaterThanOrEqual(13, KategoriKompetitor::count());
        $this->assertGreaterThanOrEqual(47, Kompetitor::count());

        $pos = KategoriKompetitor::where('inisial', 'POS')->first();
        $this->assertNotNull($pos);
        $this->assertNotNull($pos->logo_url);
        $this->assertStringContainsString('posind.png', $pos->logo_url);

        $jne = KategoriKompetitor::where('inisial', 'JNE')->first();
        $this->assertNotNull($jne);
        $this->assertStringContainsString('logo_jne.png', $jne->logo_url);

        $lion = KategoriKompetitor::where('inisial', 'LION')->first();
        $this->assertNotNull($lion);
        $this->assertStringContainsString('logo_lion.png', $lion->logo_url);
    }

    /**
     * Test that admin can view the competitor category index page with logos.
     */
    public function test_admin_can_view_competitor_entities(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@posind.test'],
            ['name' => 'Administrator', 'password' => bcrypt('password'), 'role' => 'Admin']
        );

        $response = $this->actingAs($admin)->get(route('kategori-kompetitor.index'));

        $response->assertStatus(200);
        $response->assertSee('Profil Entitas Kompetitor');
        $response->assertSee('POS Indonesia');
        $response->assertSee('Lion Parcel');
        $response->assertSee('assets/images/posind.png');

        $kategoriList = $response->viewData('kategori');
        $this->assertEquals(1, $kategoriList->first()->kategori_kompetitor_id);
        $this->assertEquals('POS Indonesia', $kategoriList->first()->nama_kategori);
    }

    /**
     * Test that admin can view the competitor branch mapping page with ordered branches.
     */
    public function test_admin_can_view_competitor_branches_and_map(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@posind.test'],
            ['name' => 'Administrator', 'password' => bcrypt('password'), 'role' => 'Admin']
        );

        $response = $this->actingAs($admin)->get(route('kompetitor.index'));

        $response->assertStatus(200);
        $response->assertSee('Database Cabang / Agen Resmi Setiap Kompetitor');
        $response->assertSee('Peta Wilayah Operasional');
        $response->assertSee('Legenda Pin Peta (Kode Hex / RGB Warna Ekspedisi)');
        $response->assertSee('Kantor Pos Cabang Pematangsiantar');

        $cabangList = $response->viewData('cabang');
        $this->assertEquals(1, $cabangList->first()->kategori_kompetitor_id);
        $this->assertEquals('Kantor Pos Cabang Pematangsiantar', $cabangList->first()->nama_kompetitor);
    }
}
