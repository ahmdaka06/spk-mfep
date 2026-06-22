<body>

    <!-- KOP SURAT -->
    <table width="100%" style="border:none;">

        <tr>

            <td width="15%" style="border:none; text-align:center;">
                <img
                    src="{{ public_path('images/logo.png') }}"
                    width="90">
            </td>

            <td width="85%" style="border:none; text-align:center;">

                <div style="font-size:16px; font-weight:bold;">
                    PEMERINTAH KABUPATEN JOMBANG
                </div>

                <div style="font-size:24px; font-weight:bold;">
                    DINAS KOMUNIKASI DAN INFORMATIKA
                </div>

                <div style="font-size:12px;">
                    Jalan Bupati R. Soedirman Nomor 92 Jombang 61419
                </div>

                <div style="font-size:12px;">
                    Telepon (0321) 879913, Faksimile (0321) 879913
                </div>

                <div style="font-size:12px;">
                    Laman kominfo.jombangkab.go.id
                    | Pos-el kominfo@jombangkab.go.id
                </div>

            </td>

        </tr>

    </table>

    <hr style="border:1.5px solid black;">

    <!-- JUDUL -->
    <h2 align="center">
        LAPORAN PEGAWAI TELADAN
    </h2>

    <br>

    <!-- DATA PEGAWAI -->
    <table style="width:70%; border:none;">

        <tr>
            <td style="border:none; width:180px;">Nama</td>
            <td style="border:none;">: {{ $pegawaiTerbaik->nama }}</td>
        </tr>

        <tr>
            <td style="border:none;">NIP</td>
            <td style="border:none;">: {{ $pegawaiTerbaik->nip }}</td>
        </tr>

        <tr>
            <td style="border:none;">Bidang</td>
            <td style="border:none;">: {{ $pegawaiTerbaik->bidang }}</td>
        </tr>

        <tr>
            <td style="border:none;">Jabatan</td>
            <td style="border:none;">: {{ $pegawaiTerbaik->jabatan }}</td>
        </tr>

        <tr>
            <td style="border:none;">Total Nilai MFEP</td>
            <td style="border:none;">
                : <b>{{ $pegawaiTerbaik->total_nilai }}</b>
            </td>
        </tr>

    </table>

    <br><br><br><br>

    <!-- TANDA TANGAN -->
    <table width="100%" style="border:none;">

        <tr>

            <td width="55%" style="border:none;"></td>

            <td width="45%" style="border:none; text-align:center;">

                Jombang, {{ date('d F Y') }}

                <br>

                Kepala Dinas Komunikasi dan Informatika

                <br><br>

                <img
                    src="{{ public_path('images/ttd.png') }}"
                    width="110">

                <br>

                <b>Endro Wahyudi, S.STP</b>

                <br>

                NIP. 19809999999999999

            </td>

        </tr>

    </table>

</body>