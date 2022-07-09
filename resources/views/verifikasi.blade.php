<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Digital Signature</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('') }}assets/images/favicon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('') }}assets/images/favicon.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('') }}assets/images/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('') }}assets/images/favicon.png">
    <link rel="manifest" href="{{ asset('') }}asset/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="{{ asset('') }}asset/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="{{ asset('') }}asset/css/theme.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
	    $(document).ready(function(){
		  $("#exampleModal").modal('show');
	  });
</script>
  </head>

  <body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand" href="index.html"><img src="{{ asset('') }}assets/images/logo.svg" width="200" alt="logo" /></a><button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
              @auth
              <li class="nav-item dropdown">
                <a class="nav-link dropdown toggle" data-bs-toggle="dropdown" href="#" id="navbarDropdown" role="button" aria-expanded="false">
                  Welcome back, {{ auth()->user()->nama }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li class="nav-item px-2"><a class="dropdown-item" href="/dashboard">My Dashboard</a></li>
                  <li class="nav-item px-2">
                    <form action="/logout" method="post">
                      @csrf
                      <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                  </li>
                </ul>
              </li>
              @else
              </ul><a class="btn btn-sm btn-outline-primary rounded-pill order-1 order-lg-0 ms-lg-4 {{ Request::is('login') ? 'active' : '' }}" href="/login">Log In</a>
              @endauth
          </div>
        </div>
      </nav>
      <section class="py-xxl-10 pb-0" id="home">
        <div class="bg-holder bg-size" style="background-image:url({{ asset('') }}asset/img/gallery/hero-bg.png);background-position:top center;background-size:cover;"></div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="row min-vh-xl-100 min-vh-xxl-25">
            <div class="col-md-5 col-xl-6 col-xxl-7 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 w-100" src="{{ asset('') }}asset/img/gallery/bg.svg" alt="hero-header" /></div>
            <div class="col-md-75 col-xl-6 col-xxl-5 text-md-start text-center py-2">
              <h3 class="fw-light font-base fs-6 fs-xxl-7"><strong>Sistem Kendali Dokumen Jurusan Ilmu Komputer</strong></h3>
              <p class="fs-1 mb-2">Dokumen jurusan Ilmu Komputer yang diterbitkan <br />secara digital dapat diperiksa keasliannya dengan menggunakan halaman ini. </p>
              <div class="position-relative w-100 mt-3">
                <form action="{{ route('search') }}" method="GET">
                  <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" name="search" placeholder="Kode Hash" style="height: 58px;">
                  <button type="submit" class="btn btn-primary rounded-pill py-2 px-3 shadow-none position-absolute top-0 end-0 m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Periksa</button>
                </form>
            </div>
            </div>
          </div>
        </div>
      </section>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

        <!-- Modal -->
<div class="modal fade modal-open" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hasil Verifikasi:</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <table class="table table-borderless">
                <tbody class="tbody">
                    <tr>
                        <th scope="col-5">Status</th>
                        <td scope="col">:<strong> {{ $qrcodes ? 'Valid' : 'Invalid' }} </strong></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th scope="col-5">Author</th>
                        <td scope="col">: {{ $qrcodes ? $qrcodes->dokumen->user->nama : '' }}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th scope="col">Judul Dokumen</th>
                        <td scope="col">: {{ $qrcodes ? $qrcodes->dokumen->judul : '' }}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th scope="col">Kategori Dokumen</th>
                        <td scope="col">: {{ $qrcodes ? $qrcodes->dokumen->kategori->nama : '' }}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th scope="col">Hash</th>
                        <td scope="col">: {{ $qrcodes ? $qrcodes->hash : '' }}</td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th scope="col">Tanggal Buat</th>
                        <td scope="col">: {{ $qrcodes ? $qrcodes->created_at : '' }}</td>
                    </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th scope="col">Unduh Dokumen</th>
                    @if($qrcodes)
                      <td scope="col">: <a href="/cetak/{{$qrcodes->hash}}" class="btn btn-primary btn-sm">Cetak</a></td>
                    @endif
                  </tr>
                </tbody>
            </table>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    {{-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{ asset('') }}asset/vendors/@popperjs/popper.min.js"></script>
    <script src="{{ asset('') }}asset/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="{{ asset('') }}asset/vendors/is/is.min.js"></script>
    <script src="https://scripts.sirv.com/sirvjs/v3/sirv.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('') }}asset/vendors/fontawesome/all.min.js"></script>
    <script src="{{ asset('') }}asset/js/theme.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&amp;family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100&amp;display=swap" rel="stylesheet">

    {{-- <script type="text/javascript">
        exampleModal.show()
    </script> --}}
  </body>

</html>