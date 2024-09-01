@extends('layouts.app')

@section('title', 'Riwayat Sampah')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Riwayat Sampah</h1>
            </div>
            <div class="section-body">
                <h2 class="section-title">Riwayat Sampah</h2>
                <p class="section-lead">
                    Anda Dapat Melihat Riwayat Sampah.
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
                                            <input type="text"
                                                class="form-control"
                                                placeholder="Search">
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
                                            <th>Foto Sampah</th>
                                            <th>Berat Sampah</th>
                                            <th>Poin Transaksi</th>
                                            <th>Deskripsi</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                        </tr>
                                        @foreach ($riwayat_sampah as $xsampah)
                                        <tr>
                                            <td>{{ $xsampah->user_id }}</td>
                                            <td>{{ $xsampah->nama }}</td>
                                            <td>{{ $xsampah->no_hp }}</td>
                                            <td>
                                                <img src="{{ asset('storage/'.$xsampah->foto_sampah) }}" class=" " width="100" height="130">
                                            </td>
                                            <td>{{ $xsampah->berat_sampah }}</td>
                                            <td>{{ $xsampah->poin_transaksi }}</td>
                                            <td>{{ $xsampah->deskripsi }}</td>
                                            <td>{{ $xsampah->created_at }}</td>
                                            <td>
                                                <div class="badge badge-primary">Selesai</div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item disabled">
                                                <a class="page-link"
                                                    href="#"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link"
                                                    href="#">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="#">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="#">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link"
                                                    href="#"
                                                    aria-label="Next">
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
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
