@extends('admin.layouts.app')

@section('title', 'Data Perusahaan')

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
                <h1 class="h3 mb-4 text-gray-800">Data Perusahaan</h1>

                <div class="col-xl-12">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @elseif(session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                    @endif
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="{{route('role.admin.eksport.pdf.perusahaan')}}" class="btn btn-danger">Eksport PDF</a>
                        <a href="{{ route('role.admin.export.excel.perusahaan') }}" class="btn btn-success">Eksport Exel</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Logo</th>
                                        <th>Province</th>
                                        <th>City</th>
                                        <th>Code Pos</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Url</th>
                                        <th>Karyawan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($perusahaans as $perusahaan)
                                    <tr>
                                        <td>{{ $perusahaan->nama_perusahaan }}</td>
                                        <td style="padding: 0 30px 5px 30px;">
                                            @if($perusahaan->logo)
                                                <img style="width: 100px; height: 100px; object-fit: cover; border-radius: 10%;"
                                                     src="{{ asset('storage/logo/' . $perusahaan->logo) }}">
                                            @else
                                                <!-- You can provide a default image if the logo is not available -->
                                                <img style="width: 100px; height: 100px; object-fit: cover; border-radius: 10%;"
                                                     src="{{ asset('storage/logo/logo.png') }}">
                                            @endif
                                        </td>                                        
                                        <td>{{ $perusahaan->province }}</td>
                                        <td>{{ $perusahaan->city }}</td>
                                        <td>{{ $perusahaan->postal_code }}</td>
                                        <td>{{ $perusahaan->email }}</td>
                                        <td>{{ $perusahaan->phone }}</td>
                                        <td>{{ $perusahaan->url }}</td>
                                        <td>{{ $perusahaan->jumlah_karyawan }}</td>
                                        <td>
                                            <div style="display: grid;" >
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('role.admin.perusahaan.edit', ['id' => $perusahaan->id]) }}" class="btn btn-warning btn-sm mb-2" >Edit</a>
                                        
                                                <!-- Tombol Delete -->
                                                <form action="{{ route('role.admin.perusahaan.delete', ['id' => $perusahaan->id]) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
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

@endsection
