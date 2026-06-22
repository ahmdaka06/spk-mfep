<x-app-layout>

    <x-slot name="header">

        <h2 class="font-bold text-3xl text-white">
            Kriteria Penilaian MFEP
        </h2>

    </x-slot>

    <div class="py-10 min-h-screen relative overflow-hidden bg-gradient-to-br from-blue-100 to-white-100">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- KRITERIA 1 --}}
                <div class="bg-white rounded-3xl shadow-lg p-8">

                    <h1 class="text-2xl font-bold text-blue-600 mb-4">
                        KEDISIPLINAN
                    </h1>

                    <ul class="text-gray-600 space-y-2">

                        <li>• Kehadiran tepat waktu</li>
                        <li>• Kepatuhan terhadap jam kerja</li>
                        <li>• Kepatuhan terhadap peraturan kantor</li>

                    </ul>

                </div>

                {{-- KRITERIA 2 --}}
                <div class="bg-white rounded-3xl shadow-lg p-8">

                    <h1 class="text-2xl font-bold text-green-600 mb-4">
                        KUALITAS KERJA
                    </h1>

                    <ul class="text-gray-600 space-y-2">

                        <li>• Ketelitian dalam bekerja</li>
                        <li>• Kualitas hasil pekerjaan</li>
                        <li>• Kemampuan menyelesaikan tugas sesuai standar</li>

                    </ul>

                </div>

                {{-- KRITERIA 3 --}}
                <div class="bg-white rounded-3xl shadow-lg p-8">

                    <h1 class="text-2xl font-bold text-purple-600 mb-4">
                        TANGGUNG JAWAB
                    </h1>

                    <ul class="text-gray-600 space-y-2">

                        <li>• Menyelesaikan tugas tepat waktu</li>
                        <li>• Kesediaan menerima dan melaksanakan tugas</li>
                        <li>• Bertanggung jawab atas hasil pekerjaan</li>

                    </ul>

                </div>

                {{-- KRITERIA 4 --}}
                <div class="bg-white rounded-3xl shadow-lg p-8">

                    <h1 class="text-2xl font-bold text-orange-600 mb-4">
                        KERJASAMA TIM
                    </h1>

                    <ul class="text-gray-600 space-y-2">

                        <li>• Komunikasi dengan rekan kerja</li>
                        <li>• Kemampuan berkolaborasi dalam tim</li>
                        <li>• Membantu rekan kerja saat diperlukan</li>

                    </ul>

                </div>

                {{-- KRITERIA 5 --}}
                <div class="bg-white rounded-3xl shadow-lg p-8">

                    <h1 class="text-2xl font-bold text-red-600 mb-4">
                        LOYALITAS & SIKAP
                    </h1>

                    <ul class="text-gray-600 space-y-2">

                        <li>• Integritas dan kejujuran</li>
                        <li>• Sikap sopan dan profesional</li>
                        <li>• Komitmen terhadap instansi</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>