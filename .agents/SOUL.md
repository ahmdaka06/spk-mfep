# SOUL.md — Jiwa & Filosofi Project SPK-MFEP

## Identitas Project

**SPK-MFEP** (Sistem Pendukung Keputusan - Multi Factor Evaluation Process) adalah sistem evaluasi kinerja pegawai pemerintah yang dirancang untuk menghasilkan keputusan yang **transparan, adil, dan dapat dipertanggungjawabkan**.

Sistem ini melayani instansi pemerintah (OPD - Organisasi Perangkat Daerah) dalam menentukan Pegawai Teladan berdasarkan penilaian multi-kriteria yang objektif.

---

## Tiga Pilar Utama

### 1. Transparansi
Setiap hasil ranking harus bisa dijelaskan langkah per langkah. Tidak ada "black box" dalam kalkulasi MFEP. User harus bisa memahami mengapa seorang pegawai mendapat nilai tertentu.

### 2. Keadilan
Semua pegawai dievaluasi dengan kriteria dan bobot yang sama. Tidak ada perlakuan khusus, tidak ada pengecualian. Sistem harus konsisten dalam setiap kondisi.

### 3. Akuntabilitas
Semua perubahan data, kalkulasi, dan laporan harus bisa ditelusuri. Siapa yang mengubah apa, kapan, dan mengapa harus tercatat dengan baik.

---

## Metodologi MFEP

### Kriteria Evaluasi (5 Kriteria)
| Kriteria       | Kolom DB         | Deskripsi                                 |
| -------------- | ---------------- | ----------------------------------------- |
| Kedisiplinan   | `kedisiplinan`   | Tingkat kepatuhan terhadap aturan kerja   |
| Kualitas Kerja | `kualitas_kerja` | Mutu hasil pekerjaan yang dihasilkan      |
| Tanggung Jawab | `tanggung_jawab` | Kesediaan bertanggung jawab atas tugasnya |
| Kerjasama      | `kerjasama`      | Kemampuan bekerja dalam tim               |
| Loyalitas      | `loyalitas`      | Kesetiaan dan dedikasi terhadap instansi  |

### Prinsip Kalkulasi
- Nilai setiap kriteria diinput langsung (integer)
- `total_nilai` adalah hasil agregasi seluruh kriteria
- Perankingan dilakukan berdasarkan `total_nilai` tertinggi
- Tidak ada estimasi atau interpolasi — gunakan nilai aktual dari data

### Aturan Penilaian
- Nilai per kriteria: integer (tidak ada desimal dalam input)
- Presisi desimal dijaga dalam proses kalkulasi internal
- Pembulatan HANYA dilakukan untuk keperluan tampilan (display), bukan kalkulasi
- Perubahan bobot kriteria mengharuskan recalculation seluruh ranking pada periode tersebut

---

## Mindset AI Saat Bekerja di Project Ini

### Pertanyaan yang Harus Selalu Ditanyakan
- "Apakah perubahan ini mempengaruhi hasil ranking pegawai?"
- "Apakah logika ini berlaku adil untuk semua pegawai?"
- "Bisakah admin/auditor memahami bagaimana nilai ini dihitung?"
- "Apakah perubahan ini mengancam integritas data yang sudah ada?"

### Hierarki Prioritas
1. **Keakuratan kalkulasi** — hasil MFEP harus benar, selalu
2. **Integritas data** — data pegawai tidak boleh rusak atau hilang
3. **Kejelasan laporan** — output harus mudah dibaca dan dipahami
4. **Kecepatan** — performa penting, tapi tidak lebih dari keakuratan
5. **Kenyamanan developer** — convenience tidak boleh mengorbankan kebenaran

### Sikap Terhadap Ambiguitas
- **Jika ragu dengan data**: tanyakan kepada user, jangan tebak
- **Jika ada dua cara hitung**: pilih yang lebih konservatif dan transparan
- **Jika ada konflik requirement**: prioritaskan keadilan penilaian pegawai
- **Jika ada edge case**: dokumentasikan keputusan dan alasannya

---

## Non-Negotiable Truths

Ini adalah kebenaran fundamental yang tidak bisa dikompromikan dalam kondisi apapun:

1. **Kalkulasi MFEP tidak boleh di-round selama proses hitung** — pembulatan hanya untuk display
2. **Import Excel tidak boleh menimpa data yang sudah terverifikasi** tanpa konfirmasi eksplisit
3. **Laporan PDF harus mencantumkan formula atau metode yang digunakan** agar auditable
4. **Setiap pegawai dalam periode yang sama menggunakan kriteria dan bobot yang identik** — tidak ada perlakuan berbeda
5. **Soft delete adalah satu-satunya cara menghapus data** — hard delete dilarang untuk data pegawai
6. **Role admin dan OPD harus dipisahkan dengan jelas** — OPD tidak boleh melihat data OPD lain

---

## Konteks Pengguna

### Admin
- Mengelola seluruh data pegawai dari semua OPD
- Mengatur kriteria dan bobot penilaian
- Melihat dan mencetak laporan ranking keseluruhan
- Memiliki akses penuh ke semua fitur sistem

### OPD (Organisasi Perangkat Daerah)
- Menginput dan mengelola data pegawai milik OPD mereka sendiri
- Melihat hasil ranking pegawai OPD mereka
- Tidak dapat melihat atau mengakses data OPD lain
- Dapat mencetak laporan untuk keperluan internal

---

## Pesan untuk AI

Kamu sedang bekerja pada sistem yang mempengaruhi karir nyata pegawai pemerintah. Hasil ranking yang dihasilkan sistem ini bisa mempengaruhi promosi, penghargaan, dan reputasi seseorang. Oleh karena itu:

> **Utamakan kebenaran di atas kecepatan. Utamakan keadilan di atas kesederhanaan kode. Utamakan transparansi di atas efisiensi.**

Setiap baris kode yang kamu tulis harus bisa dipertanggungjawabkan.
