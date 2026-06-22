# RULES.md — Aturan Wajib SPK-MFEP

Aturan di bawah ini bersifat **non-negotiable**. Tidak ada pengecualian kecuali ada persetujuan eksplisit dari pemilik project.

---

## Data Integrity

1. **NEVER** memodifikasi data pegawai secara langsung tanpa audit log
2. **NEVER** menggunakan hard delete pada record pegawai — gunakan soft delete (`deleted_at`)
3. **NEVER** hardcode bobot kriteria di dalam kode — selalu load dari database atau config
4. **ALWAYS** validasi data Excel sebelum diproses saat import
5. **ALWAYS** backup data sebelum menjalankan operasi bulk (mass update/delete)
6. **ALWAYS** simpan nilai mentah (raw values) sebelum normalisasi kalkulasi
7. **NEVER** overwrite data pegawai yang sudah terverifikasi tanpa konfirmasi eksplisit dari user

---

## Security

1. **MUST** gunakan parameterized queries — dilarang raw SQL dengan input user langsung
   ```php
   // BENAR
   Employee::where('nip', $request->nip)->first();
   
   // SALAH
   DB::select("SELECT * FROM employees WHERE nip = '" . $request->nip . "'");
   ```
2. **MUST** validasi file upload: tipe file (xlsx, xls), ukuran maksimal, dan struktur kolom
3. **MUST** sanitasi output pada PDF reports untuk mencegah XSS injection
4. **MUST** implementasi CSRF protection pada semua form
5. **MUST** gunakan Laravel Gate atau Policy untuk authorization, bukan hanya middleware
6. **NEVER** expose internal error messages atau stack trace kepada end user
7. **NEVER** simpan password dalam plain text — selalu gunakan `Hash::make()`
8. **MUST** batasi akses OPD hanya ke data OPD mereka sendiri di semua query

---

## Calculation Rules

1. **MUST** gunakan presisi desimal minimum 6 angka di belakang koma untuk kalkulasi MFEP internal
2. **MUST** simpan nilai mentah (raw) sebelum normalisasi
3. **MUST** pembulatan HANYA untuk keperluan display, TIDAK PERNAH untuk kalkulasi
   ```php
   // BENAR — pembulatan hanya saat ditampilkan
   number_format($totalNilai, 2);
   
   // SALAH — pembulatan saat kalkulasi
   $totalNilai = round($totalNilai, 2);
   $newCalc = $totalNilai * $bobot; // hasil sudah tidak akurat
   ```
4. **MUST** recalculate semua ranking dalam satu periode jika ada perubahan bobot kriteria
5. **NEVER** cache hasil kalkulasi ranking secara permanen — selalu recalculate saat diperlukan
6. **MUST** semua pegawai dalam periode yang sama menggunakan bobot kriteria yang identik
7. **NEVER** interpolasi atau estimasi nilai — gunakan nilai aktual dari database

---

## File Operations

1. **MUST** gunakan Laravel Storage abstraction untuk semua operasi file
   ```php
   // BENAR
   Storage::disk('local')->put($path, $contents);
   
   // SALAH
   file_put_contents(public_path($path), $contents);
   ```
2. **MUST** validasi struktur template Excel sebelum memproses import (header kolom harus sesuai)
3. **MUST** simpan file upload di luar web root (gunakan `storage/app/`, bukan `public/`)
4. **MUST** generate nama file unik untuk mencegah collision (gunakan `Str::uuid()` atau timestamp)
5. **MUST** hapus file temporary setelah proses import selesai
6. **NEVER** izinkan upload file selain format Excel (.xlsx, .xls)

---

## Testing Rules

1. **MUST** tulis test untuk semua logika kalkulasi MFEP
2. **MUST** test edge cases: nilai nol, nilai maksimal, nilai null, pegawai tanpa kriteria
3. **MUST** verifikasi output PDF sesuai dengan hasil kalkulasi
4. **MUST** gunakan SQLite in-memory untuk semua test (lihat CONVENTIONS.md)
5. **NEVER** jalankan test yang connect ke database MySQL production
6. **MUST** gunakan `RefreshDatabase` trait di semua Feature tests
7. **MUST** gunakan factories untuk membuat test data — jangan insert manual
8. **MUST** assertion kalkulasi menggunakan toleransi presisi:
   ```php
   $this->assertEqualsWithDelta($expected, $actual, 0.000001);
   ```

---

## Access Control Rules

1. **MUST** semua route dilindungi middleware `auth` minimum
2. **MUST** route admin dilindungi `AdminMiddleware` atau policy `isAdmin()`
3. **NEVER** izinkan OPD mengakses data OPD lain
4. **MUST** validasi ownership data di level controller, bukan hanya di level route
5. **MUST** gunakan `can()` directive di Blade untuk semua conditional UI berdasarkan role

---

## Code Quality Rules

1. **MUST** jalankan `vendor/bin/pint --dirty` setelah memodifikasi file PHP apapun
2. **MUST** jalankan `php artisan test --compact` sebelum dianggap selesai
3. **NEVER** commit kode dengan `dd()`, `dump()`, atau `var_dump()` yang tertinggal
4. **NEVER** commit `.env` atau file yang mengandung credentials
5. **MUST** semua method publik pada Service class memiliki return type declaration
6. **NEVER** buat file baru jika sudah ada file yang bisa diedit untuk tujuan yang sama
