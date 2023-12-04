@extends('admin.layouts.app')

@section('title', 'Data Transaction')

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
                <h1 class="h3 mb-4 text-gray-800">Data Transaksi</h1>

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
                                <a href="{{route('role.admin.eksport.pdf.transaction')}}" class="btn btn-danger">Eksport PDF</a>
                                <a href="{{ route('role.admin.export.excel.transaction') }}" class="btn btn-success">Eksport Exel</a>
                            </div>
                            <div class="col-md-3 text-right">
                                <form action="{{ route('role.admin.transaction.search') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <input type="text" class="form-control" name="query" placeholder="Search by name">
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
                                        <th>Nama Customer</th>
                                        <th>Product</th>
                                        <th>Jumlah/Kg</th>
                                        <th>Harga</th>
                                        <th>Ongkir</th>
                                        <th>Service</th>
                                        <th>Total Bayar</th>
                                        <th>Resi</th>
                                        <th>Status Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    @foreach($user->payments as $payment)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <!-- Loop untuk PaymentItem -->
                                            <ul>
                                                @foreach($payment->items as $item)
                                                <li>{{ $item->product->name }}</li>
                                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                                @endforeach
                                            </ul>
                                            <!-- Akhir loop untuk PaymentItem -->
                                        </td>
                                        <td>
                                            <!-- Loop untuk PaymentItem -->
                                            <ul>
                                                @foreach($payment->items as $item)
                                                <li>{{ $item->quantity }}</li>
                                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                                @endforeach
                                            </ul>
                                            <!-- Akhir loop untuk PaymentItem -->
                                        </td>
                                        <td>
                                            <!-- Loop untuk PaymentItem -->
                                            <ul>
                                                @foreach($payment->items as $item)
                                                <li>{{ number_format($item->price, 0, ',', '.') }}</li>
                                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                                @endforeach
                                            </ul>
                                            <!-- Akhir loop untuk PaymentItem -->
                                        </td>
                                        <td>{{ number_format($payment->ongkir, 0, ',', '.') }}</td>
                                        <td>{{ $payment->service }}</td>
                                        <td>{{ $payment->gross_amount }}</td>
                                        <td>{{ $payment->resi }}</td>
                                        <td>{{ $payment->status }}</td>
                                        <td>
                                            <div style="display: grid;" >
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('role.admin.transaction.edit', ['userId' => $user->id, 'paymentId' => $payment->id]) }}" class="btn btn-warning btn-sm mb-2" >Edit</a>
                                        
                                                <!-- Tombol Delete -->
                                                <form action="{{ route('role.admin.transaction.delete', ['orderId' => $payment->id]) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
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
