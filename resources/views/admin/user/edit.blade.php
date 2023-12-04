@extends('admin.layouts.app')

@section('title', 'Update User')

@section('content')

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('admin.layouts.header')


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Update User</h1>
                <br>

                <!-- DataTales Example -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <form enctype="multipart/form-data" method="POST"
                        action="{{ route('role.admin.user.update', ['id' => $user->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="name">Username</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                            </div>

                            <div class="col-md-1">
                                @if($user->avatar)
                                <img style="width: 80px; height: 80px; object-fit: cover; border-radius: 10%;"
                                    src="{{ asset('storage/avatars/' . $user->avatar) }}">
                                @else
                                <!-- You can provide a default image if the logo is not available -->
                                <img style="width: 80px; height: 80px; object-fit: cover; border-radius: 10%;"
                                    src="{{ asset('storage/avatars/avatar.png') }}">
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label class="large mb-1" for="avatar">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    value="{{$user->first_name}}">
                            </div>

                            <div class="col-md-5">
                                <label class="large mb-1" for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    value="{{$user->last_name}}">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{$user->email}}">
                            </div>

                            <div class="col-md-5">
                                <label class="large mb-1" for="role">Role</label>
                                <select id="role" name="role" type="text" class="form-control">
                                    <option value="0" @if($user->role == 0) selected @endif>User</option>
                                    <option value="1" @if($user->role == 1) selected @endif>Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Leave blank to keep current password">
                            </div>

                            <div class="col-md-5">
                                <label class="large mb-1" for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Leave blank to keep current password">
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="province_id">Provinsi</label>
                                <select id="province_id" name="province_id" type="text" class="form-control">
                                    <option value="{{$user->province_id}}">{{$user->province}}</option>
                                    @foreach ($province as $province)
                                    <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label class="large mb-1" for="city_id">Kota</label>
                                <select id="city_id" name="city_id" type="text" class="form-control">
                                    <option value="{{$user->city_id}}">{{$user->city}}</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="form-control" id="province" name="province" type="text"
                                value="{{$user->province}}" hidden>
                            <input class="form-control" id="city" name="city" type="text" value="{{$user->city}}"
                                hidden>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="postal_code">Code Pos</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code"
                                    value="{{$user->postal_code}}">
                            </div>

                            <div class="col-md-5">
                                <label class="large mb-1" for="address">Detail Alamat</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{$user->address}}">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{$user->phone}}">
                            </div>
                        </div>

                        <!-- Lanjutkan menambahkan baris untuk elemen formulir lainnya -->
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Anggur Kita</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

</script>
<script>
    $(document).ready(function () {
        // Update hidden fields when the province dropdown changes
        $('#province_id').on('change', function () {
            $('#province').val($('#province_id option:selected').text());
        });

        // Update hidden fields when the city dropdown changes
        $('#city_id').on('change', function () {
            $('#city').val($('#city_id option:selected').text());
        });

        // Ensure that the hidden inputs have values on form submission
        $('form').submit(function () {
            // If the province_id and city_id are selected, update the hidden inputs
            if ($('#province_id option:selected').val()) {
                $('#province').val($('#province_id option:selected').text());
            }
            if ($('#city_id option:selected').val()) {
                $('#city').val($('#city_id option:selected').text());
            }
        });
    });

</script>

@endsection
