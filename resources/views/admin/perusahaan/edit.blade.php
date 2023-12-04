@extends('admin.layouts.app')

@section('title', 'Update Perusahaan')

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
                <h1 class="h3 mb-2 text-gray-800">Update Perusahaan</h1>
                <br>

                <!-- DataTales Example -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <form enctype="multipart/form-data" method="POST"
                        action="{{ route('role.admin.perusahaan.update', ['id' => $perusahaan->id]) }} ">
                        @csrf
                        @method('PUT')

                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="nama_perusahaan">Nama Perusahaan</label>
                                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                                    value="{{ $perusahaan->nama_perusahaan }}">
                                @error('nama_perusahaan')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label class="large mb-1" for="logo">Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo"
                                    value="{{ $perusahaan->logo }}">
                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="province_id">Provinsi</label>
                                <select id="province_id" name="province_id" type="text" class="form-control">
                                    <option value="{{ $perusahaan->province_id }}">{{ $perusahaan->province }}</option>
                                    @foreach ($province as $prov)
                                    <option value="{{ $prov['province_id'] }}">{{ $prov['province'] }}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label class="large mb-1" for="city_id">Kota</label>
                                <select id="city_id" name="city_id" type="text" class="form-control">
                                    <option value="{{ $perusahaan->city_id }}">{{ $perusahaan->city }}</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <input class="form-control" id="province" name="province" type="text"
                                value="{{ $perusahaan->province }}" hidden>
                            <input class="form-control" id="city" name="city" type="text"
                                value="{{ $perusahaan->city }}" hidden>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="postal_code">Code Pos</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code"
                                    value="{{ $perusahaan->postal_code }}">
                                @error('postal_code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label class="large mb-1" for="address">Detail Alamat</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $perusahaan->address }}">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ $perusahaan->email }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label class="large mb-1" for="phone">Nomor Telpon</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $perusahaan->phone }}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="url">Url Website</label>
                                <input type="text" class="form-control" id="url" name="url"
                                    value="{{ $perusahaan->url }}">
                                @error('url')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label class="large mb-1" for="jumlah_karyawan">Jumlah Karyawan</label>
                                <input type="number" class="form-control" id="jumlah_karyawan" name="jumlah_karyawan"
                                    value="{{ $perusahaan->jumlah_karyawan }}">
                                @error('jumlah_karyawan')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-5">
                                <label class="large mb-1" for="tahun_pendirian">Tahun Pendirian</label>
                                <input type="number" class="form-control" id="tahun_pendirian" name="tahun_pendirian"
                                    value="{{ $perusahaan->tahun_pendirian }}">
                                @error('tahun_pendirian')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Lanjutkan menambahkan baris untuk elemen formulir lainnya -->
                        <button type="submit" class="btn btn-primary">Update Perusahaan</button>
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
