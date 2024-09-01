@extends('layouts.app')

@section('title', 'Edukasi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edukasi</h1>
            <div class="section-header-button">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addmodal" title="add">
                    <span>Add New</span>
                </a>
            </div>

        </div>
        <div class="section-body">
            <h2 class="section-title">Edukasi</h2>
            <p class="section-lead">
                Anda Bisa Melihat, Menambahkan , Mengedit, Atau Menghapus Data Edukasi
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
                                <form method="GET" action="{{ route('edukasis.edukasi') }}">
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
                                        <th>Id</th>
                                        <th>Sampul</th>
                                        <th>Judul</th>
                                        <th>Sumber</th>
                                        <th>Link</th>
                                        <th>Deskripsi</th>
                                        <th>tags</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        @foreach ($education as $edu)
                                        <td>{{ $edu->id }}</td>
                                        <td>
                                            <a href="#">
                                                <img alt="image"
                                                    src="{{ $edu->sampul_link ?? asset('img/avatar/avatar-5.png') }}"
                                                    width="85" data-toggle="title" title="">
                                            </a>
                                        </td>
                                        <td>{{ $edu->judul }}</td>
                                        <td>{{ $edu->sumber }}</td>
                                        <td>{{ $edu->link_url }}</td>
                                        <td class="limited-text">{{ $edu->deskripsi }}</td>
                                        <td>
                                            @if (count(json_decode($edu->tags)) > 0)
                                            @foreach (json_decode($edu->tags) as $index => $tag)
                                            {{ $tag }}
                                            @if ($index < count(json_decode($edu->tags)) - 1)
                                                ,
                                                @endif
                                                @endforeach
                                                @endif
                                        </td>
                                        <td>{{ $edu->created_at }}</td>
                                        <td>
                                            <p>{{ $edu->sampul_link }}</p>
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <div class="row align-items-start">
                                                    <div class="col  mt-2">
                                                        <a href="#" class="badge btn badge-edit edit-edu-link"
                                                            data-toggle="modal" data-target="#editEdumodal"
                                                            data-edu-id="{{ $edu->id }}" title="edit">
                                                            <span>Edit Berita</span>
                                                        </a>
                                                    </div>
                                                    <div class=" mt-2 col">
                                                        <a href="{{ route('edukasis.destroy', $edu->id) }}"
                                                            class="badge btn badge-danger"
                                                            onclick="event.preventDefault();
                                                    document.getElementById('delete-edu-form-{{ $edu->id }}').submit();" title="delete">Hapus Berita</a>
                                                        <form id="delete-edu-form-{{ $edu->id }}"
                                                            action="{{ route('edukasis.destroy', $edu->id) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
    {{-- add Users Modal --}}

    <div id="addmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addmodalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="formEdukasi" action="{{ route('edukasis.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addmodalTitle">Tambah Edukasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sampul">Sampul</label>
                            <input type="file" class="form-control" id="sampul" name="sampul" required>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="form-group">
                            <label for="sumber">Sumber</label>
                            <input type="text" class="form-control" id="sumber" name="sumber" required>
                        </div>
                        <div class="form-group">
                            <label for="link_url">Link Url</label>
                            <input type="text" class="form-control" id="link_url" name="link_url" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="" cols="30" rows="10" class="form-control" id="deskripsi"
                                name="deskripsi" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Tags</label>
                            <select class="form-control" id="tags" name="tags[]" multiple="multiple" required>
                            </select>
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

    <div id="editEdumodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editEdumodalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="formEduEdit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEdumodalTitle">Edit Edukasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sampul">Sampul</label>
                            <input type="file" class="form-control" id="sampul" name="sampul">
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="form-group">
                            <label for="sumber">Sumber</label>
                            <input type="text" class="form-control" id="sumber" name="sumber" required>
                        </div>
                        <div class="form-group">
                            <label for="link_url">Link Url</label>
                            <input type="text" class="form-control" id="link_url" name="link_url" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea id="deskripsi" cols="30" rows="10" class="form-control" id="deskripsi"
                                name="deskripsi"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Tags</label>
                            <select class="form-control" id="tags" name="tags[]" multiple="multiple">
                            </select>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
    $('#tags').select2({
        tags: true,
        tokenSeparators: [','],
        width: '100%' // Menambahkan opsi lebar untuk memastikan tampilan yang benar
    });
    $('.edit-edu-link').on('click', function() {
    // Get the education ID from the data attribute
    var eduId = $(this).data('edu-id');
    $.ajax({
        url: '/edukasi/' + eduId + '/edit',
        type: 'GET',
        success: function(response) {
            var edukasi = response.edukasi;
            $('#editEdumodal #judul').val(edukasi.judul);
            $('#editEdumodal #sumber').val(edukasi.sumber);
            $('#editEdumodal #link_url').val(edukasi.link_url);
            $('#editEdumodal #deskripsi').val(edukasi.deskripsi);
            var tagsArray = JSON.parse(edukasi.tags);
            $('#editEdumodal #tags').empty();
                $.each(tagsArray, function(index, tag) {
                    var option = new Option(tag, tag, true, true);
                    $('#editEdumodal #tags').append(option).trigger('change');
                });

            $('#editEdumodal #tags').select2({
                tags: true,
                tokenSeparators: [','],
                width: '100%',
                data: tagsArray
            });

            var formAction = '/edukasi/' + eduId + '/update';
            $('#formEduEdit').attr('action', formAction);

        },
        error: function(error) {
            console.error('Error fetching education data: ', error);
        }
    });
});
});
</script>
@endpush
