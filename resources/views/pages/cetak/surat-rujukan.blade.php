<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Surat Rujukan - Klinik Riska Yeni</title>
    <style>
        .title h1,
        .title h2,
        .title h3 {
            font-family: 'Times New Roman', sans-serif;
            font-weight: bold;
            color: #000;
            text-align: center;
            margin: 0;
            /* Menghapus margin default */
        }

        .title h1 {
            font-size: 20px;
            margin-top: 10px;
        }

        .title h2 {
            font-size: 20px;
            /* margin-top: -10px; */
            /* Mengurangi spasi antara elemen */
        }

        .title h3 {
            font-size: 20px;
            /* margin-top: -10px; */
        }

        img {
            margin-top: -10px;
        }

        .subtitle {
            text-align: center;
            font-size: 14px;
            margin: 0;
        }

        .kop-border {
            width: 100%;
            border: 2px solid black;
            border-radius: 5px;
            margin-top: -10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-keterangan td {
            padding: 3px 5px;
            /* Menambahkan padding agar tampak rapi */
        }

        .header-keterangan td:first-child {
            width: 80px;
            /* Lebar kolom pertama agar sejajar */
        }
    </style>
</head>

<body style="margin-top: 30px;margin-bottom: 20px; margin-right: 20px;margin-left: 30px;">
    <table>
        <tr>
            <td class="logo" rowspan="2" style="width: 20%; text-align: center;">
                <img src="{{ $pic_upt }}" style="max-height: 95px" alt="">
            </td>
            <td class="title" style="width: 100%; text-align: center;">
                <h1><b>PEMERINTAHAN KABUPATEN KAMPAR</b></h1>
                <h2><b>DINAS KESEHATAN</b></h2>
                <h3><b>UPT PUSKESMAS PANGKALAN BARU</b></h3>
            </td>
            <td class="logo" rowspan="2" style="width: 20%; text-align: center;">
                <img src="{{ $pic_kesehatan }}" style="max-height: 95px" alt="">
            </td>
        </tr>
        <tr>
            <td>
                <p class="subtitle">
                    Jln. Raya Pangkalan Baru Desa Pangkalan Baru Kode Pos 28452
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr class="kop-border">
            </td>
        </tr>
    </table>

    <section class="section-top" style="margin: 30px; margin-top: -30px" style="text-align: justify">

        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <!-- Kolom Kiri untuk Nomor, Lampiran, Perihal -->
                <td style="vertical-align: top; width: 60%; padding-left: 50px;">
                    <table class="header-keterangan" style="width: 100%;">
                        <tr>
                            <td style="width: auto; vertical-align: top;">Nomor</td>
                            <td style="width: 10px; vertical-align: top;">:</td>
                            <td style="vertical-align: top;">445/PuskPB/Yankes-1/{{ date('Y') }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Lampiran</td>
                            <td style="vertical-align: top;">:</td>
                            <td style="vertical-align: top;">-</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Perihal</td>
                            <td style="vertical-align: top;">:</td>
                            <td style="vertical-align: top;">Rujukan Manual</td>
                        </tr>
                    </table>
                </td>

                <!-- Kolom Kanan untuk Kepada -->
                <td style="vertical-align: top; width: 40%; padding-left: 50px;">
                    <p style="margin-top: -2px; line-height: 30px">
                        Kepada <br />
                        Yth. <span style="text-transform: capitalize;">Direktur Rumah Sakit</span> <br />
                        di. - <br />
                        <u>Pekan Baru</u>
                    </p>
                </td>
            </tr>
        </table>

        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <td style="padding-left: 50px;">
                    <p style="margin-top: -2px;">
                        Dengan hormat, <br />
                        Bersama ini kami kirimkan pasien:
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 80px;">
                    <table class="header-keterangan" style="width: 100%;">
                        <tr>
                            <td style="width: 150px; vertical-align: top;">Nama</td>
                            <td style="width: 10px; vertical-align: top;">:</td>
                            <td>{{ $pasien->user->name }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Umur</td>
                            <td style="vertical-align: top;">:</td>
                            <td>
                                {{ Carbon\Carbon::parse($pasien->user->tanggal_lahir)->age }} Tahun
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">NIK</td>
                            <td style="vertical-align: top;">:</td>
                            <td>
                                {{ $pasien->user->nik_pasien }}
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">BPJS</td>
                            <td style="vertical-align: top;">:</td>
                            <td>
                                {{ $pasien->user->no_bpjs ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Jenis Kelamin</td>
                            <td style="vertical-align: top;">:</td>
                            <td>
                                {{ $pasien->user->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Alamat</td>
                            <td style="vertical-align: top;">:</td>
                            <td>
                                {{ $pasien->user->alamat_pasien }}
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Anamnesa</td>
                            <td style="vertical-align: top;">:</td>
                            <td style="word-wrap: break-word;">
                                {{ $rekam_medis->anamnesa }}
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Diagnosa</td>
                            <td style="vertical-align: top;">:</td>
                            <td style="word-wrap: break-word;">
                                {{ $rekam_medis->diagnosa }}
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Therapy</td>
                            <td style="vertical-align: top;">:</td>
                            <td>
                                {{ $rekam_medis->theraphy }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 50px;">
                    <p style="margin-top: 10px;">
                        Mohon pemeriksaan, pengobatan, dan perawatan lebih lanjut.
                    </p>
                </td>
            </tr>
        </table>

        <!-- Tabel untuk informasi tanda tangan dokter -->
        <table style="width: 100%; margin-top: 10px;">
            <tr>
                <!-- Kolom Kiri Kosong untuk mengatur posisi tanda tangan di kanan -->
                <td style="width: 50%;"></td>

                <!-- Kolom Kanan untuk Tanda Tangan -->
                <td style="width: 50%; text-align: start;">
                    <p>
                        Pangkalan Baru, {{ Carbon\Carbon::now()->isoFormat('D MMMM Y') }} <br />
                        Dokter yang Memeriksa
                    </p>
                    <p style="margin-top: 70px;">
                        <b><u>dr. Riska Yeni</u></b> <br>
                        NIP. 1234567890123456
                    </p>
                </td>
            </tr>
        </table>

    </section>

    </div>
</body>

</html>