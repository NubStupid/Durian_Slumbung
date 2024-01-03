@extends('template.customerTemplate')
@section('title')
    <title>Homepage</title>
    @php
        $title = "Home";
    @endphp
@endsection
@push('style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endpush
@section('content')
    <script> 
        AOS.init();
    </script>
    <div class="d-flex justify-content-center my-5" style="overflow: hidden;">
        <div class="container-md p-0 m-0">
            <video preload="TRUE" muted loop autoplay playsinline style="width: 100%;">
                <source src="{{asset('assets/homepage/Home_Video.mp4')}}" type="video/mp4" class="video">
            </video>
            <div class="position-absolute start-50 top-50 translate-middle text-white">
                <h1 style="font-size: 58px;" data-aos="fade-down" data-aos-duration="2000" data-aos-once="true" data-aos-offset="-150"><b>DURIAN SLUMBUNG</b></h1>
                <h3 class="text-center" data-aos="fade-down" data-aos-duration="2000" data-aos-once="true" data-aos-offset="-150"><b>Durian Kebanggaan Kami</b></h3>
            </div>
        </div>
    </div>
    <div class="container-md " style="overflow: hidden;">
        <div data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" class="pb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10  bg-green-light rounded-4 rounded-end p-5">
                        <h2><b>DURIAN YANG MATANG DARI POHONNYA</b></h2>
                        <p style="font-size: 20px;">
                        Dengan pengalaman pengelolaan durian lebih dari 30 tahun kami memiliki pengetahuan yang sangat luas tentang durian dan bagaimana cara
                        mengelolanya dengan baik. Salah satunya yaitu cara agar kami dapat memberikan durian yang memiliki rasa autentik dengan desa kami.
                        Buah durian yang matang dari pohon dan yang mentah rasanya pasti berbeda. Durian yang diambil matang dari pohon rasanya manis dan legit,
                        Sedangkan jika diambil saat mentah rasanya manis biasa. Darisitu durian slumbung yang kita miliki memiliki rasa yang khas dan unik bagi
                        para penggemar buah durian.
                        </p>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <img src="{{asset('assets/homepage/durian.jpg')}}" alt="durian" srcset="" style="height:250px; max-width:auto;" class="rounded-4 rounded-start z-1">
                        <div class="bg-green-secondary position-absolute rounded-4" style="right:0;top:5%;width:250px;height:250px;z-index:0;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div data-aos="fade-left" data-aos-duration="2000" data-aos-once="true" class="pb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                        <div class="bg-green-secondary position-absolute rounded-4" style="left:0; top:5%; width:250px; height:250px; z-index:-1;"></div>
                        <img src="{{asset('assets/homepage/opened-durian.jpg')}}" alt="durian" srcset="" style="height:250px; max-width:auto;" class="rounded-4 rounded-end z-1">
                    </div>
                    <div class="col-10 bg-green-light rounded-4 rounded-start p-5" style="z-index:-2;">
                        <div class="ps-5">
                            <h2><b>HARGA YANG SANGAT TERJANGKAU</b></h2>
                            <p style="font-size: 20px;">
                            Desa Mlancu memiliki lahan pertanian dan perkebunan yang sangat luas dan disana dihasilkan durian yang sangat melimpah,
                            produk yang kami jual berasal dari petani itu sendiri sehingga anda bisa mendapatkan produk yang fresh dan harga yang sangat terjangkau.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div data-aos="fade-up" data-aos-duration="3000" data-aos-once="true" class="pb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10  bg-green-light rounded-4 rounded-end p-5">
                        <h2><b>PROSES KHUSUS PEMANENAN DURIAN SLUMBUNG</b></h2>
                        <p style="font-size: 20px;">
                            Kami memperhatikan teknik pemanenan demi menjaga kualitas terbaik dan cita rasa durian slumbung. Diawali dengan proses penalian dimana jika ada salah satu buah durian yang jatuh dari suatu pohon maka dimulai proses penalian setiap buah durian yang ada di pohon tersebut menggunakan tali rafia. Durian yang matang akan lepas dari tangkai pohonnya dan bergelantungan lewat tali rafia tersebut. Darisitu durian dapat dipanen dan cita rasanya tetap terjaga matang sempurna.
                        </p>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <img src="{{asset('assets/homepage/panen-durian.jpg')}}" alt="durian" srcset="" style="height:250px; max-width:auto;" class="rounded-4 rounded-start z-1">
                        <div class="bg-green-secondary position-absolute rounded-4" style="right:0;top:5%;width:250px;height:250px;z-index:0;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

