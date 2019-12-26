@extends("layouts.app")

@section("title") @if(!empty($data)) Edit @else Tambah @endif Tipe Order @endsection

@section("content")
<section class="section">
    <div class="section-header"><h1>@if(!empty($data)) Edit @else Tambah @endif Tipe Order</h1></div>
</section>
<section class="section">
    <div class="section-body">
        @if (session('status'))
            <div class="alert alert-warning">
                {{ session('status') }}
            </div>
        @endif
        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="@if(!empty($data)) {{ route('masters.update', [$data->id]) }} @else {{ route('masters.store') }} @endif" method="POST">
            @csrf

            @if(!empty($data))
                <input type="hidden" value="PUT" name="_method">
            @endif
            
            <input type="hidden" value="orderType" name="type">
            <label for="name">Nama Tipe</label>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="form-control @error('name') is-invalid @enderror" placeholder="Nama Tipe" type="text" name="name" id="name" value="@if(!empty($data)){{ $data->value }}@endif"/>
            <br>
            
            <label for="komisi">Komisi (%)</label>
            @error('komisi')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="form-control @error('komisi') is-invalid @enderror" placeholder="Komisi" type="text" name="komisi" id="komisi" value="@if(!empty($data)){{ $data->extra }}@endif"/>
            <br><br>
            <input class="btn btn-primary" type="submit" value="Save"/>
            <a href="{{ url('masters?do=order') }}" class="btn btn-danger">Cancel</a>
        </form> 
    </div>
</section>
@endsection