<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-3xl text-white">
            Perankingan Pegawai
        </h2>
    </x-slot>

    <div class="py-10 min-h-screen relative overflow-hidden bg-gradient-to-br from-blue-100 to-white-100">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">

                {{-- <div class="p-8 border-b">

                    <h1 class="text-3xl font-bold mb-2">
                        Periode:
                            {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                    </h1>

                    <p class="text-gray-500">
                        Ranking pegawai berdasarkan metode MFEP.
                    </p>

                </div> --}}

                            <div class="p-8 border-b">

                <h1 class="text-3xl font-bold mb-4">
                    Hasil Ranking MFEP
                </h1>

          <div class="bg-gray-50 rounded-2xl p-5 mb-4 inline-block">

    <form method="GET" class="flex items-end gap-4">

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Bulan
            </label>

            <select
                name="bulan"
                onchange="this.form.submit()"
                class="w-44 border border-gray-300 rounded-xl px-5 py-3 pr-12 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
                @foreach([
                    1=>'Januari',
                    2=>'Februari',
                    3=>'Maret',
                    4=>'April',
                    5=>'Mei',
                    6=>'Juni',
                    7=>'Juli',
                    8=>'Agustus',
                    9=>'September',
                    10=>'Oktober',
                    11=>'November',
                    12=>'Desember'
                ] as $key => $value)

                    <option
                        value="{{ $key }}"
                        {{ $bulan == $key ? 'selected' : '' }}
                    >
                        {{ $value }}
                    </option>

                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Tahun
            </label>

            <select
                name="tahun"
                onchange="this.form.submit()"
                class="w-44 appearance-none border border-gray-300 rounded-xl px-5 py-3 pr-12 shadow-sm"
        >
                @for($i = date('Y'); $i >= date('Y') - 5; $i--)

                    <option
                        value="{{ $i }}"
                        {{ $tahun == $i ? 'selected' : '' }}
                    >
                        {{ $i }}
                    </option>

                @endfor
            </select>
        </div>

    </form>

</div>
                <p class="text-gray-500">
                    Ranking pegawai berdasarkan metode MFEP.
                </p>

            </div>

                @if($employees->count() > 0)

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-blue-800 text-white">
                                <tr>
                                    <th class="p-4 text-left">Ranking</th>
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

                                    <tr class="border-b hover:bg-blue-50 transition duration-200">

                                        <td class="p-4 font-bold text-blue-600">
                                            #{{ $loop->iteration }}
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

                                        <td class="p-4 font-bold text-green-600">
                                            {{ $employee->total_nilai }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    @if(in_array(Auth::user()->role, ['opd', 'admin']))

                        <div class="text-center mt-6 mb-6 space-y-3">

                            <div>
                                <a
                                    href="{{ route('cetak.laporan') }}"
                                    class="inline-block px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow-md"
                                >
                                    Cetak PDF Pegawai Teladan
                                </a>
                            </div>

                            <div>
                                <a
                                    href="{{ route('cetak.ranking') }}"
                                    class="inline-block px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-xl shadow-md"
                                >
                                    Cetak PDF Seluruh Ranking Pegawai
                                </a>
                            </div>

                        </div>

                    @endif

                @else

                    <div class="p-16 text-center">

                        <div class="text-6xl mb-4">
                            📊
                        </div>

                        <h2 class="text-2xl font-bold text-gray-700 mb-2">
                            Ranking Masih Kosong
                        </h2>

                        <p class="text-gray-500">
                            Silahkan import data pegawai terlebih dahulu.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
