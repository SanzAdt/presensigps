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

@foreach ($presensi as $d)
    @php
        $foto_in = Storage::url('uploads/absensi/' . $d->foto_in);
        $foto_out = Storage::url('uploads/absensi/' . $d->foto_out);
    @endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nis }}</td>
        <td>{{ $d->nama_lengkap }}</td>
        <td>{{ $d->kode_dept }}</td>
        <td>{{ $d->nama_jam_kerja }} ({{ $d->jam_masuk }} s/d {{ $d->jam_pulang }})</td>
        <td>{{ $d->jam_in }}</td>
        <td>
            <img src="{{ url($foto_in) }}" alt="" class="avatar">
        </td>
        <td>
            {!! $d->jam_out ? $d->jam_out : '<span class="badge bg-danger text-white">Belum Absen</span>' !!}
        </td>
        <td>
            @if ($d->jam_out)
                <img src="{{ url($foto_out) }}" alt="" class="avatar">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icon-tabler-hourglass-high">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6.5 7h11" />
                    <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" />
                    <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" />
                </svg>
            @endif
        </td>
        <td>
            @if ($d->jam_in >= $d->jam_masuk)
                @php
                    $jam_terlambat = selisih($d->jam_masuk, $d->jam_in);
                @endphp
                <span class="badge bg-danger text-white">Terlambat {{ $jam_terlambat }}</span>
            @else
                <span class="badge bg-success text-white">Tepat Waktu</span>
            @endif
        </td>
        <td>
            <a href="#" class="btn btn-primary tampilkanpeta" id="{{ $d->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-map-2">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" />
                    <path d="M9 4v13" />
                    <path d="M15 7v5.5" />
                    <path
                        d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                    <path d="M19 18v.01" />
                </svg>
            </a>
        </td>
    </tr>
@endforeach

<script>
    $(function() {
        $(".tampilkanpeta").click(function(e) {
            var id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: '/tampilkanpeta',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                cache: false,
                success: function(respond) {
                    $("#loadmap").html(respond);
                }
            });
            $("#modal-tampilkanpeta").modal("show");
        });
    });
</script>
