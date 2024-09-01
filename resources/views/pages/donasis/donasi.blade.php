@extends('layouts.app')

@section('title', 'Donasi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Donasi</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Donasi</h2>
            <p class="section-lead">
                Anda Bisa Melihat Atau Mengedit Data Donasi.
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Donasi</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-left hidden-section">
                                <select class="form-control selectric">
                                    <option>Action For Selected</option>
                                    <option>Move to Draft</option>
                                    <option>Move to Pending</option>
                                    <option>Delete Pemanently</option>
                                </select>
                            </div>
                            <div class="float-right">
                                <form method="GET" action="{{ route('donasis.donasi') }}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>User Id</th>
                                        <th>Nama</th>
                                        <th>Nomor Hp</th>
                                        <th>Alamat</th>
                                        <th>Foto Makanan</th>
                                        <th>Jenis Makanan</th>
                                        <th>Berat Makanan</th>
                                        <th>Poin Transaksi</th>
                                        <th>Deskripsi</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($donasis as $donate)
                                    <tr>
                                        <td>{{ $donate->user_id }}</td>
                                        <td>{{ $donate->nama }}</td>
                                        <td>{{ $donate->no_hp }}</td>
                                        <td>{{ $donate->alamat }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$donate->foto_makanan) }}" class=" " width="100" height="130">
                                        </td>
                                        <td>{{ $donate->jenis_makanan }}</td>
                                        <td>{{ $donate->berat_makanan }}kg</td>
                                        <td>{{ $donate->poin_transaksi }}</td>
                                        <td>{{ $donate->deskripsi }}</td>
                                        <td>{{ $donate->created_at }}</td>
                                        <td>
                                            <a href="#" class="badge btn badge-edit edit-donasi-link my-1"
                                                data-toggle="modal" data-target="#editDonasismodal"
                                                data-donate-id="{{ $donate->id }}" title="edit">
                                                <span>Edit</span>
                                            </a>
                                            <a href="#" class="badge btn badge-secondary edit-donasi-link my-1"
                                                data-toggle="modal" data-target="#verifDonasismodal"
                                                data-donate-id="{{ $donate->id }}" title="edit">
                                                <span>Verifikasi</span>
                                            </a>
                                            <a href="#" class="badge btn badge-danger tolak-donasi-link my-1"
                                                data-toggle="modal" data-target="#verifDonasismodal"
                                                data-donate-id="{{ $donate->id }}" title="edit">
                                                <span>Tolak</span>
                                            </a>

                                        </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


{{-- Edit Donasi Modal --}}

 <div id="editDonasismodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editDonasismodalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="formDonasiEdit" action="{{ route('donasis.update', ':binId')}}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editDonasismodalTitle">Edit Donasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="berat_makanan">Berat Makanan</label>
                        <input type="text" class="form-control" id="format_berat" name="format_berat" value="" required oninput="formatBerat(this)">
                        <input type="hidden" id="berat_makanan" name="berat_makanan">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="poin_transaksi">Poin Transaksi</label>
                        <input type="text" class="form-control" id="poin_transaksi" name="poin_transaksi" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea  class="form-control" id="deskripsi" cols="30" rows="10" name="deskripsi" value=""crequired></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cencel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- Verifikasi Donasi Modal --}}
 <div id="verifDonasismodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="verifDonasismodalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="proses-donasi-verifikasi-form" action="" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editusersmodalTitle">Verifikasi Donasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="status" name="status" value=terverifikasi>
                        <div class="form-group d-hidden" id="alertVerivikasi">
                            <p>Apakah anda yakin ingin menyetujui pengajuan donasi ini?</p>
                        </div>
                        <div class="form-group d-hidden" id="alertTolak">
                            <p>Apakah anda yakin ingin menolak pengajuan donasi ini?</p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>

<script>
    function formatBerat(input) {
        let value = input.value;
        value = value.replace(/\D/g, '');
        value = new Intl.NumberFormat('id-ID').format(value);
        input.value = value + ' kg';
        document.getElementById('berat_makanan').value = value.replace(/\./g, '');
    }
    $('.edit-donasi-link').on('click', function() {
            var binId = $(this).data('donate-id');
            $.ajax({
                url: '/donasi/' + binId + '/edit',
                type: 'GET',
                success: function(response) {
                    var data = response.donasi;
                    console.log(response);

                    var formAction = '/donasi/' + binId + '/update';
                    $('#formDonasiEdit').attr('action', formAction);
                    $('#editDonasismodal #berat_makanan').val(data.berat_makanan);
                    value = new Intl.NumberFormat('id-ID').format(data.berat_makanan);
                    $('#editDonasismodal #format_berat').val(value + ' kg');
                    $('#editDonasismodal #poin_transaksi').val(data.poin_transaksi);
                },
                error: function(error) {
                    console.error('Error fetching user data: ', error);
                }
            })

    })

    $('.edit-donasi-link').on('click', function() {
            var binId = $(this).data('donate-id');
            var formAction = '/proses_donasi/' + binId ;
            $('#proses-donasi-verifikasi-form').attr('action', formAction);
            $('#proses-donasi-verifikasi-form #status').val('Terverifikasi');
            $('#proses-donasi-verifikasi-form #editusersmodalTitle').html('Verifikasi Donasi');
            $('#proses-donasi-verifikasi-form #deskripsiDonasi').show()
            $('#proses-donasi-verifikasi-form #alertTolak').hide()
            $('#proses-donasi-verifikasi-form #inputDeskripsi').attr('required',true)

        });
        $('.tolak-donasi-link').on('click', function() {
            var binId = $(this).data('donate-id');
            var formAction = '/proses_donasi/' + binId ;
            $('#proses-donasi-verifikasi-form').attr('action', formAction);
            $('#proses-donasi-verifikasi-form #status').val('Ditolak');
            $('#proses-donasi-verifikasi-form #editusersmodalTitle').html('Tolak Donasi');
            $('#proses-donasi-verifikasi-form #deskripsiDonasi').hide()
            $('#proses-donasi-verifikasi-form #alertTolak').show()
            $('#proses-donasi-verifikasi-form #inputDeskripsi').attr('required',false)

        });
</script>
@endpush
