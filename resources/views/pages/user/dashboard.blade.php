@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="row row-sm mg-b-20">
    <div class="col-lg-12 ht-lg-100p">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-xxl-6 col-xl-6 col-sm-12">
                        <div
                            class="card bg-success bg-opacity-10 border-success border-opacity-10 rounded-3 mb-4 stats-box style-three">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-19">
                                    <div class="flex-shrink-0">
                                        <i class="material-symbols-outlined fs-40 text-success">assignment_turned_in</i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <span>Layanan</span>
                                        <h3 class="fs-20 mt-1 mb-0">
                                            {{ $layanan }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between flex-wrap gap-2 align-items-center">
                                    <span class="fs-12">Layanan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-sm-12">
                        <div
                            class="card bg-success bg-opacity-10 border-success border-opacity-10 rounded-3 mb-4 stats-box style-three">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-19">
                                    <div class="flex-shrink-0">
                                        <i class="material-symbols-outlined fs-40 text-success">assignment_turned_in</i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <span>Nomor Antrian Anda</span>
                                        <h3 class="fs-20 mt-1 mb-0">
                                            {{ $noAntrianSaya ?? 'Belum Ada' }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between flex-wrap gap-2 align-items-center">
                                    <span class="fs-12">Nomor Antrian</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-sm-12">
                        <div class="card bg-success bg-opacity-10 border-success border-opacity-10 rounded-3 mb-4 stats-box style-three">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-19">
                                    <div class="flex-shrink-0">
                                        <i class="material-symbols-outlined fs-40 text-success">assignment_turned_in</i>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <span>Nomor Antrian Dipanggil</span>
                                        <h3 class="fs-20 mt-1 mb-0" id="antrianDipanggil">
                                            {{ $no_antrian_dipanggil ?? 'Belum Ada' }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between flex-wrap gap-2 align-items-center">
                                    <span class="fs-12">Nomor Antrian Dipanggil</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
{{-- <script src="https://cdn.socket.io/4.6.1/socket.io.min.js"></script>
<script>
    const socket = io("http://localhost:6001");

    // Cek koneksi ke server
    socket.on("connect", () => {
        console.log("Connected to Socket.IO server:", socket.id);
    });

    // Mendengarkan event refresh:antrian
    socket.on("refresh:antrian", (data) => {
        console.log("Event received from Socket.IO:", data);

        // Perbarui UI
        const antrianDipanggil = document.getElementById("antrianDipanggil");
        if (antrianDipanggil) {
            antrianDipanggil.innerText = data.no_antrian;
        }
    });
</script> --}}

<script src="https://cdn.socket.io/4.6.1/socket.io.min.js"></script>
<script>
    const socket = io("http://localhost:6001");

    // Cek koneksi ke server
    socket.on("connect", () => {
        console.log("Connected to Socket.IO server:", socket.id);
    });

    // Mendengarkan event refresh:antrian
    socket.on("refresh:antrian", (data) => {
        console.log("Event received from Socket.IO:", data);

        // Update UI berdasarkan status
        const antrianDipanggil = document.getElementById("antrianDipanggil");
        if (data.status === 'dilewati') {
            // Logika khusus untuk status dilewati
            antrianDipanggil.innerText = `Nomor ${data.no_antrian} - dilewati`;
        }

        // Update elemen UI (jika relevan)
        if (antrianDipanggil) {
            antrianDipanggil.innerText = `Nomor ${data.no_antrian} - ${data.status}`;
        }
    });
</script>
@endpush