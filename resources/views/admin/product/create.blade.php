@extends('admin.layouts.app')

@section('title', 'Update Product')

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
                <h1 class="h3 mb-2 text-gray-800">Create Product</h1>
                <br>

                <!-- DataTales Example -->
                <div class="container-fluid">
                    <!-- Page Heading -->

                    <form method="POST" action="{{ route('role.admin.product.store')}}" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="name" name="name" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Product Description</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" id="description" name="description" required></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="price" name="price" required>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="stock" name="stock" required>
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-4">
                                <select id="type" name="type" class="form-control" required>
                                    <option value="Anggur Meja (Table Grapes)" selected>Anggur Meja (Table Grapes)</option>
                                    <option value="Anggur Hitam (Black Grapes)">Anggur Hitam (Black Grapes)</option>
                                    <option value="Anggur Merah (Red Grapes)">Anggur Merah (Red Grapes)</option>
                                    <option value="Anggur Putih (White Grapes)">Anggur Putih (White Grapes)</option>
                                    <option value="Anggur untuk Wine (Wine Grapes)">Anggur untuk Wine (Wine Grapes)</option>
                                    <option value="Anggur Kismis (Raisin Grapes)">Anggur Kismis (Raisin Grapes)</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Product Image</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image" name="image" required>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Create Product</button>
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

@endsection
