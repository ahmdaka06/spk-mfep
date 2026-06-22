<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="font-bold text-3xl text-white">
                    Dashboard Admin
                </h2>

                <p class="text-white/80 mt-1">
                    Sistem Pendukung Keputusan Pegawai Teladan
                </p>

            </div>

        </div>

    </x-slot>

    <div class="py-10 min-h-screen relative overflow-hidden bg-gradient-to-br from-blue-100 to-white-100">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- HERO --}}
            <div
                class="relative overflow-hidden bg-gradient-to-r from-slate-900 via-blue-900 to-amber-500 rounded-[35px] p-12 text-white shadow-2xl mb-10">

                <div class="absolute -top-10 -right-5 text-[180px] opacity-10">
                    🏆
                </div>

                <div class="relative z-10">

                    <span class="bg-white/20 px-4 py-2 rounded-full text-sm">
                        Sistem Pendukung Keputusan
                    </span>

                    <h1 class="text-6xl font-extrabold mt-5 mb-4 leading-tight">
                        SATU TELADAN,
                        <br>
                        SEJUTA INSPIRASI
                    </h1>

                    <p class="text-xl text-amber-100">
                        Penilaian Pegawai Teladan menggunakan metode MFEP
                        (Multi Factor Evaluation Process)
                    </p>

                </div>

            </div>

            {{-- QUICK STATS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <div
                    class="bg-white rounded-3xl p-6 shadow-xl border-l-[10px] border-amber-500 hover:-translate-y-2 transition duration-300">

                    <div class="flex justify-between items-center">

                        <div>

                            <p class="text-gray-500">
                                Total Pegawai
                            </p>

                            <h1 class="text-5xl font-extrabold text-amber-600 mt-2">
                                {{ $totalPegawai }}
                            </h1>

                        </div>

                        <div
                            class="bg-gradient-to-r from-amber-400 to-white-500
                            
                            text-white p-4 rounded-2xl text-3xl shadow-lg">
                            👨‍💼
                        </div>

                    </div>

                </div>

                <div
                    class="bg-white rounded-3xl p-6 shadow-xl border-l-[10px] border-green-500 hover:-translate-y-2 transition duration-300">

                    <div class="flex justify-between items-center">

                        <div>

                            <p class="text-gray-500">
                                Total Kriteria
                            </p>

                            <h1 class="text-5xl font-extrabold text-green-600 mt-2">
                                5
                            </h1>

                        </div>

                        <div
                            class="bg-gradient-to-r from-green-500 to-emerald-400 text-white p-4 rounded-2xl text-3xl shadow-lg">
                            📊
                        </div>

                    </div>

                </div>

                <div
                    class="bg-white rounded-3xl p-6 shadow-xl border-l-[10px] border-purple-500 hover:-translate-y-2 transition duration-300">

                    <div class="flex justify-between items-center">

                        <div>

                            <p class="text-gray-500">
                                Metode
                            </p>

                            <h1 class="text-4xl font-extrabold text-purple-600 mt-2">
                                MFEP
                            </h1>

                        </div>

                        <div
                            class="bg-gradient-to-r from-purple-600 to-fuchsia-500 text-white p-4 rounded-2xl text-3xl shadow-lg">
                            🏆
                        </div>

                    </div>

                </div>

            </div>

            {{-- MENU --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <a href="/kriteria">

                    <div
                        class="bg-gradient-to-br from-emerald-50 to-green-100 rounded-3xl p-8 shadow-2xl hover:-translate-y-2 transition duration-300">

                        <div class="flex justify-between items-center mb-6">

                            <h2 class="text-2xl font-bold text-green-800">
                                Data Kriteria
                            </h2>

                            <div
                                class="bg-gradient-to-r from-green-500 to-emerald-400 text-white p-4 rounded-2xl text-2xl">
                                📊
                            </div>

                        </div>

                        <p class="text-green-700 text-lg">
                            Kelola seluruh kriteria penilaian pegawai teladan.
                        </p>

                    </div>

                </a>

                <a href="/mfep">

                    <div
                        class="bg-gradient-to-br from-purple-50 to-fuchsia-100 rounded-3xl p-8 shadow-2xl hover:-translate-y-2 transition duration-300">

                        <div class="flex justify-between items-center mb-6">

                            <h2 class="text-2xl font-bold text-purple-800">
                                Sistem MFEP
                            </h2>

                            <div
                                class="bg-gradient-to-r from-purple-600 to-fuchsia-500 text-white p-4 rounded-2xl text-2xl">
                                🏆
                            </div>

                        </div>

                        <p class="text-purple-700 text-lg">
                            Multi Factor Evaluation Process untuk menentukan
                            pegawai teladan terbaik.
                        </p>

                    </div>

                </a>

            </div>

        </div>

    </div>

</x-app-layout>