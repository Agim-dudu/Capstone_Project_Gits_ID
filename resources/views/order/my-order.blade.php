@extends('layouts.app')

@section('title', 'Order History')

@section('content')

<!-- Header -->
@include('layouts.header')
<!-- END Header -->

<!-- Navigasi -->
@include('layouts.navigation')
<!-- END Navigasi -->

<!-- Gambar Hero yang Dapat Digunakan Kembali -->
@component('components.hero-bg', [
'backgroundImageUrl' => 'https://anggurkita.eudeka.my.id/assets/images/bg-cart.jpg',
'homeUrl' => '/',
'homeText' => 'Beranda',
'pageName' => 'Your Order',
'pageTitle' => 'Your Order',
])
@endcomponent

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            @if (session('success'))
            <div class="col-md-12 mb-5 heading-section text-center ftco-animate ">
                <h4 style="color: rgb(119, 211, 43)">{{ session('success') }}</h4>
            </div>
            @elseif (session('warning'))
            <div class="col-md-12 mb-5 heading-section text-center ftco-animate ">
                <h4 style="color: rgb(247, 54, 0)">{{ session('warning') }}</h4>
            </div>
            @elseif (session('error'))
            <div class="col-md-12 mb-5 heading-section text-center ftco-animate ">
                <h4 style="color: rgb(247, 54, 0)">{{ session('error') }}</h4>
            </div>
            @endif
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    @if ($orders->isEmpty())
                        <p>Anda belum melakukan transaksi apa pun.</p>
                    @else
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Order ID</th>
                                    <th>Status Pembayaran</th>
                                    <th>No Resi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="text-center">
                                        <td class="price">{{ $order->order_id }}</td>
                                        <td class="price">{{ $order->status }}</td>
                                        <td class="total">{{ $order->resi }}</td>
                                        @if ($order->status == 'capture')
                                            <td>
                                                <a href="{{ route('order-detail.show', ['orderId' => $order->order_id]) }}">
                                                    Detail Orders
                                                </a>
                                            </td>
                                        @elseif ($order->status == 'Pending')
                                            <td>
                                                <a href="{{ $order->checkout_link }}">
                                                    Bayar Sekarang
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('delete-order', ['orderId' => $order->order_id]) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-order-form-{{ $order->order_id }}').submit();">
                                                    Hapus
                                                </a>
                                        
                                                <form id="delete-order-form-{{ $order->order_id }}" action="{{ route('delete-order', ['orderId' => $order->order_id]) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
@include('layouts.footer')
<!-- END Footer -->

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
            stroke="#F96D00" /></svg></div>

<script>
    // Menggunakan JavaScript untuk mengaktifkan tombol checkout hanya jika opsi pengiriman dipilih
    document.getElementById('shippingCost').addEventListener('change', function () {
        document.getElementById('checkoutBtn').disabled = this.value === '0';
    });

    $(document).ready(function () {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function (e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);

        });

        $('.quantity-left-minus').click(function (e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                $('#quantity').val(quantity - 1);
            }
        });

    });

</script>


@endsection
