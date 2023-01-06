@extends('layouts.guest')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex flex-row w-100">
        <div class="w-50 vh-100 image_menu_cinema">

        </div>
        <div class="w-50 position-relative p-5">
            <div class="top-50 align-items-center ">
                <form action="{{route('login') }}" method="POST">
                    @csrf
                    <div class="mt-3">
                        <label for="email" class="form-label">Mail</label>
                        <div class="input-group ">
                            <input class="form-control" type="text" name="email" id="email" placeholder="mail">
                        </div>
                        @error('password')
                            <div class="px-5 text-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password">
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
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>