@extends('admin.layouts.app')

@section('title', 'Data User')

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
                <h1 class="h3 mb-4 text-gray-800">Data User</h1>

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
                        <div class="row">
                            <div class="col-md-9 mb-3">
                                <a href="{{ route('role.admin.user.create') }}" class="btn btn-primary">Create User</a>
                                <a href="{{route('role.admin.eksport.pdf.user')}}" class="btn btn-danger">Eksport PDF</a>
                                <a href="{{ route('role.admin.export.excel.user') }}" class="btn btn-success">Eksport Exel</a>
                            </div>
                            <div class="col-md-3 text-right">
                                <form action="{{ route('role.admin.user.search') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <input type="text" class="form-control" name="query" placeholder="Search user">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone</th>
                                        <th>Province</th>
                                        <th>City</th>
                                        <th>Address</th>
                                        <th>Postal Code</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->province }}</td>
                                        <td>{{ $user->city }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->postal_code }}</td>
                                        <td>{{ $user->role == 1 ? 'Admin' : 'User' }}</td>
                                        <td>
                                            <div style="display: grid;">
                                                <a href="{{ route('role.admin.user.edit', ['id' => $user->id]) }}" class="btn btn-warning btn-sm mb-2">Edit</a>

                                                <form action="{{ route('role.admin.user.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
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
