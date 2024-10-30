<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold
        }

        .tabeldatakaryawan {
            margin-top: 40px;

        }

        .tabeldatakaryawan tr td {
            padding: 5px
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tabelpresensi tr th {
            border: 1px solid black;
            padding: 8px;
            background: #dbdbdb;
        }

        .tabelpresensi tr td {
            border: 1px solid black;
            padding: 5px;
            font-size: 12px;
        }

        .foto {
            width: 40px;
            height: 30px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

    <?php
    function selisih($jam_masuk, $jam_keluar)
    {
        // Memecah waktu jam_masuk dan jam_keluar menjadi jam, menit, dan detik
        [$h_masuk, $m_masuk, $s_masuk] = explode(':', $jam_masuk);
        [$h_keluar, $m_keluar, $s_keluar] = explode(':', $jam_keluar);
    
        // Mengonversi jam masuk dan keluar menjadi detik dari awal hari yang sama
        $detik_masuk = mktime($h_masuk, $m_masuk, $s_masuk, 1, 1, 1970);
        $detik_keluar = mktime($h_keluar, $m_keluar, $s_keluar, 1, 1, 1970);
    
        // Menghitung selisih dalam detik
        $detik_selisih = $detik_keluar - $detik_masuk;
        $total_menit = $detik_selisih / 60;
    
        // Mendapatkan jam dan menit dari total menit
        $jam = floor($total_menit / 60);
        $menit = $total_menit % 60;
    
        return sprintf('%02d:%02d', $jam, round($menit));
    }
    ?>

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <table style="width: 100%">
            <tr>
                <td style="width: 30px">
                    <img src="{{ asset('assets/img/logopresensi.png') }}" width="100" height="100" alt="">
                </td>
                <td>
                    <span id="title">
                        LAPORAN PRESENSI KARYAWAN
                        <br>
                        PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}
                        <br>
                        PT. CODE'Z COMPANY
                        <br>
                    </span>
                    <span><i>Jln. Ir. H. Soekarno, Jakarta</i></span>
                </td>
            </tr>
        </table>
        <table class="tabeldatakaryawan">
            <tr>
                <td rowspan="6">
                    @php
                        $path = Storage::url('uploads/karyawan/' . $karyawan->foto);
                    @endphp
                    <img src="{{ url($path) }}" alt="" width="120px" height="150">
                </td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td>{{ $karyawan->nis }}</td>
            </tr>
            <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td>{{ $karyawan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $karyawan->jabatan }}</td>
            </tr>
            <tr>
                <td>Departemen</td>
                <td>:</td>
                <td>{{ $karyawan->nama_dept }}</td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>:</td>
                <td>{{ $karyawan->no_hp }}</td>
            </tr>
        </table>
        <table class="tabelpresensi">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Foto</th>
                <th>Jam Pulang</th>
                <th>Foto</th>
                <th>Keterangan</th>
                <th>Jml Jam</th>
            </tr>
            @foreach ($presensi as $d)
                @php
                    $path_in = Storage::url('uploads/absensi/' . $d->foto_in);
                    $path_out = Storage::url('uploads/absensi/' . $d->foto_out);
                    $jam_terlambat = selisih('07:00:00', $d->jam_in);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</td>
                    <td>{{ $d->jam_in }}</td>
                    <td><img src="{{ url($path_in) }}" alt="" class="foto"></td>
                    <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Absen' }}</td>
                    <td>
                        @if ($d->jam_out != null)
                            <img src="{{ url($path_out) }}" alt="" class="foto">
                        @else
                            <img src="{{ asset('assets/img/camera.jpg') }}" alt="" class="foto">
                        @endif
                    </td>
                    <td>
                        @if ($d->jam_in > '07:00')
                            Terlambat {{ $jam_terlambat }}
                        @else
                            Tepat Waktu
                        @endif
                    </td>
                    <td>
                        @if ($d->jam_out != null)
                            @php
                                $jmljamkerja = selisih($d->jam_in, $d->jam_out);
                            @endphp
                        @else
                            @php
                                $jmljamkerja = 0;
                            @endphp
                        @endif
                        {{ $jmljamkerja }}
                    </td>
                </tr>
            @endforeach
        </table>

        <table width="100%" style="margin-top: 100px">
            <tr>
                <td colspan="2" style="text-align: right;">Jakarta, {{ date("d-m-Y") }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: bottom;" height="100px">
                    <u>Mika Widi Kirana</u>
                    <br>
                    <i><b>HRD Manager</b></i>
                </td>
                <td style="text-align: center; vertical-align: bottom;" height="100px">
                    <u>Aditya Agustin</u>
                    <br>
                    <i><b>Direktur Utama</b></i>
                </td>
            </tr>
        </table>
    </section>

</body>

</html>
