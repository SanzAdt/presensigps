<form action="/cabang/update" method="POST" id="frmCabangEdit">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-barcode">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                        <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                        <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                        <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                        <path d="M5 11h1v2h-1z" />
                        <path d="M10 11l0 2" />
                        <path d="M14 11h1v2h-1z" />
                        <path d="M19 11l0 2" />
                    </svg>
                </span>
                <input type="text" value="{{ $cabang->kode_cabang }}" class="form-control" id="kode_cabang"
                    name="kode_cabang" placeholder="Kode Cabang" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </span>
                <input type="text" value="{{ $cabang->nama_cabang }}" class="form-control" name="nama_cabang"
                    id="nama_cabang" placeholder="Nama Cabang">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin-check">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        <path d="M11.87 21.48a1.992 1.992 0 0 1 -1.283 -.58l-4.244 -4.243a8 8 0 1 1 13.355 -3.474" />
                        <path d="M15 19l2 2l4 -4" />
                    </svg>
                </span>
                <input type="text" value="{{ $cabang->lokasi_cabang }}" class="form-control" name="lokasi_cabang"
                    id="lokasi_cabang" placeholder="Lokasi Cabang">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-radar-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44" />
                        <path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14" />
                        <path d="M12 12v9" />
                    </svg>
                </span>
                <input type="text" value="{{ $cabang->radius_cabang }}" class="form-control" name="radius_cabang"
                    id="radius_cabang" placeholder="Radius Cabang">
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 14l11 -11" />
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                    </svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    $("#frmCabangEdit").submit(function() {
        var kode_cabang = $("#frmCabangEdit").find("#kode_cabang").val();
        var nama_cabang = $("#frmCabangEdit").find("#nama_cabang").val();
        var lokasi_cabang = $("#frmCabangEdit").find("#lokasi_cabang").val();
        var radius_cabang = $("#frmCabangEdit").find("#radius_cabang").val();


        if (kode_cabang == "") {
            // alert("Kode Cabang Harus Di Isi");
            Swal.fire({
                title: 'Warning!',
                text: 'Kode Cabang Harus Di Isi !',
                icon: 'warning',
                confirmButtonText: 'Ok'
            }).then((result) => {
                $("#kode_cabang").focus();
            })
            return false;
        } else if (nama_cabang == "") {
            // alert("Nama Cabang Harus Di Isi");
            Swal.fire({
                title: 'Warning!',
                text: 'Nama Cabang Harus Di Isi !',
                icon: 'warning',
                confirmButtonText: 'Ok'
            }).then((result) => {
                $("#nama_cabang").focus();
            })
            return false;
        } else if (lokasi_cabang == "") {
            // alert("Lokasi Cabang Harus Di Isi");
            Swal.fire({
                title: 'Warning!',
                text: 'Lokasi Cabang Harus Di Isi !',
                icon: 'warning',
                confirmButtonText: 'Ok'
            }).then((result) => {
                $("#lokasi_cabang").focus();
            })
            return false;
        } else if (radius_cabang == "") {
            // alert("Radius Cabang Harus Di Isi");
            Swal.fire({
                title: 'Warning!',
                text: 'Radius Cabang Harus Di Isi !',
                icon: 'warning',
                confirmButtonText: 'Ok'
            }).then((result) => {
                $("#radius_cabang").focus();
            })
            return false;
        }
    })
</script>
