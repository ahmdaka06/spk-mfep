<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-3xl text-white leading-tight">
            Data Pegawai & Import Excel
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

            {{-- Upload Card --}}
            <div class="bg-white shadow-lg rounded-2xl p-8 mb-8">

                <h1 class="text-3xl font-bold mb-2">
                    Import Data Pegawai
                </h1>

                <p class="text-gray-500 mb-6">
                    Upload file Excel pegawai untuk proses perhitungan MFEP.
                </p>

                <form action="/import-pegawai" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-5">

                        <input
                            type="file"
                            name="file"
                            class="border border-gray-300 rounded-lg p-3 w-full"
                        >

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