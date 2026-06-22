# SKILL.md — SPK-MFEP Agent Skills

## Overview

File ini mendefinisikan skill yang WAJIB diinvoke oleh AI coding assistants saat bekerja di project SPK-MFEP. Ikuti trigger conditions di bawah ini dengan ketat.

---

## Mandatory Skills & Trigger Conditions

### 1. `brainstorming`
**Kapan invoke:**
- Sebelum membuat fitur baru ("tambah", "buatkan", "create", "buat fitur")
- Sebelum refactoring besar ("restructure", "refactor", "ubah arsitektur")
- Sebelum mengubah logika kalkulasi MFEP
- Sebelum menambah kriteria baru atau mengubah bobot

**Catatan:** Brainstorming HARUS selesai (design disetujui user) sebelum implementasi dimulai.

---

### 2. `laravel-best-practices`
**Kapan invoke:**
- Membuat atau memodifikasi Controller
- Membuat atau memodifikasi Model Eloquent
- Membuat migration database baru
- Membuat Form Request validation
- Menulis Eloquent query (terutama yang melibatkan joins atau aggregations)
- Membuat Service class untuk business logic

**Catatan:** Wajib untuk SEMUA pekerjaan PHP backend tanpa pengecualian.

---

### 3. `frontend-design`
**Kapan invoke:**
- Membuat halaman Blade baru
- Memodifikasi komponen UI yang sudah ada
- Membuat layout baru
- Menambah form atau tabel data
- Memperbaiki tampilan/styling

**Catatan:** Utamakan komponen yang sudah ada di `resources/views/components/` sebelum membuat baru.

---

### 4. `tailwindcss-development`
**Kapan invoke:**
- Setiap pesan yang mengandung kata "tailwind" dalam bentuk apapun
- Membuat grid layout, flex container, atau komponen responsive
- Styling tabel, form, card, navbar, sidebar
- Menambahkan dark mode atau variasi hover/focus
- Memperbaiki spacing, typography, atau color

---

### 5. `security-review`
**Kapan invoke:**
- Membuat atau memodifikasi authentication flow
- Menangani user input (form submission, file upload)
- Membuat API endpoint baru
- Mengubah middleware atau access control
- Implementasi file import (Excel upload)
- Semua operasi yang menyentuh data pegawai sensitif

---

### 6. `systematic-debugging`
**Kapan invoke:**
- Bug ditemukan atau dilaporkan
- Test failure terjadi
- Unexpected behavior pada kalkulasi MFEP
- Error saat import Excel
- PDF tidak generate dengan benar
- "fix", "bug", "error", "tidak berfungsi", "salah hitung"

**Catatan:** Diagnosa root cause SEBELUM menulis kode perbaikan.

---

### 7. `test-driven-development`
**Kapan invoke:**
- Sebelum implementasi fitur baru
- Sebelum menulis Service class baru
- Sebelum menulis kalkulasi MFEP baru
- Saat diminta menulis test

**Catatan:** Test HARUS ditulis sebelum implementasi (red-green-refactor cycle).

---

### 8. `writing-plans`
**Kapan invoke:**
- Setelah brainstorming selesai dan design disetujui user
- Sebelum eksekusi task yang melibatkan lebih dari 3 file
- Saat task kompleks yang butuh urutan langkah yang jelas

---

## Quick Reference

| Trigger Keyword                     | Skill yang Diinvoke     |
| ----------------------------------- | ----------------------- |
| "buatkan", "tambah", "create"       | brainstorming           |
| "fix", "bug", "error"               | systematic-debugging    |
| "test", "spec"                      | test-driven-development |
| "tailwind"                          | tailwindcss-development |
| PHP/Controller/Model                | laravel-best-practices  |
| UI/Blade/tampilan                   | frontend-design         |
| Auth/upload/input                   | security-review         |
| Setelah design disetujui            | writing-plans           |

---

## Skill Priority Order

Jika beberapa skill bisa diterapkan sekaligus, ikuti urutan ini:

1. **Process skills dulu** — brainstorming, systematic-debugging, test-driven-development
2. **Domain skills kedua** — laravel-best-practices, security-review
3. **Implementation skills terakhir** — frontend-design, tailwindcss-development

---

## Project-Specific Notes

- Perubahan pada kalkulasi MFEP **selalu** membutuhkan brainstorming + security-review + TDD
- Import Excel **selalu** membutuhkan security-review karena file upload
- Laporan PDF **selalu** membutuhkan frontend-design untuk layout
- Setiap perubahan database **wajib** diverifikasi dengan `php artisan test --compact`
