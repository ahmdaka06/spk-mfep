<x-app-layout>

    <x-slot name="header">

        <h2 class="font-bold text-3xl text-white">
            Sistem MFEP
        </h2>

    </x-slot>

    <div class="py-10 min-h-screen relative overflow-hidden bg-gradient-to-br from-blue-100 to-white-100">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HERO --}}
                <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-cyan-600 rounded-3xl p-10 text-white shadow-xl mb-10">
                <h1 class="text-5xl font-bold mb-4">
                METODE MFEP
                </h1>
                </h1>

                <p class="text-blue-100 text-lg">
                    Multi Factor Evaluation Process digunakan untuk menentukan
                    pegawai teladan berdasarkan beberapa kriteria penilaian.
                </p>

            </div>

            {{-- STEP CARD --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- STEP 1 --}}
                <div class="bg-white rounded-3xl shadow-lg p-8">

                    <h1 class="text-2xl font-bold text-blue-600 mb-4">
                        1. Menentukan Kriteria
                    </h1>

                    <p class="text-gray-600">
                        Menentukan faktor penilaian seperti disiplin,
                        kinerja, loyalitas, kerjasama, dan inovasi.
                    </p>

                </div>

                {{-- STEP 2 --}}
                <div class="bg-white rounded-3xl shadow-lg p-8">

                    <h1 class="text-2xl font-bold text-green-600 mb-4">
                        2. Menentukan Bobot
                    </h1>

                    <p class="text-gray-600">
                        Setiap kriteria memiliki bobot sesuai tingkat
                        kepentingannya.
                    </p>

                </div>

                {{-- STEP 3 --}}
                <div class="bg-white rounded-3xl shadow-lg p-8">

                    <h1 class="text-2xl font-bold text-orange-600 mb-4">
                        3. Input Nilai Pegawai
                    </h1>

                    <p class="text-gray-600">
                        Admin memasukkan nilai setiap pegawai
                        berdasarkan kriteria.
                    </p>

                </div>

                {{-- STEP 4 --}}
                <div class="bg-white rounded-3xl shadow-lg p-8">

                    <h1 class="text-2xl font-bold text-red-600 mb-4">
                        4. Hitung MFEP
                    </h1>

                    <p class="text-gray-600 mb-4">
                        Sistem menghitung:
                    </p>

                    <div class="bg-gray-100 rounded-2xl p-4">

                        <p class="font-mono text-lg">
                            WE = Bobot × Nilai
                        </p>

                        <p class="font-mono text-lg mt-2">
                            Total = Σ WE
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>