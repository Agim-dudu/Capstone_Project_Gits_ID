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
                <h1 class="h3 mb-2 text-gray-800">Update Product</h1>
                <br>

                <!-- DataTales Example -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <form method="POST" action="{{ route('role.admin.product.update', ['id' => $product->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                    
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Product Description</label>
                            <div class="col-sm-4">
                                <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="weight" class="col-sm-2 col-form-label">Weight</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="weight" name="weight" value="{{ $product->weight }}" required>
                                @error('weight')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-4">
                                <select id="type" name="type" class="form-control" required>
                                    <option value="Anggur Meja (Table Grapes)" {{ $product->type == 'Anggur Meja (Table Grapes)' ? 'selected' : '' }}>Anggur Meja (Table Grapes)</option>
                                    <option value="Anggur Hitam (Black Grapes)" {{ $product->type == 'Anggur Hitam (Black Grapes)' ? 'selected' : '' }}>Anggur Hitam (Black Grapes)</option>
                                    <option value="Anggur Merah (Red Grapes)" {{ $product->type == 'Anggur Merah (Red Grapes)' ? 'selected' : '' }}>Anggur Merah (Red Grapes)</option>
                                    <option value="Anggur Putih (White Grapes)" {{ $product->type == 'Anggur Putih (White Grapes)' ? 'selected' : '' }}>Anggur Putih (White Grapes)</option>
                                    <option value="Anggur untuk Wine (Wine Grapes)" {{ $product->type == 'Anggur untuk Wine (Wine Grapes)' ? 'selected' : '' }}>Anggur untuk Wine (Wine Grapes)</option>
                                    <option value="Anggur Kismis (Raisin Grapes)" {{ $product->type == 'Anggur Kismis (Raisin Grapes)' ? 'selected' : '' }}>Anggur Kismis (Raisin Grapes)</option>
                                    <!-- Tambahkan opsi lain sesuai dengan jenis anggur -->
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Product Image</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="image" name="image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label"></label>
                            <img style="width: 80px; height: 80px; border-radius: 10%;"src="{{ asset('storage/product/' . $product->image) }}">
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Update Product</button>
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
