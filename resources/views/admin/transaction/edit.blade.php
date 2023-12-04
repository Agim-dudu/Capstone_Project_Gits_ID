@extends('admin.layouts.app')

@section('title', 'Contact')

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
                    <h1 class="h3 mb-2 text-gray-800">Update Transaksi</h1>
                    <br>

                    <!-- DataTales Example -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <form method="POST" action="{{ route('role.admin.transaction.update', ['orderId' => $payment->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="ongkir" class="col-sm-2 col-form-label">Ongkir</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="ongkir" name="ongkir" value="{{ $payment->ongkir }}" required>
                                </div>
                                <label for="service" class="col-sm-2 col-form-label">Service</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="service" name="service" value="{{ $payment->service }}" required>
                                </div>
                            </div>
                            <!-- Tambahkan baris serupa untuk elemen formulir lainnya sesuai kebutuhan -->
                            <div class="row mb-3">
                                <label for="gross_amount" class="col-sm-2 col-form-label">Total Bayar</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="gross_amount" name="gross_amount" value="{{ $payment->gross_amount }}" required>
                                </div>
                                <label for="resi" class="col-sm-2 col-form-label">No Resi</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="resi" name="resi" value="{{ $payment->resi }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="status" class="col-sm-2 col-form-label">Status Pembayaran</label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="pending" {{ $payment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Berhasil" {{ $payment->status === 'capture' ? 'selected' : '' }}>Capture</option>
                                        <option value="canceled" {{ $payment->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Lanjutkan menambahkan baris untuk elemen formulir lainnya -->
                            <button type="submit" class="btn btn-primary">Update Transaksi</button>
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

