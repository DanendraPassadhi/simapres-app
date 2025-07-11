@empty($pendaftar)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-exclamation-circle mr-2"></i>Kesalahan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-4">
                    <i class="fas fa-exclamation-triangle fa-4x text-danger mb-3"></i>
                    <h4 class="text-danger font-weight-bold">Data Tidak Ditemukan</h4>
                    <p class="text-muted">Data pendaftaran lomba yang anda cari tidak ditemukan dalam sistem</p>
                </div>
                <a href="{{ route('pendaftaranLomba.index') }}" class="btn btn-outline-danger btn-lg px-5">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 10px;">
            <div class="modal-header bg-primary text-white" style="border-radius: 8px 8px 0 0;">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fas fa-info-circle mr-2"></i>Detail Pendaftaran Lomba
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="fas fa-user-graduate mr-2"></i>Data Mahasiswa</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center pb-2 bg-light p-3 rounded">
                                    <span class="text-muted"><i class="fas fa-hashtag mr-2"></i>NIM</span>
                                    <span
                                        class="font-weight-bold text-primary">{{ $pendaftar->user->detailUser->no_induk ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pb-2 bg-white p-3 rounded">
                                    <span class="text-muted"><i class="fas fa-user mr-2"></i>Nama</span>
                                    <span
                                        class="font-weight-bold text-dark">{{ $pendaftar->user->detailUser->name ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pb-2 bg-light p-3 rounded">
                                    <span class="text-muted"><i class="fas fa-graduation-cap mr-2"></i>Program Studi</span>
                                    <span class="font-weight-bold text-dark">
                                        @php
                                            $prodi = $pendaftar->user->detailUser->prodi ?? null;
                                            echo $prodi ? $prodi->name : '-';
                                        @endphp
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="fas fa-trophy mr-2"></i>Data Lomba</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center pb-2 bg-light p-3 rounded">
                                    <span class="text-muted"><i class="fas fa-trophy mr-2"></i>Nama Lomba</span>
                                    <span class="font-weight-bold text-dark">{{ $pendaftar->lomba->judul ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pb-2 bg-white p-3 rounded">
                                    <span class="text-muted"><i class="fas fa-building mr-2"></i>Penyelenggara</span>
                                    <span
                                        class="font-weight-bold text-dark">{{ $pendaftar->lomba->penyelenggara ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pb-2 bg-light p-3 rounded">
                                    <span class="text-muted"><i class="fas fa-tag mr-2"></i>Kategori</span>
                                    <span class="font-weight-bold text-dark">{{ $pendaftar->lomba->kategori ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pb-2 bg-white p-3 rounded">
                                    <span class="text-muted"><i class="fas fa-calendar mr-2"></i>Tanggal Daftar</span>
                                    <span class="font-weight-bold text-dark">{{ $pendaftar->tanggal_daftar ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pb-2 bg-light p-3 rounded">
                                    <span class="text-muted"><i class="fas fa-file-alt mr-2"></i>Deskripsi</span>
                                    <span class="font-weight-bold text-dark"
                                        style="max-width: 70%;">{{ $pendaftar->lomba->deskripsi ?? '-' }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded">
                                    <span class="text-muted"><i class="fas fa-check-circle mr-2"></i>Status
                                        Pendaftaran</span>
                                    <span class="font-weight-bold text-dark">
                                        @if ($pendaftar->status == 'accepted')
                                            <span class="badge badge-success">Disetujui</span>
                                        @elseif($pendaftar->status == 'rejected')
                                            <span class="badge badge-danger">Ditolak</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        @php
                            $bimbingan = optional(optional($pendaftar->user)->mahasiswa)->first();
                            $dosen = optional($bimbingan)->dosen;
                            $detailDosen = optional($dosen)->detailUser;
                        @endphp
                        @if ($bimbingan && $dosen && $detailDosen)
                            <div class="card mb-3">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0"><i class="fas fa-user-graduate mr-2"></i>Data Dosen Pembimbing</h6>
                                </div>
                                <div class="card-body">
                                    <div
                                        class="d-flex justify-content-between align-items-center pb-2 bg-light p-3 rounded">
                                        <span class="text-muted"><i class="fas fa-hashtag mr-2"></i>NIP</span>
                                        <span class="font-weight-bold text-primary">
                                            {{ $detailDosen->no_induk ?? '-' }}
                                        </span>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-center pb-2 bg-white p-3 rounded">
                                        <span class="text-muted"><i class="fas fa-user mr-2"></i>Nama</span>
                                        <span class="font-weight-bold text-dark">
                                            {{ $detailDosen->name ?? '-' }}
                                        </span>
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-center pb-2 bg-light p-3 rounded">
                                        <span class="text-muted"><i class="fas fa-graduation-cap mr-2"></i>Program
                                            Studi</span>
                                        <span class="font-weight-bold text-dark">
                                            {{ optional($detailDosen->prodi)->name ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card mb-3">
                                <div class="card-header bg-warning text-dark">
                                    <h6 class="mb-0"><i class="fas fa-user-graduate mr-2"></i>Pilih Dosen Pembimbing
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form id="dospemForm" action="{{ route('pendaftaranLomba.update', $pendaftar->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="dosen_id">Dosen Pembimbing</label>
                                            <select name="dosen_id" id="dosen_id" class="form-control" required>
                                                <option value="">-- Pilih Dosen --</option>
                                                @foreach ($daftarDosen as $dsn)
                                                    <option value="{{ $dsn->id }}">
                                                        {{ $dsn->detailUser->name ?? $dsn->email }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="btn btn-primary">Simpan Dosen Pembimbing</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dospemForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var method = form.find('input[name="_method"]').val() || 'POST';
                $.ajax({
                    url: url,
                    type: method,
                    data: form.serialize(),
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                window.location.href =
                                    '{{ route('pendaftaranLomba.index') }}';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message || 'Terjadi kesalahan!'
                            });
                        }
                    },
                    error: function(xhr) {
                        let msg = 'Terjadi kesalahan!';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.msgField) {
                            msg = Object.values(xhr.responseJSON.msgField).join(' ');
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: msg
                        });
                    }
                });
            });
        });
    </script>
@endempty
