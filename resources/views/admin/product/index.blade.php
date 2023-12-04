@extends('admin.layouts.app')

@section('title', 'Data Product')

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
                <h1 class="h3 mb-4 text-gray-800">Data Product</h1>

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
                                <a href="{{ route('role.admin.product.create') }}" class="btn btn-primary">Create
                                    Product</a>
                                <a href="{{ route('role.admin.eksport.pdf.product') }}" class="btn btn-danger">Export
                                    PDF</a>
                                <a href="{{ route('role.admin.export.excel.product') }}" class="btn btn-success">Export
                                    Excel</a>
                            </div>
                            <div class="col-md-3 text-right">
                                <form action="{{ route('role.admin.product.search') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <input type="text" class="form-control" name="query" placeholder="Search products">
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
                                        <th>Gambar</th>
                                        <th>Deskripsi</th>
                                        <th>Jenis</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Berat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td style="padding: 0 30px 5px 30px;">
                                            @if($product->image)
                                                <img style="width: 100px; height: 100px; object-fit: cover; border-radius: 10%;"
                                                     src="{{ asset('storage/product/' . $product->image) }}">
                                            @else
                                                <!-- You can provide a default image if the logo is not available -->
                                                <img style="width: 100px; height: 100px; object-fit: cover; border-radius: 10%;"
                                                     src="{{ asset('storage/product/product.png') }}">
                                            @endif
                                        </td> 
                                        <td>{{ $product->description}}</td>
                                        <td>{{ $product->type}}</td>
                                        <td>{{ $product->price}}</td>
                                        <td>{{ $product->stock}}</td>
                                        <td>{{ $product->weight}}</td>
                                        <td>
                                            <div style="display: grid;">
                                                <a href="{{ route('role.admin.product.edit', ['id' => $product->id]) }}"
                                                    class="btn btn-warning btn-sm mb-2">Edit</a>

                                                <form
                                                    action="{{ route('role.admin.product.delete', ['id' => $product->id]) }}"
                                                    method="POST" style="display: inline-block;">
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
