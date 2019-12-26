@extends("layouts.app")

@section("title") Data User @endsection

@section("content")
<section class="section">
    <div class="section-header"><h1>Data User</h1></div>
</section>
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="buttons">
                            <a href="{{ url('users') }}" class="btn btn-success"><i class="fas fa-sync-alt"></i> Reload</a>
                            <a href="{{ route('users.create') }}" class="btn btn-info"><i class="fas fa-plus"></i> Tambah Data</a>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-info alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                {{ session('status') }}
                            </div>
                        @endif 
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="th-md">Name</th>
                                        <th class="th-md">Email</th>
                                        <th>Status</th>
                                        <th>Avatar</th>
                                        <th class="action2">Action</th>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr class="trFilter">
                                        <th></th>
                                        <th>
                                            <div class="input-group">
                                                <input value="{{ Request::get('name') }}" id="nameFind" class="form-control col-md-10" type="text"placeholder="Filter nama"/>
                                                <div class="input-group-append">
                                                    <button class="btn btn-insearch btnFindNama" type="button"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group">
                                                <input value="{{ Request::get('email') }}" id="emailFind" class="form-control col-md-10" type="text"placeholder="Filter email"/>
                                                <div class="input-group-append">
                                                    <button class="btn btn-insearch btnFindEmail" type="button"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </th>
                                        <th> 
                                            @php $status = Request::get('status') @endphp
                                            <select name="status" id="statusFind" class="form-control" onchange="filter()">
                                                <option value="">Semua Status</option>
                                                <option value="ACTIVE" {{ $status == "ACTIVE" ? "selected" : "" }}>Active</option>
                                                <option value="NONACTIVE"  {{ $status == "NONACTIVE" ? "selected" : "" }}>Nonactive</option>
                                            </select>
                                        </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (!empty($users))
                                    @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ $users->firstItem() + $key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->status == "ACTIVE")
                                                <span class="badge badge-success">{{$user->status}}</span>
                                            @else 
                                                <span class="badge badge-danger">{{$user->status}}</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($user->avatar)
                                                <img src="{{ asset('storage/'.$user->avatar) }}" width="70px"/> 
                                            @else 
                                                [No Image]
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-info text-white btn-sm" title="Detail"><i class="fas fa-poll-h"></i> Detail</a>
                                            <a class="btn btn-info text-white btn-sm" href="{{ route('users.edit', [$user->id]) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                            <form onsubmit="return confirm('Delete data?')" class="d-inline" action="{{route('users.destroy', [$user->id])}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger text-white btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Data Kosong</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        {{ $users->appends(Request::all())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(e) {
        $('.btnFindNama, .btnFindEmail').click(function(e) {
            filter();
        });

        $('#nameFind, #emailFind').on('keypress',function(e) {
            if(e.which == 13) {
                filter();
            }
        });
    })

    function filter() {
        let name = $('#nameFind').val();
        name = name ? name : '';

        let email = $('#emailFind').val();
        email = email ? email : '';

        let status = $('#statusFind').val();
        status = status ? status : '';

        location.href = "{{ url('users') }}?name=" + name + "&email=" + email + "&status=" + status;
    }
</script>
@endsection