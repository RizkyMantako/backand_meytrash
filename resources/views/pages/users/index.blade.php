@extends('layouts.app')

@section('title', 'Users')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data User</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Users</h2>
            <p class="section-lead">
                Anda Bisa Melihat, Mengedit, Atau Menghapus Data User
            </p>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style=>
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
                                <form method="GET" action="{{route('users.index')}}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="name">
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
                                        <th>ID</th>
                                        <th>Foto Profil</th>
                                        <th>Nama</th>
                                        <th>Nomor Hp</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>No Dana</th>
                                        <th>Poin</th>
                                        <th>Rupiah</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id}}</td>
                                        <td><img src="{{ asset('storage/'.$user->foto_profil) }}" class="rounded-circle" width="40" height="40"></td>
                                        <td>{{ $user->name}}</td>
                                        <td>{{ $user->no_hp}}</td>
                                        <td>{{ $user->alamat}}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->no_dana}}</td>
                                        <td>{{ $user->poin}}</td>
                                        <td>Rp {{ number_format($user->rupiah, 0, ',', '.') }}</td>
                                        <td>{{ $user->created_at}}</td>
                                        <td class="text-center" align="middle">
                                            <a href="#" class="badge btn badge-edit edit-user-link my-1"
                                                data-toggle="modal" data-target="#editusersmodal"
                                                data-user-id="{{ $user->id }}" title="edit">
                                                <span>Edit</span>
                                            </a>
                                            <a href="{{ route('users.destroy', $user->id) }}"
                                                class="badge btn badge-danger"
                                                onclick="event.preventDefault();
                                                    document.getElementById('delete-user-form-{{ $user->id }}').submit();" title="delete">Hapus</a>

                                            <form id="delete-user-form-{{ $user->id }}"
                                                action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="float-right">
                                {{$users->withQueryString()->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Edit Users Modal --}}

<div id="editusersmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editusersmodalTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" id="formUserEdit" action="{{ route('users.update', ':userId') }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editusersmodalTitle">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="poin">poin</label>
                        <input type="number" class="form-control" id="poin" name="poin" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="rupiah">Rupiah</label>
                        <input type="text" class="form-control" id="rupiah_format" name="rupiah_format" value=""
                            required oninput="formatRupiah(this)">
                        <input type="hidden" id="rupiah" name="rupiah">
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


{{-- Delete Users Modal --}}


@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script>
    function formatRupiah(input) {
        let value = input.value.replace(/\D/g, '');
        value = new Intl.NumberFormat('id-ID').format(value);
        input.value = 'Rp ' + value;
        document.getElementById('rupiah').value = value.replace(/\./g, '');
    }
    $('.edit-user-link').on('click', function() {
            // Get the user ID from the data attribute
            var userId = $(this).data('user-id');
            $.ajax({
                url: '/users/' + userId + '/edit',
                type: 'GET',
                success: function(response) {
                    var user = response.user;
                    var formAction = '/users/' + userId + '/update';
                     $('#formUserEdit').attr('action', formAction);
                    $('#editusersmodal #poin').val(user.poin);
                    $('#editusersmodal #rupiah').val(user.rupiah);
                    value = new Intl.NumberFormat('id-ID').format(user.rupiah);
                    $('#editusersmodal #rupiah_format').val('Rp ' + value);
                },
                error: function(error) {
                    console.error('Error fetching user data: ', error);
                }
            });
        });
    $('#deleteUserModal{{ $user->id }}').on('hidden.bs.modal', function (e) {
            $(this).find('form').trigger('reset');
        });
</script>
<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
