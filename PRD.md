# Product Requirements Document (PRD)

## SPK-MFEP - Sistem Pendukung Keputusan Pegawai Teladan

**Versi:** 1.0  
**Tanggal:** 2026-06-22  
**Klien:** Dinas Komunikasi dan Informatika (DISKOMINFO)  
**Deadline:** Selasa, 26 Mei 2026  

---

## 1. Ikhtisar (Overview)

### 1.1 Tujuan

Dokumen ini menentukan persyaratan sistem SPK-MFEP — sebuah Sistem Pendukung Keputusan untuk memilih pegawai teladan di Dinas Komunikasi dan Informatika menggunakan metode MFEP (Multifactor Evaluation Process).

### 1.2 Lingkup Proyek

**Dalam Lingkup:**
- Perbaikan bug (kolom yang hilang, duplikasi route, validasi)
- CRUD Pegawai (Create, Read, Update, Delete)
- Tampilan Kriteria (bobot tetap, tidak dapat diubah)
- Manajemen data berbasis periode (bulan/tahun)
- Validasi dan penanganan error yang lebih baik

**Di Luar Lingkup:**
- Manajemen bobot kriteria yang dinamis (bobot tetap)
- Fitur visualisasi baru (grafik/chart)
- Optimasi mobile
- Integrasi dengan sistem eksternal

### 1.3 Teknologi

| Komponen | Teknologi |
|----------|-----------|
| Framework | Laravel 13 |
| PHP | 8.4 |
| Database | MySQL |
| Frontend | Bootstrap 5, Alpine.js v3 |
| Autentikasi | Laravel Breeze v2 |
| Import Excel | Maatwebsite Excel |
| Generate PDF | DomPDF |
| CSS Utility | Tailwind CSS v3 |

---

## 2. Pengguna Sistem

### 2.1 Peran Pengguna (RBAC)

| Peran | Deskripsi | Izin |
|-------|-----------|------|
| **Admin** | Administrator sistem | CRUD penuh semua data, jalankan perhitungan |
| **Kepala OPD** | Kepala organisasi | Lihat laporan, lihat perankingan, tentukan pegawai teladan |

> **Catatan:** Tidak ada registrasi mandiri. Semua akun dibuat dan dikelola oleh Admin.

### 2.2 User Stories

#### Sebagai Admin:
- Saya ingin menambah data pegawai secara manual agar saya dapat mengelola data individu
- Saya ingin mengedit data pegawai agar saya dapat memperbarui informasi yang ada
- Saya ingin menghapus data pegawai agar saya dapat membersihkan data yang tidak relevan
- Saya ingin mengimpor data pegawai via Excel agar saya dapat mengunggah data secara massal
- Saya ingin menjalankan perhitungan MFEP agar saya dapat mendapatkan skor perankingan
- Saya ingin memfilter data berdasarkan periode agar saya dapat mengelola data per bulan/tahun

#### Sebagai Kepala OPD:
- Saya ingin melihat laporan perankingan agar saya dapat mengidentifikasi pegawai berprestasi
- Saya ingin mencetak/mengekspor laporan agar saya dapat mendokumentasikan proses seleksi
- Saya ingin menentukan pegawai teladan agar saya dapat menyelesaikan proses seleksi

---

## 3. Spesifikasi Metode MFEP

### 3.1 Kriteria Evaluasi (Bobot Tetap)

| No | Kriteria | Bobot (FW) | Keterangan |
|----|----------|------------|------------|
| 1 | Kedisiplinan | 0.30 | Disiplin dan ketepatan waktu |
| 2 | Kualitas Kerja | 0.20 | Kualitas hasil pekerjaan |
| 3 | Tanggung Jawab | 0.20 | Tanggung jawab dalam tugas |
| 4 | Kerja Sama Tim | 0.20 | Kemampuan kolaborasi tim |
| 5 | Loyalitas dan Sikap | 0.10 | Loyalitas dan sikap kerja |
|   | **Total Bobot** | **1.00** | |

### 3.2 Rumus Perhitungan

```
WE (Weighted Evaluation) = FW × E

Dimana:
  WE = Nilai Evaluasi Terbobot per kriteria
  FW = Bobot Tetap Kriteria
  E  = Nilai Evaluasi (skala 1–100)

Total Nilai = Σ(WE semua kriteria)
           = (Kedisiplinan × 0.30)
           + (Kualitas Kerja × 0.20)
           + (Tanggung Jawab × 0.20)
           + (Kerja Sama Tim × 0.20)
           + (Loyalitas × 0.10)
```

**Implementasi PHP:**
```php
$total = ($employee->kedisiplinan * 0.30)
       + ($employee->kualitas_kerja * 0.20)
       + ($employee->tanggung_jawab * 0.20)
       + ($employee->kerjasama * 0.20)
       + ($employee->loyalitas * 0.10);
```

### 3.3 Skala Nilai

- **Minimum:** 1
- **Maksimum:** 100
- **Semakin tinggi = Semakin baik**

---

## 4. Skema Database

### 4.1 Tabel `users`

```sql
users (
    id                BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name              VARCHAR(255) NOT NULL,
    email             VARCHAR(255) UNIQUE NOT NULL,
    role              ENUM('admin', 'opd') DEFAULT 'admin',
    email_verified_at TIMESTAMP NULL,
    password          VARCHAR(255) NOT NULL,
    remember_token    VARCHAR(100) NULL,
    created_at        TIMESTAMP,
    updated_at        TIMESTAMP
)
```

### 4.2 Tabel `employees` (diperbarui)

```sql
employees (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nip             VARCHAR(50) UNIQUE NOT NULL,
    nama            VARCHAR(255) NOT NULL,
    bidang          VARCHAR(255) NULL,
    jabatan         VARCHAR(255) NULL,
    kedisiplinan    TINYINT UNSIGNED DEFAULT 0,
    kualitas_kerja  TINYINT UNSIGNED DEFAULT 0,
    tanggung_jawab  TINYINT UNSIGNED DEFAULT 0,
    kerjasama       TINYINT UNSIGNED DEFAULT 0,
    loyalitas       TINYINT UNSIGNED DEFAULT 0,
    total_nilai     DECIMAL(5,2) DEFAULT 0,
    bulan           TINYINT UNSIGNED NOT NULL,   -- BARU
    tahun           SMALLINT UNSIGNED NOT NULL,  -- BARU
    created_at      TIMESTAMP,
    updated_at      TIMESTAMP
)
```

> **Catatan:** Kolom `bulan` dan `tahun` sebelumnya hilang dari migrasi. Perlu ditambahkan via migration baru.

---

## 5. Spesifikasi Fungsionalitas

### 5.1 Modul Autentikasi

| Fitur | Status | Keterangan |
|-------|--------|------------|
| Login | ✅ Sudah ada | Breeze standard |
| Logout | ✅ Sudah ada | Akhiri sesi |
| Register | ⚠️ Dinonaktifkan | Tidak ada registrasi mandiri |
| Lupa Password | ✅ Sudah ada | Reset via email |
| Verifikasi Email | ✅ Sudah ada | Wajib saat login pertama |

### 5.2 Modul Dashboard

| Fitur | Status | Keterangan |
|-------|--------|------------|
| Kartu Statistik | ✅ Sudah ada | Total pegawai, info periode |
| Quick Action | ✅ Sudah ada | Link ke halaman utama |

### 5.3 Modul Manajemen Pegawai

| Fitur | Status | Prioritas |
|-------|--------|-----------|
| Daftar Pegawai | ✅ Sudah ada | Tampilan tabel terurut |
| Tambah Pegawai | ❌ Belum ada | **HIGH** |
| Edit Pegawai | ❌ Belum ada | **HIGH** |
| Hapus Pegawai | ❌ Belum ada | **HIGH** |
| Import Excel | ✅ Sudah ada | Maatwebsite Excel |
| Filter Periode | ⚠️ Rusak | Kolom bulan/tahun hilang |

### 5.4 Modul Kriteria

| Fitur | Status | Keterangan |
|-------|--------|------------|
| Lihat Kriteria | ✅ Sudah ada | Tampilan statis |
| Ubah Bobot | ❌ Di luar lingkup | Bobot tetap |

### 5.5 Modul Perhitungan MFEP

| Fitur | Status | Keterangan |
|-------|--------|------------|
| Jalankan Perhitungan | ✅ Sudah ada | Hitung total_nilai |
| Lihat Hasil | ✅ Sudah ada | Tampilkan skor |

### 5.6 Modul Perankingan

| Fitur | Status | Keterangan |
|-------|--------|------------|
| Lihat Perankingan | ✅ Sudah ada | Diurutkan DESC |
| Filter Periode | ⚠️ Rusak | Perlu perbaikan |
| Ekspor PDF | ✅ Sudah ada | DomPDF |
| Cetak SK | ✅ Sudah ada | Surat Keputusan |

---

## 6. Bug yang Harus Diperbaiki

### 6.1 Bug Kritis

| No | Bug | Perbaikan |
|----|-----|-----------|
| 1 | Kolom `bulan`/`tahun` tidak ada di tabel | Buat migration baru |
| 2 | Import Excel gagal untuk `bulan`/`tahun` | Update `EmployeeImport` |
| 3 | Filter perankingan tidak berfungsi | Perbaiki controller & view |

### 6.2 Bug Sedang

| No | Bug | Perbaikan |
|----|-----|-----------|
| 4 | Definisi route duplikat (`/cetak-laporan`) | Hapus definisi duplikat |
| 5 | Tidak ada validasi di `EmployeeImport` | Tambah aturan validasi |

### 6.3 Bug Ringan

| No | Bug | Perbaikan |
|----|-----|-----------|
| 6 | Dead code di `ranking_pdf.blade.php` | Hapus markdown fences |

---

## 7. Fitur Baru yang Diimplementasikan

### 7.1 CRUD Pegawai

#### Tambah Pegawai (Create)
- Route: `GET /employees/create` (form), `POST /employees` (submit)
- Controller: `EmployeeController@create`, `EmployeeController@store`
- Request: `EmployeeStoreRequest`
- View: `resources/views/employees/create.blade.php`

#### Edit Pegawai (Update)
- Route: `GET /employees/{id}/edit` (form), `PUT /employees/{id}` (submit)
- Controller: `EmployeeController@edit`, `EmployeeController@update`
- Request: `EmployeeUpdateRequest`
- View: `resources/views/employees/edit.blade.php`

#### Hapus Pegawai (Delete)
- Route: `DELETE /employees/{id}`
- Controller: `EmployeeController@destroy`
- UI: Modal konfirmasi sebelum hapus

### 7.2 Import yang Diperbaiki

- Validasi semua field saat import
- Tampilkan pesan error detail per baris
- Auto-hitung `total_nilai` saat import
- Support kolom `bulan` dan `tahun`

### 7.3 Manajemen Periode

- Tambah `bulan`/`tahun` ke form pegawai
- Filter perankingan berdasarkan periode
- Indikator periode aktif di dashboard

---

## 8. Aturan Validasi

### 8.1 Validasi Pegawai

```php
// EmployeeStoreRequest
[
    'nip'           => 'required|string|max:50|unique:employees,nip',
    'nama'          => 'required|string|max:255',
    'bidang'        => 'nullable|string|max:255',
    'jabatan'       => 'nullable|string|max:255',
    'kedisiplinan'  => 'required|integer|min:1|max:100',
    'kualitas_kerja'=> 'required|integer|min:1|max:100',
    'tanggung_jawab'=> 'required|integer|min:1|max:100',
    'kerjasama'     => 'required|integer|min:1|max:100',
    'loyalitas'     => 'required|integer|min:1|max:100',
    'bulan'         => 'required|integer|min:1|max:12',
    'tahun'         => 'required|integer|min:2000|max:2100',
]

// EmployeeUpdateRequest (nip unik kecuali diri sendiri)
[
    'nip' => 'required|string|max:50|unique:employees,nip,' . $this->employee->id,
    // ... sisa sama seperti store
]
```

### 8.2 Validasi Import Excel

```php
// EmployeeImport rules()
[
    'nip'           => 'required|string|max:50',
    'nama'          => 'required|string|max:255',
    'kedisiplinan'  => 'required|integer|min:1|max:100',
    'kualitas_kerja'=> 'required|integer|min:1|max:100',
    'tanggung_jawab'=> 'required|integer|min:1|max:100',
    'kerjasama'     => 'required|integer|min:1|max:100',
    'loyalitas'     => 'required|integer|min:1|max:100',
    'bulan'         => 'required|integer|min:1|max:12',
    'tahun'         => 'required|integer|min:2000|max:2100',
]
```

---

## 9. Spesifikasi Route

```php
// Autentikasi (Breeze)
GET    /             → Redirect ke /login atau /dashboard
GET    /login        → Halaman login
POST   /login        → Proses autentikasi
POST   /logout       → Akhiri sesi

// Dashboard
GET    /dashboard    → Dashboard (auth, verified)

// Pegawai (Admin only)
GET    /employees              → Daftar pegawai
GET    /employees/create       → Form tambah (BARU)
POST   /employees              → Simpan pegawai (BARU)
GET    /employees/{id}/edit    → Form edit (BARU)
PUT    /employees/{id}         → Update pegawai (BARU)
DELETE /employees/{id}         → Hapus pegawai (BARU)
POST   /import-pegawai         → Import Excel

// Kriteria
GET    /kriteria               → Tampil kriteria (Admin only)

// Perhitungan MFEP
GET    /hitung-mfep            → Jalankan perhitungan (Admin only)

// Perankingan
GET    /perankingan            → Lihat perankingan + filter periode

// Laporan
GET    /cetak-laporan          → Cetak SK pegawai terbaik
GET    /cetak-ranking          → Cetak daftar lengkap perankingan

// Profil
GET    /profile                → Edit profil
PATCH  /profile                → Update profil
DELETE /profile                → Hapus akun
```

---

## 10. Struktur File

```
app/
├── Http/
│   ├── Controllers/
│   │   └── EmployeeController.php     # Diperluas dengan CRUD
│   ├── Requests/
│   │   ├── EmployeeStoreRequest.php   # BARU
│   │   └── EmployeeUpdateRequest.php  # BARU
│   └── Middleware/
│       └── AdminMiddleware.php         # Sudah ada
├── Imports/
│   └── EmployeeImport.php              # Diperbarui dengan validasi
└── Models/
    └── Employee.php                    # Diperbarui dengan fillable
database/
└── migrations/
    └── xxxx_add_bulan_tahun_to_employees.php  # BARU
resources/
└── views/
    ├── employees/
    │   ├── index.blade.php             # Diperbarui (tombol tambah + filter)
    │   ├── create.blade.php            # BARU
    │   └── edit.blade.php              # BARU
    ├── perankingan.blade.php           # Diperbarui (filter periode)
    └── laporan/
        └── ranking_pdf.blade.php       # Diperbaiki (hapus dead code)
routes/
└── web.php                             # Diperbarui (hapus duplikat, tambah CRUD)
tests/
├── Feature/
│   └── EmployeeTest.php                # BARU
└── Unit/
    └── MFEPCalculationTest.php         # BARU
```

---

## 11. Kriteria Penerimaan (Acceptance Criteria)

### 11.1 CRUD Pegawai
- [ ] Admin dapat membuat pegawai baru dengan semua field
- [ ] Admin dapat mengedit data pegawai yang ada
- [ ] Admin dapat menghapus pegawai dengan konfirmasi
- [ ] Keunikan NIP ditegakkan
- [ ] Semua aturan validasi diterapkan
- [ ] Pesan error ditampilkan dengan jelas

### 11.2 Import Fungsionalitas
- [ ] Import Excel berfungsi dengan kolom baru
- [ ] Baris yang tidak valid dilewati dengan pesan error
- [ ] `total_nilai` dihitung otomatis saat import

### 11.3 Manajemen Periode
- [ ] Pegawai dapat difilter berdasarkan `bulan`/`tahun`
- [ ] Perankingan mengikuti filter periode
- [ ] Dashboard menampilkan info periode aktif

### 11.4 Perhitungan MFEP
- [ ] Perhitungan MFEP akurat
- [ ] Semua pegawai dalam periode disertakan

### 11.5 Laporan
- [ ] Generasi PDF berfungsi dengan benar
- [ ] Laporan menampilkan periode yang benar

### 11.6 Perbaikan Bug
- [ ] Tidak ada route duplikat
- [ ] Tidak ada error validasi di form
- [ ] Tidak ada dead code di template

---

## 12. Kebutuhan Pengujian

### 12.1 Unit Tests
- Akurasi perhitungan MFEP
- Validasi model Employee

### 12.2 Feature Tests
- Operasi CRUD pegawai
- Fungsionalitas import
- Generasi perankingan
- Alur autentikasi

---

## 13. Keamanan

- Role-based access control (RBAC) ditegakkan
- CSRF protection pada semua form
- Pencegahan XSS via Laravel Blade
- Pencegahan SQL injection via Eloquent ORM
- Mass assignment protection via `$fillable`
- Tidak ada registrasi mandiri (Admin buat semua akun)

---

## 14. Pengguna Default

| Nama | Email | Role | Password |
|------|-------|------|----------|
| Admin | admin@gmail.com | admin | password |
| Kepala OPD | opd@gmail.com | opd | password |

---

## 15. Glosarium

| Istilah | Definisi |
|---------|----------|
| MFEP | Multifactor Evaluation Process |
| SPK | Sistem Pendukung Keputusan |
| OPD | Organisasi Perangkat Daerah |
| SK | Surat Keputusan |
| WE | Weighted Evaluation (Nilai Evaluasi Terbobot) |
| FW | Factor Weight (Bobot Faktor) |
| E | Evaluation (Nilai Mentah, skala 1–100) |
| NIP | Nomor Induk Pegawai |
| CRUD | Create, Read, Update, Delete |
| RBAC | Role-Based Access Control |

---

*Dokumen ini dibuat berdasarkan `proposal-project.docx` dan analisis kode sumber yang ada.*
