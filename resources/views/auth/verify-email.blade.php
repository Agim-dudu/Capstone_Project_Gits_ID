@extends('layouts.guest')

@section('title', 'Verification-Email')

@section('content')

<!-- IMAGE CONTAINER BEGIN -->
<div class="col-lg-6 col-md-6 d-none d-md-block infinity-image-container"></div>
<!-- IMAGE CONTAINER END -->


<!-- FORM CONTAINER BEGIN -->
<div class="col-lg-6 col-md-6 infinity-form-container">
    <div class="col-lg-8 col-md-12 col-sm-8 col-xs-12 infinity-form">
        <div class="text-center mb-3 mt-5">
            @if($perusahaan->logo)
                <img src="{{ asset('storage/logo/' . $perusahaan->logo) }}" width="150px">
            @else
                <img src="{{ asset('storage/logo/logo.png') }}" width="150px">">
            @endif
        </div>

        <div class="reset-form d-block">
            <p class="mb-3 text-white" style="text-align: justify;">
                Terima Kasih yang tulus atas pendaftaran Anda di aplikasi kami. Keputusan Anda untuk bergabung dengan
                kami sangat dihargai, dan kami sangat bersemangat untuk memulai perjalanan ini bersama.Dengan kehadiran
                Anda, kami semakin memperkuat komunitas kami dan berusaha untuk memberikan pengalaman terbaik.
            </p>
            @if (session('status') == 'verification-link-sent')
            <p style="color: rgb(59, 59, 248); font-weight: bold;">Tautan verifikasi baru telah dikirim ke alamat email
                yang Anda berikan saat pendaftaran.</p>
            @endif
            <div class="reset-form d-flex " style="justify-content: space-between;">
                <form class="reset-password-form px-3" method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div class="mb-3">
                        <button type="submit" class="btn">Resent Verification Email</button>
                    </div>
                </form>
                <a href="{{route('logout')}}" style="height:40px;display: inline-block; padding: 10px ; background-color: #4285f4; color: #ffffff; text-decoration: none; border-radius: 20px;">Logout</a>

            </div>
        </div>

        {{-- <div class="reset-confirmation d-none px-3">
            <div class="mb-4">
                <h4 class="mb-3">Link was sent</h4>
                <h6 class="text-white">Please, check your inbox for a password reset link.</h6>
            </div>

            <a href="login.html">
                <button type="submit" class="btn">Login Now</button>
            </a>
            <div>
            </div>
        </div> --}}
        <!-- FORM CONTAINER END -->
    </div>
</div>

@endsection
