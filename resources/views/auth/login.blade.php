@extends('layouts.guest')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex flex-row w-100">
        <div class="w-50 vh-100 image_menu_cinema">

        </div>
        <div class="w-50 d-flex justify-content-center align-items-center">
            <div class="w-75">
                <form action="{{route('login') }}" method="POST">
                    @csrf
                    <div class="fs-2">
                        {{ __('login') }}
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label">Mail</label>
                        <div class="input-group ">
                            <input class="form-control" type="text" name="email" id="email" autocomplete="email" value="{{ old('email') }}" required placeholder="mail">
                        </div>
                        @error('password')
                            <div class="px-5 text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="password" class="form-label">{{__('password')}}</label>
                        <input class="form-control" type="password" name="password" id="password" required placeholder="Password">
                        @error('password')
                            <div class="px-5 text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <input type="submit" class="btn btn-login" value="Connection">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection