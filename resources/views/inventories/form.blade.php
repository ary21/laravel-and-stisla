@extends("layouts.app")

@section("title") @if(!empty($data)) Edit @else Tambah @endif Inventori @endsection

@section("content")
<section class="section">
    <div class="section-header"><h1>@if(!empty($data)) Edit @else Tambah @endif Inventori</h1></div>
</section>
<section class="section">
    <div class="section-body">
        @if (session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
        @endif 
        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="@if(!empty($data)) {{ route('inventories.update', [$data->id]) }} @else {{ route('inventories.store') }} @endif" method="POST">
            @csrf

            @if(!empty($data))
                <input type="hidden" value="PUT" name="_method">
            @endif

            <label for="name">Nama Inventori</label>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="form-control @error('name') is-invalid @enderror" placeholder="Nama Inventori" type="text" name="name" id="name" value="@if(!empty($data)){{ $data->name }}@endif"/>
            
            <br><br>
            <input class="btn btn-primary" type="submit" value="Save"/>
            <a href="{{ url('inventories') }}" class="btn btn-danger">Cancel</a>
        </form> 
    </div>
</section>
@endsection