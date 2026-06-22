# CONVENTIONS.md — Coding Standards SPK-MFEP

Konvensi ini berlaku untuk semua kode yang ditulis atau dimodifikasi di project SPK-MFEP. AI coding assistants wajib mengikuti konvensi ini agar konsisten dengan codebase yang sudah ada.

---

## Naming Conventions

### PHP / Laravel

| Tipe              | Konvensi   | Contoh                                        |
| ----------------- | ---------- | --------------------------------------------- |
| Class / Model     | PascalCase | `Employee`, `User`, `MFEPCalculator`          |
| Controller        | PascalCase | `EmployeeController`, `RankingController`     |
| Service Class     | PascalCase | `MFEPCalculator`, `ExcelImportService`        |
| Method / Function | camelCase  | `calculateMFEP()`, `getRanking()`, `hitungTotal()` |
| Variable          | camelCase  | `$totalNilai`, `$kriteriaBobot`, `$pegawaiRank` |
| Database Column   | snake_case | `total_nilai`, `kualitas_kerja`, `created_at` |
| Database Table    | snake_case | `employees`, `users`, `password_reset_tokens` |
| Route Name        | kebab-case | `employees.index`, `ranking.export-pdf`       |
| Blade View        | kebab-case | `employee-list.blade.php`, `ranking-pdf.blade.php` |
| Enum Keys         | TitleCase  | `AdminRole`, `OpdRole`, `Pending`, `Approved` |

### JavaScript / Alpine.js

| Tipe      | Konvensi   | Contoh                       |
| --------- | ---------- | ---------------------------- |
| Variable  | camelCase  | `totalNilai`, `isLoading`    |
| Function  | camelCase  | `calculateScore()`, `toggleModal()` |
| Component | camelCase  | `x-data="employeeForm"`      |

### Blade Components

| Tipe      | Konvensi   | Contoh                                    |
| --------- | ---------- | ----------------------------------------- |
| Component | kebab-case | `<x-nav-link>`, `<x-primary-button>`      |
| File      | kebab-case | `nav-link.blade.php`, `primary-button.blade.php` |

---

## File Organization

```
app/
├── Http/
│   ├── Controllers/          # Satu controller per resource
│   │   ├── Auth/             # Authentication controllers (Breeze)
│   │   ├── EmployeeController.php
│   │   └── ProfileController.php
│   ├── Middleware/           # Custom middleware
│   │   └── AdminMiddleware.php
│   └── Requests/             # Form Request validation classes
│       ├── Auth/
│       └── ProfileUpdateRequest.php
├── Imports/                  # Maatwebsite Excel import classes
│   └── EmployeeImport.php
├── Models/                   # Eloquent models (satu file per tabel)
│   ├── Employee.php
│   └── User.php
├── Services/                 # Business logic (MFEP calculations, dsb.)
│   └── MFEPCalculator.php    # Dibuat saat fitur kalkulasi dikembangkan
└── Providers/

resources/views/
├── auth/                     # Auth pages (Breeze)
├── components/               # Reusable Blade components
├── layouts/                  # Layout templates
├── employees/                # Employee CRUD views
├── laporan/                  # Report views
├── dashboard.blade.php
├── kriteria.blade.php
├── mfep.blade.php
├── perankingan.blade.php
└── ranking_pdf.blade.php

tests/
├── Feature/
│   ├── Auth/                 # Authentication tests
│   ├── Controllers/          # Controller feature tests
│   └── Imports/              # Excel import tests
└── Unit/
    └── Services/             # Unit tests untuk Service classes
```

---

## Controller Conventions

### Struktur Method Standard

```php
class EmployeeController extends Controller
{
    // Standard CRUD
    public function index(): View                    // List dengan filter/search
    public function create(): View                  // Tampilkan form tambah
    public function store(StoreEmployeeRequest $request): RedirectResponse
    public function show(Employee $employee): View  // Detail view
    public function edit(Employee $employee): View  // Form edit
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    public function destroy(Employee $employee): RedirectResponse

    // Custom actions (nama deskriptif dalam bahasa Indonesia/Inggris konsisten)
    public function import(Request $request): RedirectResponse
    public function ranking(): View
    public function cetakLaporan(): Response        // PDF export
}
```

### Controller Rules
- Satu controller per resource
- Logika bisnis HARUS dipindahkan ke Service class, bukan di controller
- Gunakan Form Request untuk validasi input
- Return type declaration wajib pada semua method publik
- Flash message menggunakan `session()->flash('success', '...')` atau `session()->flash('error', '...')`

---

## Model Conventions

```php
class Employee extends Model
{
    // 1. Fillable — kolom yang bisa diisi via mass assignment
    protected $fillable = [
        'nip',
        'nama',
        'bidang',
        'jabatan',
        'kedisiplinan',
        'kualitas_kerja',
        'tanggung_jawab',
        'kerjasama',
        'loyalitas',
        'total_nilai',
    ];

    // 2. Casts — type casting untuk kolom
    protected $casts = [
        'total_nilai' => 'float',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    // 3. Relationships (jika ada)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 4. Scopes (jika ada)
    public function scopeByPeriod(Builder $query, string $period): Builder
    {
        return $query->where('periode', $period);
    }

    // 5. Accessors/Mutators (jika ada)
    public function getTotalNilaiFormattedAttribute(): string
    {
        return number_format($this->total_nilai, 2);
    }
}
```

---

## MFEP Service Pattern

Semua logika kalkulasi MFEP harus dipisahkan ke dalam Service class:

```php
// app/Services/MFEPCalculator.php
class MFEPCalculator
{
    /**
     * Hitung total nilai MFEP untuk satu pegawai.
     *
     * @param Employee $employee
     * @param array<string, float> $weights Bobot per kriteria
     * @return float Total nilai (tidak dibulatkan)
     */
    public function calculateForEmployee(Employee $employee, array $weights): float;

    /**
     * Hitung dan urutkan semua pegawai untuk satu periode.
     *
     * @param string $periode Format: 'YYYY-MM'
     * @return Collection<Employee> Diurutkan dari nilai tertinggi
     */
    public function rankByPeriode(string $periode): Collection;

    /**
     * Ambil bobot kriteria aktif dari database/config.
     *
     * @return array<string, float>
     */
    public function getActiveWeights(): array;
}
```

---

## Form Request Conventions

```php
class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Gunakan Gate jika perlu authorization logic
    }

    public function rules(): array
    {
        return [
            'nip'            => ['required', 'string', 'unique:employees,nip'],
            'nama'           => ['required', 'string', 'max:255'],
            'kedisiplinan'   => ['required', 'integer', 'min:0', 'max:100'],
            'kualitas_kerja' => ['required', 'integer', 'min:0', 'max:100'],
            'tanggung_jawab' => ['required', 'integer', 'min:0', 'max:100'],
            'kerjasama'      => ['required', 'integer', 'min:0', 'max:100'],
            'loyalitas'      => ['required', 'integer', 'min:0', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'nip.required'   => 'NIP wajib diisi.',
            'nip.unique'     => 'NIP sudah terdaftar dalam sistem.',
            'nama.required'  => 'Nama pegawai wajib diisi.',
        ];
    }
}
```

---

## Blade Template Conventions

```blade
{{-- 1. Selalu extend layout utama --}}
@extends('layouts.app')

@section('title', 'Daftar Pegawai')

@section('content')
    {{-- 2. Gunakan komponen yang tersedia di resources/views/components/ --}}
    <x-primary-button>Simpan</x-primary-button>

    {{-- 3. Authorization menggunakan @can --}}
    @can('admin')
        <a href="{{ route('employees.create') }}">Tambah Pegawai</a>
    @endcan

    {{-- 4. Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- 5. Flash messages --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
@endsection
```

---

## Database & Migration Conventions

```php
// Nama migration: create_employees_table, add_bidang_to_employees_table
Schema::create('employees', function (Blueprint $table) {
    $table->id();
    $table->string('nip')->unique();
    $table->string('nama');
    $table->string('bidang');
    $table->string('jabatan');
    $table->integer('kedisiplinan')->default(0);
    $table->integer('kualitas_kerja')->default(0);
    $table->integer('tanggung_jawab')->default(0);
    $table->integer('kerjasama')->default(0);
    $table->integer('loyalitas')->default(0);
    $table->double('total_nilai')->default(0);
    $table->softDeletes(); // Wajib untuk data pegawai
    $table->timestamps();
});
```

**Rules:**
- Selalu gunakan `$table->softDeletes()` untuk tabel data utama
- Selalu set `->default()` pada kolom numerik
- Gunakan `->comment('...')` untuk kolom yang tidak obvious
- Index pada kolom yang sering di-query: `nip`, `periode`, `total_nilai`

---

## Testing Conventions

### Konfigurasi Database Testing (SQLite In-Memory)

Tambahkan di `phpunit.xml`:

```xml
<phpunit>
    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
        <env name="BCRYPT_ROUNDS" value="4"/>
        <env name="CACHE_STORE" value="array"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="QUEUE_CONNECTION" value="sync"/>
    </php>
</phpunit>
```

**Kenapa SQLite?**
- Tidak menganggu data MySQL production/development
- Lebih cepat (in-memory)
- Isolated per test run
- Tidak butuh setup database terpisah

### Struktur Test Class

```php
class MFEPCalculatorTest extends TestCase
{
    use RefreshDatabase; // Wajib — reset SQLite in-memory tiap test

    private MFEPCalculator $calculator;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = app(MFEPCalculator::class);
    }

    public function test_calculate_returns_correct_total(): void
    {
        // Arrange
        $employee = Employee::factory()->create([
            'kedisiplinan'   => 80,
            'kualitas_kerja' => 90,
            'tanggung_jawab' => 85,
            'kerjasama'      => 75,
            'loyalitas'      => 70,
        ]);

        // Act
        $result = $this->calculator->calculateForEmployee($employee, $this->defaultWeights());

        // Assert
        $this->assertEqualsWithDelta(80.0, $result, 0.000001);
    }

    private function defaultWeights(): array
    {
        return [
            'kedisiplinan'   => 0.20,
            'kualitas_kerja' => 0.25,
            'tanggung_jawab' => 0.20,
            'kerjasama'      => 0.15,
            'loyalitas'      => 0.20,
        ];
    }
}
```

### Naming Test Methods

```
test_[method]_[condition]_[expected_result]

Contoh:
test_calculate_with_zero_values_returns_zero
test_import_with_invalid_excel_throws_validation_error
test_ranking_orders_employees_by_total_nilai_descending
test_admin_can_access_all_opd_data
test_opd_user_cannot_access_other_opd_data
```

### Menjalankan Test

```bash
# Jalankan semua test
php artisan test --compact

# Jalankan satu file test
php artisan test --compact tests/Unit/Services/MFEPCalculatorTest.php

# Filter berdasarkan nama method
php artisan test --compact --filter=test_calculate_returns_correct_total
```

---

## Git Commit Message Format

```
<type>: <deskripsi singkat dalam bahasa Indonesia/Inggris>

type:
  feat     - Fitur baru
  fix      - Bug fix
  docs     - Perubahan dokumentasi
  style    - Formatting, whitespace (tidak ada perubahan logika)
  refactor - Refactoring kode tanpa perubahan fitur
  test     - Menambah atau memperbaiki test
  chore    - Perubahan build process, dependency updates

Contoh:
feat: tambah fitur import pegawai dari Excel
fix: perbaiki kalkulasi MFEP saat nilai kriteria nol
docs: update README instruksi instalasi
test: tambah unit test untuk MFEPCalculator
refactor: pindahkan logika kalkulasi ke Service class
```

---

## Code Style

- **Indentasi:** 4 spasi (PHP), 2 spasi (YAML/JSON)
- **Quotes:** Single quotes untuk string PHP (kecuali interpolasi)
- **Trailing comma:** Selalu pada array multi-line
- **Curly braces:** Selalu, bahkan untuk single-line control structures
- **Pint:** Jalankan `vendor/bin/pint --dirty` setelah modifikasi file PHP

```php
// BENAR
if ($condition) {
    doSomething();
}

$array = [
    'key1' => 'value1',
    'key2' => 'value2', // trailing comma
];

// SALAH
if ($condition) doSomething();
```
