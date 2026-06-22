<body>

```
<!-- KOP SURAT -->
<table width="100%" style="border:none;">

    <tr>

        <td width="15%" style="border:none; text-align:center;">
            <img src="{{ public_path('images/logo.png') }}" width="90">
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

<h2 align="center">
    LAPORAN HASIL PERANKINGAN PEGAWAI
</h2>

<p align="center">
    Metode Multi Factor Evaluation Process (MFEP)
</p>

<br>

<table width="100%" cellpadding="8" cellspacing="0" border="1">

    <thead style="background:#dbeafe;">

        <tr>
            <th>Ranking</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Bidang</th>
            <th>Jabatan</th>
            <th>Total Nilai</th>
        </tr>

    </thead>

    <tbody>

        @foreach($employees as $employee)

        <tr>

            <td align="center">
                {{ $loop->iteration }}
            </td>

            <td>
                {{ $employee->nip }}
            </td>

            <td>
                {{ $employee->nama }}
            </td>

            <td>
                {{ $employee->bidang }}
            </td>

            <td>
                {{ $employee->jabatan }}
            </td>

            <td align="center">
                {{ $employee->total_nilai }}
            </td>

        </tr>

        @endforeach

    </tbody>

</table>

<br><br><br>

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
```

</body>
