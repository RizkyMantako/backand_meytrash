@extends('layouts.app')

@section('title', 'Proses Donasi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Proses Donasi</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Proses Donasi</h2>
            <p class="section-lead">
                Anda Bisa Melihat Data Proses Donasi.
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All User</h4>
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
                                <form>
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
                                        <th>Created_at</th>
                                        <th>Status</th>
                                    </tr>
                                    @foreach ($proses_donasi as $vdonasi)
                                    <tr>
                                        <td>{{ $vdonasi->user_id }}</td>
                                        <td>{{ $vdonasi->nama }}</td>
                                        <td>{{ $vdonasi->no_hp }}</td>
                                        <td>{{ $vdonasi->alamat }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$vdonasi->foto_makanan) }}" class=" " width="100" height="130">
                                        </td>
                                        <td>{{ $vdonasi->jenis_makanan }}</td>
                                        <td>{{ $vdonasi->berat_makanan }}kg</td>
                                        <td>{{ $vdonasi->poin_transaksi }}</td>
                                        <td>{{ $vdonasi->deskripsi }}</td>
                                        <td>{{ $vdonasi->created_at }}</td>
                                        <td>
                                            <a href="{{ route('selesai_donasi', $vdonasi->id) }}"
                                                class="btn badge badge-primary"
                                                onclick="event.preventDefault();
                                                        document.getElementById('selesai-form-{{ $vdonasi->id }}').submit();"
                                                title="selesai">Selesai</a>

                                            <form id="selesai-form-{{ $vdonasi->id }}"
                                                action="{{ route('selesai_donasi', $vdonasi->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
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
</div>

{{-- edit button poin --}}
<div id="editprosesdonasi" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h4 class="modal-title">Edit Poin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Point</label>
                        <input type="text" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
