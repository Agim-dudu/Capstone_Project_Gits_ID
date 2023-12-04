@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<!-- Header -->
@include('layouts.header')
<!-- END Header -->

<!-- nav -->
@include('layouts.navigation')
<!-- END nav -->

<!-- Gambar Hero yang Dapat Digunakan Kembali -->
@component('components.hero-bg', [
'backgroundImageUrl' => 'http://127.0.0.1:8000/assets/images/bg-cart.jpg',
'homeUrl' => '/',
'homeText' => 'Beranda',
'pageName' => 'Detail Order',
'pageTitle' => 'Detail Order',
])
@endcomponent

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 ftco-animate">
                <div class="cart-detail cart-total p-3 p-md-4">
                    <h2 class="billing-heading mb-4">Detail Order</h2>
                    <p class="d-flex">
                        <span>Nama Product :</span>
                        <span>
                            <ul>
                                @foreach($order->items as $item)
                                <li>{{ $item->product->name }} <br> {{ $item->quantity }} Kg <br> Rp.
                                    {{number_format($item->price, 0, ',', '.') }}</li>
                                @endforeach
                            </ul>
                        </span>
                    </p>
                    <p class="d-flex">
                        <span>Ongkir</span>
                        <span>: Rp. {{ number_format($order->ongkir, 0, ',', '.') }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Jasa Pengiriman</span>
                        <span>: {{$order->service}}</span>
                    </p>
                    <p class="d-flex">
                        <span>Total Bayar</span>
                        <span>: Rp. {{$order->gross_amount}}</span></span>
                    </p>
                    <p class="d-flex">
                        <span>No Resi</span>
                        <span>: {{$order->resi}}</span>
                    </p>
                    <p class="d-flex">
                        <span>Status Bayar</span>
                        <span>: {{$order->status}}</span>
                    </p>
                </div>
            </div>
            <div class="col-xl-6 ftco-animate">
                <div class="cart-detail cart-total p-3 p-md-4">
                    <h2 class="billing-heading mb-4">Detail Pengantaran</h2>
                    <p class="d-flex">
                        <span>Penerima</span>
                        <span>: {{ $order->customer->name }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Kota Asal</span>
                        <span>: {{ $order->customer->city }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Detail Alamat</span>
                        <span>: {{ $order->customer->address }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Code Pos</span>
                        <span>: {{ $order->customer->postal_code }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Nama Pengirim</span>
                        <span>: {{ $order->seller->nama_perusahaan }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Kota Pengirim</span>
                        <span>: {{ $order->seller->city }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Detail Alamat</span>
                        <span>: {{ $order->seller->address }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Code Pos</span>
                        <span>: {{ $order->seller->postal_code }}</span>
                    </p>
                    @if($order->status == 'capture')
                    <p><a href="{{ route('eksport.pdf.invoice', ['orderId' => $order->order_id]) }}"
                            class="btn btn-primary py-3 px-4">Cetak Invoice</a></p>
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
    $(document).ready(function () {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function (e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

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
