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
            font-size: 10px
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

<body class="A4 landscape">

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
                        REKAP PRESENSI KARYAWAN
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

        <table class="tabelpresensi">
            <tr>
                <th rowspan="2">NIS</th>
                <th rowspan="2">Nama Karyawan</th>
                <th colspan="31">Tanggal</th>
                <th rowspan="2">TH</th>
                <th rowspan="2">TT</th>
            </tr>
            <tr>
                <?php 
                    for($i=1; $i<=31; $i++){
                ?>
                <th>{{ $i }}</th>
                <?php
                    }
                ?>
            </tr>
            <tr>
                @foreach ($rekap as $d)
            <tr>
                <td>{{ $d->nis }}</td>
                <td>{{ $d->nama_lengkap }}</td>

                <?php 
                    $totalhadir = 0;
                    $totalterlambat = 0;
                    for($i=1; $i<=31; $i++){
                        $tgl = "tgl_" . $i;
                        if(empty($d->$tgl)){
                            $hadir = ['', ''];
                            $totalhadir += 0;
                        } else {
                        $hadir = explode("-", $d->$tgl);
                        $totalhadir += 1;
                        if($hadir[0] > $d->jam_masuk){
                            $totalterlambat += 1;
                        }
                    }
                ?>

                <td>
                    <span style="color: {{ $hadir[0] > $d->jam_masuk ? 'red' : '' }}">
                        {{ !empty($hadir[0]) ? $hadir[0] : '-' }}
                    </span>
                    <br>
                    <span style="color: {{ $hadir[1] < $d->jam_pulang ? 'red' : '' }}">
                        {{ !empty($hadir[1]) ? $hadir[1] : '-' }}
                    </span>
                </td>

                <?php
                    }
                ?>

                <td>
                    {{ $totalhadir }}
                </td>
                <td>
                    {{ $totalterlambat }}
                </td>
            </tr>
            @endforeach
            </tr>
        </table>

        <table width="100%" style="margin-top: 100px">
            <tr>
                <td></td>
                <td style="text-align: center;">Jakarta, {{ date('d-m-Y') }}</td>
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
