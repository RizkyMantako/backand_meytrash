@extends('layouts.app')

@section('title', 'Sampah')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Sampah</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Sampah</h2>
            <p class="section-lead">
                Anda Bisa Melihat Atau Mengedit Data Sampah.
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Sampah</h4>
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
                                <form method="GET" action="{{ route('sampah.sampah') }}">
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
                                        <th>Foto Sampah</th>
                                        <th>Deskripsi</th>
                                        <th>Berat Sampah</th>
                                        <th>Poin Transaksi</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($sampahs as $bin)
                                    <tr>
                                        <td>{{ $bin->user_id }}</td>
                                        <td>{{ $bin->nama }}</td>
                                        <td>{{ $bin->no_hp }}</td>
                                        <td>{{ $bin->alamat }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$bin->foto_sampah) }}" class=" " width="100" height="130">
                                        </td>
                                        <td>{{ $bin->deskripsi }}</td>
                                        <td>{{ $bin->berat_sampah }}kg</td>
                                        <td>{{ $bin->poin_transaksi }}</td>
                                        <td>{{ $bin->created_at }}</td>
                                        <td>
                                            <a href="#" class="badge btn badge-primary edit-bin-link my-1"
                                                data-toggle="modal" data-target="#editSampahsmodal"
                                                data-bin-id="{{ $bin->id }}" title="edit">
                                                <span>Edit</span>
                                            </a>
                                            <a href="#" class="badge btn badge-primary edit-bin-link my-1"
                                                data-toggle="modal" data-target="#verifSampahsmodal"
                                                data-bin-id="{{ $bin->id }}" title="edit">
                                                <span>Verifikasi</span>
                                            </a>
                                            <a href="#" class="badge btn badge-primary tolak-bin-link my-1"
                                                data-toggle="modal" data-target="#verifSampahsmodal"
                                                data-bin-id="{{ $bin->id }}" title="edit">
                                                <span>Tolak</span>
                                            </a>

                                        </td>
                                        @endforeach
                                    </tr>
                                </table>
                            </div>
                            <div class="float-right">
                                {{$sampahs->withQueryString()->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{-- Edit Sampah Modal --}}
    <div id="editSampahsmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editSampahsmodalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
               <form method="POST" id="formSampahEdit" action="{{ route('sampah.update', ':binId')}}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editSampahsmodalTitle">Edit Sampah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                       <label for="berat_sampah">Berat Sampah</label>
                      <input type="text" class="form-control" id="berat_format" name="berat_format" value="" required oninput="formatBerat(this)">
                      <input type="hidden" id="berat_sampah" name="berat_sampah">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="poin_transaksi">Poin Transaksi</label>
                        <input type="text" class="form-control" id="poin_transaksi" name="poin_transaksi" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" name="deskripsi" cols="30" rows="10" value="" required></textarea>
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


{{-- Verifikasi Sampah Modal --}}
    <div id="verifSampahsmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="verifSampahsmodalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="proses-sampah-verifikasi-form" action="" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editusersmodalTitle">Verifikasi Sampah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="status" name="status" value=terverifikasi>
                        <div class="form-group d-hidden" id="alertVerivikasi">
                            <p>Apakah anda yakin ingin menyetujui pengajuan sampah ini?</p>
                        <div class="form-group d-hidden" id="alertTolak">
                            <p>Apakah anda yakin ingin menolak pengajuan sampah ini?</p>
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
        document.getElementById('berat_sampah').value = value.replace(/\./g, '');
    }
    $('.edit-bin-link').on('click', function() {
            var binId = $(this).data('bin-id');
            $.ajax({
                url: '/sampah/' + binId + '/edit',
                type: 'GET',
                success: function(response) {
                    var data = response.sampah;
                    console.log(response);

                    var formAction = '/sampah/' + binId + '/update';
                    $('#formSampahEdit').attr('action', formAction);
                    $('#editSampahsmodal #berat_sampah').val(data.berat_sampah);
                    value = new Intl.NumberFormat('id-ID').format(data.berat_sampah);
                    $('#editSampahsmodal #berat_format').val(value + ' kg');
                    $('#editSampahsmodal #poin_transaksi').val(data.poin_transaksi);
                },
                error: function(error) {
                    console.error('Error fetching user data: ', error);
                }
            })
        });


    $('.edit-bin-link').on('click', function() {
            var binId = $(this).data('bin-id');
            var formAction = '/proses_sampah/' + binId ;
            $('#proses-sampah-verifikasi-form').attr('action', formAction);
            $('#proses-sampah-verifikasi-form #editusersmodalTitle').html('Verifikasi Sampah');
            $('#proses-sampah-verifikasi-form #status').val('Terverifikasi');
            $('#proses-sampah-verifikasi-form #deskripsiSampah').show()
            $('#proses-sampah-verifikasi-form #alertTolak').hide()
            $('#proses-sampah-verifikasi-form #inputDeskripsi').attr('required',true)


        });
        $('.tolak-bin-link').on('click', function() {
            var binId = $(this).data('bin-id');
            var formAction = '/proses_sampah/' + binId ;
            $('#proses-sampah-verifikasi-form').attr('action', formAction);
            $('#proses-sampah-verifikasi-form #status').val('Ditolak');
            $('#proses-sampah-verifikasi-form #editusersmodalTitle').html('Tolak Sampah');
            $('#proses-sampah-verifikasi-form #deskripsiSampah').hide()
            $('#proses-sampah-verifikasi-form #alertTolak').show()
            $('#proses-sampah-verifikasi-form #inputDeskripsi').attr('required',false)


        });
</script>
@endpush
