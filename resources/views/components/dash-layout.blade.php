<html lang="en" class="hydrated">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="color-scheme" content="light dark" />
        <link rel="icon" type="image/png" href="{{ asset('dash/img/favicon.ico') }}" />
        <!-- ##########  fontawsome ########## -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

        <!-- ########## Boxicons ########## -->
        <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />

        <!-- ########## materials icon ##########  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

        <!-- ##########  bootstrap stylesheet ########## -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

        <!-- ########## main stylesheet ########## -->
        <link rel="stylesheet" href="{{ asset('dash/css/dashboard.css') }}" />

        <!-- ########## sweat alert2 ########## -->
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.25/dist/sweetalert2.min.css" rel="stylesheet">
        
        <title>Dashboard | {{ $sitename }}</title>

        <style>
            .mx-message {
                margin-left: 10px;
                margin-right: 10px;
            }
            .topbar_link_icon {
                margin: 0px 5px;
                width: 32px;
                background: linear-gradient(to bottom, #799c2a, #3b6b10);
                border-radius: 50%;
                height: 32px;
                display: flex;
                justify-content: center;
                align-content: center;
            }

            .topbar_link_icon > a > img {
                margin-top: 6.5px;
                width: 20px;
            }
            
            /* Logo theme transition */
            .logo {
                transition: opacity 0.3s ease-in-out;
            }
            
            .logo-light,
            .logo-dark {
                max-width: 100%;
                height: auto;
            }
        </style>
    </head>
    <body id="body" class="mm-active">
        <div class="wrapper-parent mm-show">
            
            <!-- ########## Sidebar Menu ########## -->
            <x-sidebar />

            {{ $slot }}

        </div>
        
        <!-- ########## js ########## -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.25/dist/sweetalert2.all.min.js"></script>
        <script src="{{ asset('dash/js/dash.js') }}"></script>
        <script>
            @if(session()->has('success'))
                Swal.fire({
                    icon: '{{ session('success') ? 'success' : 'error' }}',
                    title: '{{ session('success') ? 'Success!' : 'Oops...' }}',
                    text: '{{ session('message') }}',
                    @if(session('success'))
                    timer: 3000,
                    timerProgressBar: true,
                    @endif
                });
            @elseif(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                });
            @endif
        </script>

        <script>
            // Menampilkan SweetAlert2 saat berhasil redeem code
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: @json(session('success')),
                    showConfirmButton: true,
                    confirmButtonColor: '#7b2ff7',
                    timer: 3000
                });
            @endif

            // Menampilkan SweetAlert2 saat gagal redeem code
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: @json(session('error')),
                });
            @endif
        </script>

        <script>
            // copy referral
            const copyBtn = document.querySelector(".refer-copy-btn");
            const copyTxt = document.querySelector("#refer-code");

            copyBtn.addEventListener("click", () => {
                copyTxt.select();
                copyTxt.setSelectionRange(0, 99999);

                navigator.clipboard.writeText(copyTxt.value);

                console.log(copyTxt.value);

                Swal.fire("Copied", "", "success");
            });
        </script>

        @if(session('success') !== null)
        <script>
            @if(session('success'))
                Swal.fire("{{ session('message') }}", "", "success");
            @else
                Swal.fire("{{ session('message') }}", "", "error");
            @endif
        </script>
        @endif


    </body>
</html>
