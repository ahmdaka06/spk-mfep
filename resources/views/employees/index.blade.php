<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-3xl text-white leading-tight">
            Data Pegawai
        </h2>
    </x-slot>

    <div class="py-10 min-h-screen relative overflow-hidden bg-gradient-to-br from-blue-100 to-white-100">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))

                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>

            @endif

            {{-- Action Buttons --}}
            <div class="flex flex-wrap gap-3 mb-6">
                <a
                    href="{{ route('employees.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl transition font-medium"
                >
                    + Tambah Pegawai
                </a>
            </div>

            {{-- Upload Card --}}
            <div class="bg-white shadow-lg rounded-2xl p-8 mb-8">

                <h1 class="text-2xl font-bold mb-2">
                    Import Data Pegawai (Excel)
                </h1>

                <p class="text-gray-500 mb-6">
                    Upload file Excel pegawai untuk proses perhitungan MFEP. Kolom yang diperlukan: nip, nama, bidang, jabatan, kedisiplinan, kualitas_kerja, tanggung_jawab, kerjasama, loyalitas.
                </p>

                <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                            <select name="bulan" class="border border-gray-300 rounded-lg p-3 w-full" required>
                                <option value="">-- Pilih Bulan --</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            @error('bulan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                            <input
                                type="number"
                                name="tahun"
                                value="{{ date('Y') }}"
                                min="2000"
                                max="2100"
                                class="border border-gray-300 rounded-lg p-3 w-full"
                                required
                            >
                            @error('tahun')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mb-5">

                        <label class="block text-sm font-medium text-gray-700 mb-1">File Excel</label>
                        <input
                            type="file"
                            name="file"
                            accept=".xlsx,.xls,.csv"
                            class="border border-gray-300 rounded-lg p-3 w-full"
                            required
                        >
                        @error('file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl transition"
                    >
                        Import Excel
                    </button>

                </form>

            </div>

            {{-- MFEP Button --}}
            <div class="mb-8">

                @if($employees->count() > 0)

                    <a
                        href="/hitung-mfep"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition"
                    >
                        Hitung MFEP
                    </a>

                @else

                    <button
                        onclick="showAlert()"
                        class="bg-gray-400 text-white px-6 py-3 rounded-xl cursor-pointer"
                    >
                        Hitung MFEP
                    </button>

                @endif

            </div>

            {{-- Table --}}
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

                <div class="p-6 border-b">

                    <h2 class="text-2xl font-bold">
                        Ranking Pegawai
                    </h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="p-4 text-left">No</th>
                                <th class="p-4 text-left">NIP</th>
                                <th class="p-4 text-left">Nama</th>
                                <th class="p-4 text-left">Bidang</th>
                                <th class="p-4 text-left">Jabatan</th>
                                <th class="p-4 text-left">Kedisiplinan</th>
                                <th class="p-4 text-left">Kualitas Kerja</th>
                                <th class="p-4 text-left">Tanggung Jawab</th>
                                <th class="p-4 text-left">Kerjasama</th>
                                <th class="p-4 text-left">Loyalitas</th>
                                <th class="p-4 text-left">Total Nilai</th>
                                <th class="p-4 text-left">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($employees as $employee)

                            <tr class="border-b hover:bg-gray-50">

                                <td class="p-4">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="p-4">
                                    {{ $employee->nip }}
                                </td>

                                <td class="p-4">
                                    {{ $employee->nama }}
                                </td>

                                <td class="p-4">
                                    {{ $employee->bidang }}
                                </td>

                                <td class="p-4">
                                    {{ $employee->jabatan }}
                                </td>

                                <td class="p-4">
                                    {{ $employee->kedisiplinan }}
                                </td>

                                <td class="p-4">
                                    {{ $employee->kualitas_kerja }}
                                </td>

                                <td class="p-4">
                                    {{ $employee->tanggung_jawab }}
                                </td>

                                <td class="p-4">
                                    {{ $employee->kerjasama }}
                                </td>

                                <td class="p-4">
                                    {{ $employee->loyalitas }}
                                </td>

                                <td class="p-4 font-bold text-blue-600">
                                    {{ $employee->total_nilai }}
                                </td>

                                <td class="p-4">
                                    <div class="flex gap-2">
                                        <a
                                            href="{{ route('employees.edit', $employee) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1.5 rounded-lg text-sm transition"
                                        >
                                            Edit
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('Yakin hapus pegawai ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm transition"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <script>

    function showAlert() {

        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Harap import file Excel terlebih dahulu!',
            confirmButtonColor: '#2563eb',
            confirmButtonText: 'OK'
        });

    }

</script>

</x-app-layout>