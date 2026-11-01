<?php

namespace Tests\Feature;

use App\Models\CashBook;
use App\Models\Category;
use App\Models\Khatib;
use App\Models\KhatibSchedule;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MasjidManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Setting::updateOrCreate(['key' => 'masjid_name'], ['value' => 'Al-Masjid Test', 'label' => 'Nama Masjid', 'group' => 'general']);
        Setting::updateOrCreate(['key' => 'masjid_latitude'], ['value' => '-6.2088', 'label' => 'Latitude', 'group' => 'display']);
        Setting::updateOrCreate(['key' => 'masjid_longitude'], ['value' => '106.8456', 'label' => 'Longitude', 'group' => 'display']);
        Setting::updateOrCreate(['key' => 'qris_image'], ['value' => '/images/qris-sample.svg', 'label' => 'QRIS Infaq', 'group' => 'general']);
    }

    public function test_atomic_transaction_and_runtime_balance_verification(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $cashBook = CashBook::create([
            'name' => 'Kas Operasional',
            'slug' => 'kas-operasional',
            'is_active' => true,
        ]);
        $catIncome = Category::create([
            'cash_book_id' => $cashBook->id,
            'name' => 'Infaq Kotak Jumat',
            'type' => 'income',
        ]);
        $catExpense = Category::create([
            'cash_book_id' => $cashBook->id,
            'name' => 'Kebersihan',
            'type' => 'expense',
        ]);

        // 1. Catat Pemasukan
        $this->actingAs($user)->post(route('admin.transactions.store'), [
            'cash_book_id' => $cashBook->id,
            'category_id' => $catIncome->id,
            'type' => 'income',
            'amount' => '500.000',
            'description' => 'Infaq Jumat',
            'transaction_date' => now()->toDateString(),
        ])->assertRedirect(route('admin.transactions.index'));

        // Verifikasi saldo runtime
        $this->assertEquals(500000, $cashBook->verifyBalance());

        // 2. Catat Pengeluaran
        $this->actingAs($user)->post(route('admin.transactions.store'), [
            'cash_book_id' => $cashBook->id,
            'category_id' => $catExpense->id,
            'type' => 'expense',
            'amount' => '200.000',
            'description' => 'Beli sabun pembersih',
            'transaction_date' => now()->toDateString(),
        ])->assertRedirect(route('admin.transactions.index'));

        // Verifikasi saldo runtime setelah pengeluaran: 500k - 200k = 300k
        $this->assertEquals(300000, $cashBook->verifyBalance());
    }

    public function test_rekap_jumat_print_page_returns_successful_response(): void
    {
        $cashBook = CashBook::create([
            'name' => 'Kas Umum',
            'slug' => 'kas-umum',
            'is_active' => true,
        ]);
        $category = Category::create([
            'cash_book_id' => $cashBook->id,
            'name' => 'Infaq',
            'type' => 'income',
        ]);

        Transaction::create([
            'cash_book_id' => $cashBook->id,
            'category_id' => $category->id,
            'type' => 'income',
            'amount' => 1500000,
            'transaction_date' => now()->toDateString(),
        ]);

        $response = $this->get(route('reports.rekap_jumat'));
        $response->assertStatus(200);
        $response->assertSee('LAPORAN KAS MINGGUAN JELANG SHALAT JUMAT');
        $response->assertSee('Kas Umum');
    }

    public function test_display_tv_page_returns_successful_response(): void
    {
        $response = $this->get(route('display.index'));
        $response->assertStatus(200);
        $response->assertSee('Al-Masjid Test');
        $response->assertSee('Subuh');
        $response->assertSee('Dzuhur');
        $response->assertSee('Ashar');
        $response->assertSee('Maghrib');
        $response->assertSee('Isya');
    }

    public function test_transparency_portal_returns_successful_response(): void
    {
        $cashBook = CashBook::create([
            'name' => 'Kas Pembangunan',
            'slug' => 'kas-pembangunan',
            'is_active' => true,
        ]);

        $response = $this->get(route('transparency.index'));
        $response->assertStatus(200);
        $response->assertSee('Portal Transparansi Kas Jamaah');
        $response->assertSee('Kas Pembangunan');
        $response->assertSee('Scan QRIS Infaq Masjid');
    }

    public function test_khatib_schedule_generates_valid_whatsapp_url(): void
    {
        $schedule = KhatibSchedule::create([
            'date' => Carbon::now()->next(Carbon::FRIDAY)->toDateString(),
            'khatib_name' => 'Ustadz Ahmad Al-Farisi',
            'phone' => '081234567890',
            'theme' => 'Menjaga Kejujuran dalam Bermuamalah',
        ]);

        $waUrl = $schedule->getWhatsAppUrl();
        $this->assertNotNull($waUrl);
        $this->assertStringStartsWith('https://wa.me/6281234567890', $waUrl);
        $this->assertStringContainsString('Ustadz%20Ahmad%20Al-Farisi', $waUrl);
    }
}
