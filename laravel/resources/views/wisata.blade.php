@extends('template.customerTemplate')
@section('title')
    <title>Wisata</title>
    @php
        $title = "Wisata";
    @endphp
@endsection
@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="{{asset('style-kalender.css')}}">
    {{-- <script src="{{asset('script-kalender.js')}}"></script> --}}
    <style>
        body{
            overflow-x:hidden;
        }
        #quickA {
            transition: opacity 0.3s ease-in-out;
        }

        /* Set initial opacity to 1 (visible) */
        #quickA.visible {
            opacity: 1;
        }

        /* Set opacity to 0 when element is hidden */
        #quickA.hidden {
            opacity: 0;
        }
    </style>
@endpush
@section('content')
    <script>
        AOS.init();
    </script>
    <div class="container-fluid sticky-top z-2 mb-3 text-center bg-blue-light rounded-4 rounded-top p-3" id="quickA">
        <span class="fw-semibold fs-3">Ingin langsung memesan wisata Dapur Durian? </span>
        <span class="btn bg-green-primary fw-semibold fs-5 scroll-link text-white" data-scroll-target=".kalender">Book Now!</span>
    </div>
    <div class="d-flex justify-content-center my-5">
        <div class="container-md p-0 m-0">
            <video preload="TRUE" muted loop autoplay playsinline style="width: 100%;">
                <source src="{{asset('assets/wisata/Pembuatan Olahan Durian.mp4')}}" type="video/mp4" class="video">
            </video>
            <div class="position-absolute start-50 top-50 translate-middle text-white">
                <h1 style="font-size: 58px; margin-top: 150px;" data-aos="fade-down" data-aos-duration="2000" data-aos-once="true" data-aos-offset="-150"><b>Dapur Durian</b></h1>
                <h3 class="text-center" data-aos="fade-down" data-aos-duration="2000" data-aos-once="true" data-aos-offset="-150" style=""><b>Wisata Pengelolahan Durian</b></h3>
            </div>
        </div>
    </div>
    <div class="row my-5"></div>
    <div class="container-md bg-gray-light bg-opacity-50 rounded-5 p-4" id="targetElement">

        <div class="position-absolute img-transition" style="left:-10vw; z-index:-1;" id="img_left">
            <img src="{{asset('assets/wisata/Durian_Rain.png')}}" alt="" style="max-width:40vw; max-height:auto;">
        </div>

        <div class="text-start fs-1 fw-bold my-5">
            Apa itu Dapur Durian?
        </div>
        <div class="row fs-4 fw-semibold my-5">
            Dapur Durian tidak hanya memberikan kesempatan bagi pengunjung untuk menikmati berbagai hidangan lezat, tetapi juga memberikan wawasan tentang proses pengolahan durian yang cermat. Pengelolaan durian melibatkan serangkaian tahapan, mulai dari panen buah durian yang matang hingga pengolahan menjadi berbagai produk
        </div>

        <div class="position-absolute img-transition" style="right:-10vw; z-index:-1;" id="img_right">
            <img src="{{asset('assets/wisata/Durian_Rain.png')}}" alt="" style="max-width:40vw; max-height:auto; transform:scaleX(-1);">
        </div>

        <div class="row fs-4 fw-semibold my-5">
            Pengunjung dapat melihat secara langsung bagaimana petani memilih durian yang sempurna, teknik penanganan buah, dan proses pemisahan daging durian dari bijinya. Selain itu, wisatawan juga dapat menyaksikan cara durian diolah menjadi es krim, pancake, dodol, atau produk olahan lainnya.
        </div>
        <div class="row fs-4 fw-semibold my-5">
            Pemandangan kebun durian yang teratur dan terawat dengan baik memberikan gambaran tentang betapa pentingnya pertanian berkelanjutan dalam menjaga kualitas buah durian. Dengan demikian, Dapur Durian tidak hanya memberikan pengalaman kuliner, tetapi juga memperkaya pengetahuan pengunjung tentang proses pertanian dan pengelolaan durian yang berkelanjutan.
        </div>
    </div>
    <div class="row my-5"></div>
    <div class="container-md bg-gray-light bg-opacity-50 rounded-5 p-4" id="targetElementQuick">
        <div class="text-start fs-1 fw-bold my-5">
            Bagaimana cara untuk bermain di wisata Dapur Durian?
        </div>
        <div class="row fs-4 fw-semibold my-5">
            Untuk bermain di wisata Dapur Durian, diperlukan untuk memesan sesi yang dapat dipesan dan membayarnya. Lalu pada hari dan jam yang sesuai dengan yang dipesan, datanglah ke lokasi yang tertera.
        </div>
    </div>

    <div class="container-md p-4">
        <div class="text-center fs-1 fw-bold my-4">
            Produk Olahan Durian
        </div>
        <div class="row row-cols-3">
            @foreach ($olahan as $o)
                <div class="col pb-4">
                    <div class="card h-100">
                        <img class="card-img-top" src="{{asset('assets/wisata/olahan/' . $o->img)}}" alt="{{$o->name}}" style="height: 250px; object-fit: cover;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{$o->name}}</h5>
                            <p class="card-text">{{$o->description}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid kalender">
        <div class="row d-flex justify-content-center">
            <h3 class="text-center pt-4 text-dark fw-bolder" style="margin-bottom: 20px; margin-top: 20px;">Ingin memesan? Silakan mengecek sesi yang tersedia!</h3>
            <div class="col-6 mx-5 d-flex justify-content-center">
                <div class="col d-flex justify-content-end" id="kalender">
                    @include('kalender')
                </div>
                <div class="col" id="sesiWisata">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3" style="margin-left: 115px;"></div>
            <div class="col ms-5">
                <?php
                if(url()->current() == url("/wisata")){
                ?>
                <form action="{{ route('wisata')}} " method="post">
                    @csrf
                    <button type="submit" class="btn btn-light ms-5">Book Now</button>
                </form>
                <?php
                }
                else{
                ?>
                <button type="submit" class="btn btn-light ms-5" data-bs-toggle="modal" data-bs-target="#Book" id="bookbtn">Book Now</button>
                <?php    
                }
                ?>
                <div class="mt-4"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Book" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bookPop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header pt-1 pb-2 text-center">
                    <h6 class="modal-title fs-3" id="bookModal">Detail Pemesanan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1">
                    <form action="" method="post" id="booking" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="row">
                                <h5><b>Pilih jadwal</b></h5>
                            </div>
                            @php
                                $t = strtotime("+2 days");
                                $t = date("Y-m-d", $t);

                                $ts = strtotime("+2 months");
                                $ts = date("Y-m-d", $ts);
                            @endphp
                            <div class="row">
                                <div class="col-12">
                                    <input type="date" class="my-2 form-control w-100" name="jadwal" id="pilihTanggal" onchange=tanggal() min='{{$t}}' max="{{$ts}}" required>
                                </div>
                            </div>
                            <div class="row justify-content-evenly mt-2">
                                <div class="col-12 text-center">
                                    <select id="pilihSesi" class="form-select" name="pilihSesi" required onchange="tanggal()">
                                        <option value="1">Sesi 1 (08.00 - 10.00)</option>
                                        <option value="2">Sesi 2 (11.00 - 13.00)</option>
                                        <option value="3">Sesi 3 (14.00 - 16.00)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="row">
                                <div class="col">
                                    <label for="orang"><h6>Jumlah Orang</h6></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input class="w-100 rounded form-control" type="number" name="orang" id="orang" required min=1 max=20 oninput="updateHarga()">
                                        </div>
                                        <div class="col-4">
                                            <h6 class="pt-1">x Rp20.000,00</h6>
                                        </div>
                                    </div>
                                    <!-- <input class="w-100 border border-2 border-dark rounded" type="number" name="orang" id="orang" required="" min=10 max=20 onkeyup=updateHarga()> -->
                                </div>
                                <!-- <div class="col">
                                    <h6>x Rp20.000</h6>
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col" id="warning"></div>
                            </div>
                            <div class="row">
                                <div class="" style="margin-top: 10px"></div>
                                <div class="col-6">
                                    <h6>Total harga: </h6>
                                </div>
                                <!-- <div class="col-1">
                                    <h6>Rp</h6>
                                </div> -->
                                <div class="col-6"><h6>Rp<span id="harga">0</span></h6></div>
                            </div>
                            <div class="row mt-2">
                            <div class="col">
                                <input type="hidden" name="sesi" id="sesi">
                                <input type="hidden" name="hari" id="hari">
                                <button type="submit" class="btn btn-success w-100"><h6 class="m-0 p-1">Add To Cart</h6></button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @if(session('showPopup'))
    <div class="modal fade" id="popup" tabindex="-1" aria-labelledby="popup" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{asset('assets/misc/berhasiladdtocart.gif')}}" class="my-2" alt="" width="max-content" height="110px">
              <h5 class="py-2">Berhasil Menambah ke keranjang!</h5>
              <button type="button" class="btn btn-secondary mx-5 w-0" data-bs-dismiss="modal" aria-label="Close" id="ok">Oke!</button>
            </div>
          </div>
        </div>
    </div>
    @endif

    @if(session('gagal'))
    <div class="modal fade" id="gagal" tabindex="-1" aria-labelledby="gagal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{asset('assets/misc/frowning.gif')}}" class="my-2" alt="" width="max-content" height="110px">
              <h5 class="py-2">Maaf slot tidak mencukupi</h5>
              <button type="button" class="btn btn-secondary mx-5 w-0" data-bs-dismiss="modal" aria-label="Close" id="ok">Oke!</button>
            </div>
          </div>
        </div>
    </div>
    @endif
@endsection
@push('script')
    <script>
       $(document).ready(function () {
            showModal();
            showGagal();
            function showModal() {
                $('#popup').modal('show');
            }
            function showGagal() {
                $('#gagal').modal('show');
            }
            $(window).scroll(function () {
                var targetElement = $("#targetElement");
                var scrollPosition = $(window).scrollTop();
                var targetOffset = targetElement.offset().top;
                var targetBottom = targetElement.offset().top + targetElement.outerHeight();

                // Adjust the offset threshold as needed
                var offsetThreshold = 250;
                var targetElementQuickAccess = $("#targetElementQuick");
                var quickOffset = targetElementQuickAccess.offset().top;

                if (scrollPosition > targetOffset - offsetThreshold && scrollPosition < targetBottom - offsetThreshold/2) {
                    // Move to the right and scale up
                    $("#img_left").css({
                        transform: 'scale(1.5) translateX(20vw) rotate(-15deg)'
                    });
                    $("#img_right").css({
                        transform: 'scale(1.1) translateX(-20vw) rotate(10deg)'
                    });
                } else {
                    // Reset to original position and size
                    $("#img_left").css({
                        transform: 'scale(1) translateX(0) rotate(0deg)'
                    });
                    $("#img_right").css({
                        transform: 'scale(1) translateX(0) rotate(0deg)'
                    });
                }
                if(scrollPosition > quickOffset){
                    $('#quickA').removeClass('visible').addClass('hidden');
                }else{
                    $('#quickA').removeClass('hidden').addClass('visible');
                }
            });
        });
        $(document).ready(function () {
            // Smooth scroll to the target element
            $('.scroll-link').on('click', function () {
                var targetClass = $(this).data('scroll-target');
                var targetElement = $(targetClass);

                $('html, body').animate({
                    scrollTop: targetElement.offset().top
                }, 100); // Adjust the duration as needed
            });
        });

        // function sesi(){
        //     // console.log("Function Called");
        //     var selectedSesi = document.getElementById('pilihSesi').value;
        //     console.log(selectedSesi);
        //     var olahan = document.getElementById('pilihOlahan').value;
        // }

        function tanggal() {
            var selectedDate = document.getElementById('pilihTanggal').value;
            var dateObject = new Date(selectedDate);
            var dayOfWeek = dateObject.getDay();
            var dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var dayName = dayNames[dayOfWeek];
            // console.log(dayName);
            var hari = 0;
            if(dayName == 'Sunday'){
                hari = 0;
            }
            else if(dayName == 'Monday'){
                hari = 1;
            }
            else if(dayName == 'Tuesday'){
                hari = 2;
            }
            else if(dayName == 'Wednesday'){
                hari = 3;
            }
            else if(dayName == 'Thursday'){
                hari = 4;
            }
            else if(dayName == 'Friday'){
                hari = 5;
            }
            else if(dayName == 'Saturday'){
                hari = 6;
            }
            // console.log(hari);
            var selectElement = document.getElementById('pilihSesi');
            selectElement.options[0].text = "Sesi 1 (08.00 - 10.00)";
            selectElement.options[1].text = "Sesi 2 (11.00 - 13.00)";
            selectElement.options[2].text = "Sesi 3 (14.00 - 16.00)";
            var dayName = "";

            if (hari == 1 || hari == 3 || hari == 5) {
                selectElement.options[0].text += " - Dodol Durian";
                selectElement.options[1].text += " - Kolak Durian";
                selectElement.options[2].text += " - Ketan Durian";
            } 
            else if (hari == 2 || hari == 4 || hari == 6){
                selectElement.options[0].text += " - Pancake Durian";
                selectElement.options[1].text += " - Es Krim Durian";
                selectElement.options[2].text += " - Puding Durian";
            }
            else {
                selectElement.options[0].text = "Sesi 1 (08.00 - 10.00)";
                selectElement.options[1].text = "Sesi 2 (11.00 - 13.00)";
                selectElement.options[2].text = "Sesi 3 (14.00 - 16.00)";
            }

            var sesi = document.getElementById("pilihSesi").value;

            // console.log(selectElement.value + " " + sesi);
            document.getElementById('sesi').value = sesi;
            document.getElementById('hari').value = hari;
        }

        function updateHarga() {
            var jum = parseInt(document.getElementById("orang").value)
            if(jum > 0 && jum < 21) {
                const options = {
                    style: 'decimal',
                    currency: 'IDR',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                }
                document.getElementById("warning").innerHTML = ""
                document.getElementById("harga").innerHTML = new Intl.NumberFormat('id-ID', options).format((jum * 20000))
                // document.getElementById("harga").innerHTML = (jum * 20000)
                // document.getElementById("harga").innerHTML = "<h6>" + (jum * 20000) + "</h6>"
            } else {
                if(!isNaN(jum))
                    document.getElementById("warning").innerHTML = '<div class="alert alert-danger mt-1" role="alert"><h6 class="my-auto">Jumlah orang harus 1-20</h6></div>'
                document.getElementById("harga").innerHTML = "0"
            }
        };
        function updateCalendar(act) {
            const month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            var idx = month.indexOf($("#bulan").html()), tahun = parseInt($("#tahun").html()), bulan;

            if(act == 'Right')
                idx++;
            else
                idx--;

            if(idx < 0) {
                tahun--;
                idx = 11;
            }
            else if(idx > 11)
                tahun++;
            idx = idx % 12 + 1;

            // var date1 = new Date($('#firstPayDate').val());
            // var date2 = new Date($('#loanTrm').val());
            // var datediff = date2 - date1;
            var now = new Date(), newMonth = new Date(tahun, idx-1), nowMonth = new Date(now.getFullYear(), (now.getMonth())), selisih = Math.round(((newMonth - nowMonth) % 31536000000)/2628000000);
            // console.log(tahun + "-" + idx);
            // console.log(now.getFullYear() + "-" + (now.getMonth()+1));
            // console.log(newMonth)
            // console.log(nowMonth)
            // console.log(Math.round(((newMonth - nowMonth) % 31536000000)/2628000000))
            // if(selisih >= 0 && selisih < 3)
            // {
            var prev = document.getElementById("clicked")
            $("sesiOlahan").html("");
            if(prev != null && prev.classList.contains('btn-dark')) {
                prev.classList.remove('btn-dark');
                prev.removeAttribute("id", "clicked");
            }

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            $("#kalender").load('/kalender',{
                thn:tahun,
                bln:idx,
                selisih:selisih
            },function (response) {
                $('#kalender').html(response);
            })
            // }
            // if(selisih == 0)
            //     $("#btnLeft").prop("disabled",true);
            // else if(selisih == 3)
            //     $("#btnRight").prop("disabled",true);
            // else
            // {
            //     $("#btnLeft").prop("disabled",false);
            //     $("#btnRight").prop("disabled",false);
            // }
            // console.log(new Date($('#firstPayDate').val()));

        };
        function showBook(e) {
            var prev = document.getElementById("clicked")
            if(prev != null && prev.classList.contains('btn-dark')) {
                prev.classList.remove('btn-dark')
                prev.removeAttribute("id", "clicked")
            }
            e.setAttribute("id", "clicked")
            e.classList.add('btn-dark')

            const month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
            m = month.indexOf(document.getElementById("bulan").innerHTML) + 1
            var tgl = m + '-' + e.innerHTML + '-' + document.getElementById("tahun").innerHTML
            let parse = Date.parse(tgl);
            let date = new Date(parse);
            tgl = date.getFullYear() + "-" + m.toString().padStart(2, '0') + "-" + date.getDate().toString().padStart(2, '0');

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            $("#sesiWisata").load('/sesi',{
                tgl:tgl
            },function (response) {
                $('#sesiWisata').html(response);
            })
        };

        // function pilihTgl() {
        //     console.log('Function called!');
        //     var tgl = document.getElementById("pilihTanggal").value;
        //     var xhr = new XMLHttpRequest();
        //     xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
        //     xhr.onreadystatechange = function() {
        //         if(xhr.readyState == 4 && xhr.status == 200) {
        //             // console.log(tgl);
        //             var def = '<option selected disabled>Pilih sesi</option>';
        //             document.getElementById("pilihSesi").innerHTML = def + xhr.responseText;
        //         }
        //     }
        //     xhr.open('GET', "pilihSesi.php?tgl='" + tgl + "'", true);
        //     xhr.send();
        // };

        // function cek() {
            // console.log('Function called!');
            // console.log("masuk")
            // console.log()
            // var tgl = document.getElementById("pilihTanggal").value;

            // var xhr = new XMLHttpRequest();
            // xhr.onreadystatechange = function() {
            //     if(xhr.readyState == 4 && xhr.status == 200) {
            //         document.getElementById("warningGambar").innerHTML = xhr.responseText;
            //     }
            // }
            // xhr.open('GET', "cekGambar.php", true);
            // xhr.send();
            // console.log(document.getElementById("pilihTanggal").value)
            // var jum = parseInt(document.getElementById("orang").value)
            // if(jum > 9 && jum < 21) {
            //     document.getElementById("warning").innerHTML = ""
            //     document.getElementById("harga").innerHTML = "<h6>" + (jum * 20000) + "</h6>"
            // } else {
            //     if(!isNaN(jum))
            //         document.getElementById("warning").innerHTML = '<div class="alert alert-danger" role="alert"><h6>Jumlah orang harus 10-20 orang</h6></div>'
            //     document.getElementById("harga").innerHTML = "<h6>0</h6>"
            // }
        // };

    </script>
@endpush
