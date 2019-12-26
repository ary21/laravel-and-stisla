@extends("layouts.app")

@section("title") @if(!empty($data)) Edit @else Tambah @endif Tipe Pembayaran @endsection

@section("content")
<section class="section">
    <div class="section-header"><h1>@if(!empty($data)) Edit @else Tambah @endif Tipe Pembayaran</h1></div>
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

            <input type="hidden" value="paymentType" name="type">
            <label for="name">Nama Tipe</label>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input class="form-control @error('name') is-invalid @enderror" placeholder="Nama Tipe" type="text" name="name" id="name" value="@if(!empty($data)){{ $data->value }}@endif"/>
            <br>
            
            <br><br>
            <input class="btn btn-primary" type="submit" value="Save"/>
            <a href="{{ url('masters?do=payment') }}" class="btn btn-danger">Cancel</a>
        </form> 
    </div>
</section>
@endsection