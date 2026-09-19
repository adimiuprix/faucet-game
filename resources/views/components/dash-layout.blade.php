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

            /* Claim button styles */
            .claim-button:disabled {
                opacity: 0.6;
                cursor: not-allowed;
                background: linear-gradient(135deg, #6c757d, #495057) !important;
            }
            
            .claim-button.ready {
                animation: pulse 2s infinite;
            }
            
            @keyframes pulse {
                0% {
                    box-shadow: 0 0 0 0 rgba(123, 47, 247, 0.7);
                }
                70% {
                    box-shadow: 0 0 0 10px rgba(123, 47, 247, 0);
                }
                100% {
                    box-shadow: 0 0 0 0 rgba(123, 47, 247, 0);
                }
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
            // SweetAlert untuk success message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: @json(session('success')),
                    showConfirmButton: true,
                    confirmButtonColor: '#7b2ff7',
                    timer: 5000,
                    timerProgressBar: true,
                });
            @endif

            // SweetAlert untuk error message
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: @json(session('error')),
                    showConfirmButton: true,
                });
            @endif
        </script>

        <script>
            // Timer countdown untuk claim button (universal untuk semua halaman)
            $(document).ready(function() {
                const $claimButton = $('#claimButton');
                
                // Cek apakah ada claim button di halaman ini
                if ($claimButton.length === 0) return;

                // Ambil nextClaim dari data attribute
                const nextClaimAt = parseInt($claimButton.data('next-claim')) || 0;
                let remainingSeconds = Math.max(0, nextClaimAt - Math.floor(Date.now() / 1000));

                const $buttonText = $('#buttonText');
                const $buttonIcon = $claimButton.find('i');

                function formatTime(seconds) {
                    const minutes = Math.floor(seconds / 60);
                    const secs = seconds % 60;
                    return `${minutes}:${secs.toString().padStart(2, '0')}`;
                }

                function updateButton() {
                    if (remainingSeconds <= 0) {
                        // Timer habis - aktifkan tombol
                        $buttonIcon.attr('class', 'far fa-check-circle');
                        $buttonText.text('Claim Now');
                        $claimButton.prop('disabled', false);
                        $claimButton.addClass('ready');
                        clearInterval(countdownInterval);
                        return;
                    }

                    // Masih cooldown - tampilkan timer
                    $buttonIcon.attr('class', 'far fa-clock');
                    $buttonText.text(`Wait ${formatTime(remainingSeconds)}`);
                    $claimButton.prop('disabled', true);
                    $claimButton.removeClass('ready');
                    remainingSeconds--;
                }

                // Update immediately
                updateButton();

                // Update setiap detik
                const countdownInterval = setInterval(updateButton, 1000);
            });
        </script>

        <script>
            // copy referral
            const copyBtn = document.querySelector(".refer-copy-btn");
            const copyTxt = document.querySelector("#refer-code");

            if (copyBtn && copyTxt) {
                copyBtn.addEventListener("click", () => {
                    copyTxt.select();
                    copyTxt.setSelectionRange(0, 99999);

                    navigator.clipboard.writeText(copyTxt.value);

                    console.log(copyTxt.value);

                    Swal.fire("Copied", "", "success");
                });
            }
        </script>

    </body>
</html>
