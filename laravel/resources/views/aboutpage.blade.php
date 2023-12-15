@extends('template.customerTemplate')
@section('title')
    <title>About</title>
    @php
        $title = "About";
    @endphp
@endsection

@section('content')
<script>
    AOS.init();
</script>
<div class="container-fluid p-0 m-0 con">
    <video preload="TRUE" muted loop autoplay playsinline style="width: 100%;">
        <source src="asset/Home_Video.mp4" type="video/mp4" class="video">
    </video>
    <div class="overlay3">
        <h1 style="font-size: 58px;" data-aos="fade-down" data-aos-duration="2000" data-aos-once="true" data-aos-offset="-150"><b>DESA MLANCU</b></h1>
    </div>
</div>

<div class="container-fluid scolor-5 py-3" style="overflow: hidden;">
    <section class="hidden-1">
        <div class="container-fluid custom-box scolor-4" style="width: 1750px; margin-bottom: 30px; margin-top: 50px;" data-aos="fade" data-aos-duration="2000" data-aos-once="true" data-aos-offset="-150" data-aos-delay="1000">
            <h2><center><b>Desa Mlancu</b></center></h2>
            <center><p style="font-size: 21px;">
            Mlancu adalah desa yang berada di kecamatan Kandangan, Kabupaten Kediri, Jawa Timur, Indonesia. Secara letaknya, Desa Mlancu berbatasan dengan Kecamatan Kasembon kabupaten malang. Desa yang terletak di dataran tinggi dan berudara dingin ini mayoritas penduduknya berprofesi sebagai Petani, Pedagang, Peternak, dan Swasta. Pada Sumber Daya Alam memiliki potensi yang baik terutama di sektor Pertanian dan Perkebunan. Yang mana terdapat banyak hasil bumi seperti Padi, Jagung, Cengkeh, Durian, Alpukat, Palawija, dll. Pada sektor Peternakan terdapat potensi yang baik seperti sapi perah, kambing dll.
            <br><br>
            Desa Mlancu tergolong desa yang cukup maju mempunyai karakter yang kompak. Oleh karena itu dari generasi ke generasi selalu mempunyai pemuda-pemuda yang berprestasi, modern dan berwawasan.
            </p></center>
        </div>
    </section>
    <br>
    <h1 data-aos="fade-left" data-aos-duration="1000" data-aos-once="true" data-aos-offset="-150"><center><b>Video terpopuler di channel YouTube kami</b></center></h1>
    <br><br>
    <center><iframe width="560" height="315" src="https://www.youtube.com/embed/jggQF6EhMR8?si=qzbiq3w6NarEjwyS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="border-radius: 10px;"></iframe></center>
    <br><br>
    <h1 data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" data-aos-offset="-150"><center><b>Penghargaan</b></center></h1>

    <div class="row row-cols-1 row-cols-md-4 g-4 p-5" style="width: 100%;">

        <div class="col" data-aos="fade-up" data-aos-duration="2000" data-aos-once="true" data-aos-offset="-250" data-aos-delay="1500">
            <div class="card h-100 scolor-2 text-dark" style="border-radius: 10px;">
                <img src="asset/j4.jpg" class="card-img-top" alt="..." style="border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title"><b>Desa Mlancu meraih Juara Nasional Penghijauan</b></h5>
                    <p class="card-text">Pada tahun 1990, Desa Mlancu mendapat penghargaan penghijauan pada tingkat Nasional.</p>
                </div>
            </div>
        </div>

        <div class="col" data-aos="fade-up" data-aos-duration="2000" data-aos-once="true" data-aos-offset="-250" data-aos-delay="500">
            <div class="card h-100 scolor-2 text-dark" style="border-radius: 10px;">
                <img src="asset/j2.jpg" class="card-img-top" alt="..." style="border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title"><b>Desa Mlancu meraih Juara 2 dalam Kompetisi Durian</b></h5>
                    <p class="card-text">Pada tahun 2016, Desa Mlancu meraih juara 2 dalam kompetisi Festival Durian di Medowo, Kec. Kandangan, Kabupaten Kediri.</p>
                </div>
            </div>
        </div>

        <div class="col" data-aos="fade-up" data-aos-duration="2000" data-aos-once="true" data-aos-offset="-250" data-aos-delay="1000">
            <div class="card h-100 scolor-2 text-dark" style="border-radius: 10px;">
                <img src="asset/j3.jpg" class="card-img-top" alt="..." style="border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title"><b>Sertifikat Pengakuan Durian Slumbung</b></h5>
                    <p class="card-text">Pada tahun 2018, Durian dari Desa Mlancu diakui oleh Bupati Kediri, sehingga namanya berubah menjadi Durian Slumbung.</p>
                </div>
            </div>
        </div>

        <div class="col" data-aos="fade-up" data-aos-duration="2000" data-aos-once="true" data-aos-offset="-250" data-aos-delay="1500">
            <div class="card h-100 scolor-2 text-dark" style="border-radius: 10px;">
                <img src="asset/J1d.jpg" class="card-img-top" alt="..." style="border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title"><b>Gubernur Prov. Jatim berkunjung ke Desa Mlancu</b></h5>
                    <p class="card-text">Pada tahun 2019, Gubernur Prov. Jawa Timur yaitu Dra. Hj. Khofifah Indar Parawansa, M.Si. berkunjung ke Desa Mlancu untuk mencicipi Durian Slumbung.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
