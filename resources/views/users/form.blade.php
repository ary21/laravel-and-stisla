@extends("layouts.app")

@section("title") @if(!empty($user)) Edit @else Tambah @endif User @endsection

@section("content")
<section class="section">
    <div class="section-header"><h1>@if(!empty($user)) Edit @else Tambah @endif User</h1></div>
</section>
<section class="section">
    <div class="section-body">
        @if (session('status'))
            <div class="alert alert-warning">
                {{ session('status') }}
            </div>
        @endif 
        <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="@if(!empty($user)) {{route('users.update', [$user->id])}} @else {{ route('users.store') }} @endif" method="POST">
            @csrf

            @if(!empty($user))
                <input type="hidden" value="PUT" name="_method">
            @endif

            <label for="name">Name</label>
            <input class="form-control" placeholder="Full Name" type="text" name="name" id="name" value="@if(!empty($user)){{ $user->name }}@endif"/>
            <br>

            <label for="username">Username</label>
            <input class="form-control" placeholder="username" type="text" name="username" id="username" @if(!empty($user))value="{{ $user->username }}" disabled @endif/>
            <br>

            <label for="">Roles</label>
            <br>
            <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN"
                {{ (!empty($user) && in_array("ADMIN", json_decode($user->roles)) ) ? "checked" : "" }} 
                >
            <label for="ADMIN">Administrator</label>
            
            <input type="checkbox" name="roles[]" id="STAFF" value="STAFF" 
                {{ (!empty($user) && in_array("STAFF", json_decode($user->roles)) ) ? "checked" : "" }} 
            <label for="STAFF">Staff</label>
            <br>

            <br>
            <label for="phone">Phone number</label> 
            <br>
            <input type="text" name="phone" class="form-control" value="@if(!empty($user)){{ $user->phone }}@endif">
            <br>

            <label for="address">Address</label>
            <textarea name="address" id="address" style="height: 100px;" class="form-control">@if(!empty($user)){{ $user->address }}@endif</textarea>
            <br>

            <label for="avatar">Avatar image</label><br>
            @if(!empty($user))
                <span>Current avatar: </span><br>
                @if($user->avatar)
                <img src="{{asset('storage/'.$user->avatar)}}" width="120px" /><br>
                @else 
                    No avatar
                @endif
            @endif
            <input id="avatar" name="avatar" type="file" class="form-control">
            @if(!empty($user))<small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>@endif

            <hr class="my-3">
            <label for="email">Email</label>
            <input class="form-control" placeholder="user@mail.com" type="text" name="email" id="email" @if(!empty($user))value="{{ $user->email }}" disabled @endif/>
            <br>

            <label for="password">Password</label>
            <input class="form-control" placeholder="password" type="password" name="password" id="password"/>
            <br>

            <label for="password_confirmation">Password Confirmation</label>
            <input class="form-control" placeholder="password confirmation" type="password" name="password_confirmation" id="password_confirmation"/>
            <br>
            <label for="">Status</label>
            <br/>
            <div class="radio">
                <label for="active"><input value="ACTIVE" type="radio" class="" id="active" name="status" @if(!empty($user)) {{$user->status == "ACTIVE" ? "checked" : ""}} @endif>Active</label>
            </div>
            <div class="radio">
                <label for="nonactive"><input value="NONACTIVE" type="radio" class="" id="nonactive" name="status" @if(!empty($user)) {{$user->status == "NONACTIVE" ? "checked" : ""}} @endif>Nonactive</label>
            </div>
            <br><br>
            <input class="btn btn-primary" type="submit" value="Save"/>
            <a href="{{ url('users') }}" class="btn btn-danger">Cancel</a>
        </form> 
    </div>
</section>
@endsection