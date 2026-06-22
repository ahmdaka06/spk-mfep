<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-3xl text-white leading-tight">
            Edit Data Pegawai
        </h2>
    </x-slot>

    <div class="py-10 min-h-screen bg-gradient-to-br from-blue-100 to-white-100">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg rounded-2xl p-8">

                <h1 class="text-2xl font-bold mb-6">Edit Pegawai: {{ $employee->nama }}</h1>

                <form action="{{ route('employees.update', $employee) }}" method="POST">

                    @csrf
                    @method('PUT')

                    {{-- NIP --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIP <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="nip"
                            value="{{ old('nip', $employee->nip) }}"
                            class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nip') border-red-500 @enderror"
                            placeholder="Nomor Induk Pegawai"
                        >
                        @error('nip')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama', $employee->nama) }}"
                            class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama') border-red-500 @enderror"
                            placeholder="Nama lengkap pegawai"
                        >
                        @error('nama')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bidang & Jabatan --}}
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bidang</label>
                            <input
                                type="text"
                                name="bidang"
                                value="{{ old('bidang', $employee->bidang) }}"
                                class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Bidang kerja"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                            <input
                                type="text"
                                name="jabatan"
                                value="{{ old('jabatan', $employee->jabatan) }}"
                                class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Jabatan"
                            >
                        </div>
                    </div>

                    {{-- Kriteria Nilai --}}
                    <div class="border border-gray-200 rounded-xl p-4 mb-4">
                        <h3 class="font-semibold text-gray-700 mb-4">Nilai Kriteria (skala 1&ndash;100)</h3>

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kedisiplinan <span class="text-red-500">*</span> <span class="text-gray-400">(Bobot: 0.30)</span></label>
                                <input
                                    type="number"
                                    name="kedisiplinan"
                                    value="{{ old('kedisiplinan', $employee->kedisiplinan) }}"
                                    min="1" max="100"
                                    class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kedisiplinan') border-red-500 @enderror"
                                >
                                @error('kedisiplinan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kualitas Kerja <span class="text-red-500">*</span> <span class="text-gray-400">(Bobot: 0.20)</span></label>
                                <input
                                    type="number"
                                    name="kualitas_kerja"
                                    value="{{ old('kualitas_kerja', $employee->kualitas_kerja) }}"
                                    min="1" max="100"
                                    class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kualitas_kerja') border-red-500 @enderror"
                                >
                                @error('kualitas_kerja')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggung Jawab <span class="text-red-500">*</span> <span class="text-gray-400">(Bobot: 0.20)</span></label>
                                <input
                                    type="number"
                                    name="tanggung_jawab"
                                    value="{{ old('tanggung_jawab', $employee->tanggung_jawab) }}"
                                    min="1" max="100"
                                    class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggung_jawab') border-red-500 @enderror"
                                >
                                @error('tanggung_jawab')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kerja Sama Tim <span class="text-red-500">*</span> <span class="text-gray-400">(Bobot: 0.20)</span></label>
                                <input
                                    type="number"
                                    name="kerjasama"
                                    value="{{ old('kerjasama', $employee->kerjasama) }}"
                                    min="1" max="100"
                                    class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kerjasama') border-red-500 @enderror"
                                >
                                @error('kerjasama')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Loyalitas dan Sikap <span class="text-red-500">*</span> <span class="text-gray-400">(Bobot: 0.10)</span></label>
                                <input
                                    type="number"
                                    name="loyalitas"
                                    value="{{ old('loyalitas', $employee->loyalitas) }}"
                                    min="1" max="100"
                                    class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('loyalitas') border-red-500 @enderror"
                                >
                                @error('loyalitas')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Periode --}}
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bulan <span class="text-red-500">*</span></label>
                            <select
                                name="bulan"
                                class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bulan') border-red-500 @enderror"
                            >
                                <option value="">-- Pilih Bulan --</option>
                                @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ old('bulan', $employee->bulan) == $m ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bulan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun <span class="text-red-500">*</span></label>
                            <input
                                type="number"
                                name="tahun"
                                value="{{ old('tahun', $employee->tahun) }}"
                                min="2000" max="2100"
                                class="border border-gray-300 rounded-lg p-3 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tahun') border-red-500 @enderror"
                            >
                            @error('tahun')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition font-medium"
                        >
                            Perbarui Data
                        </button>
                        <a
                            href="{{ route('employees.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-xl transition font-medium"
                        >
                            Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
