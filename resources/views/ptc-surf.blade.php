<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surfing: {{ $ad->title }} | {{ config('app.name', 'Gardecet') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('dash/img/favicon.png') }}" type="image/x-icon">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        body, html {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #021c09;
        }
        /* Top Navigation Header */
        .ptc-header {
            width: 100%;
            height: 65px;
            background: #031508;
            border-bottom: 2px solid #16391f;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            color: #fff;
            position: relative;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.5);
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .ad-title-badge {
            font-weight: 700;
            font-size: 15px;
            color: #fff;
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .reward-badge {
            background: rgba(137, 169, 49, 0.15);
            border: 1px solid #89a931;
            color: #a9c94a;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .header-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 220px;
        }
        .timer-box {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 18px;
            font-weight: 800;
            color: #f5c518;
        }
        .progress-bar-container {
            width: 100%;
            height: 6px;
            background: #0c2413;
            border-radius: 6px;
            overflow: hidden;
            margin-top: 5px;
        }
        .progress-bar-fill {
            height: 100%;
            width: 100%;
            background: linear-gradient(90deg, #89a931, #a9c94a);
            transition: width 1s linear;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-claim {
            background: linear-gradient(90deg, #89a931, #a9c94a);
            color: #021c09;
            border: none;
            padding: 8px 22px;
            font-size: 14px;
            font-weight: 800;
            border-radius: 20px;
            cursor: pointer;
            display: none;
            align-items: center;
            gap: 6px;
            box-shadow: 0 0 10px rgba(169, 201, 74, 0.4);
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .btn-close-surf {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #fff;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            border-radius: 20px;
            text-decoration: none;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .btn-close-surf:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }
        /* Iframe Container */
        .frame-container {
            width: 100%;
            height: calc(100% - 65px);
            background: #fff;
            position: relative;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>

    <!-- Header Frame Bar -->
    <div class="ptc-header">
        <div class="header-left">
            <span class="ad-title-badge" title="{{ $ad->title }}">
                <i class="fas fa-bullhorn text-warning"></i> {{ $ad->title }}
            </span>
            <div class="reward-badge">
                <i class="fas fa-coins"></i> {{ number_format($reward, 8) }} {{ $coin }}
            </div>
        </div>

        <div class="header-center">
            <div class="timer-box" id="timerDisplay">
                <i class="fas fa-clock"></i> <span id="countdown">{{ $ad->timer }}</span>s
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar-fill" id="progressBar"></div>
            </div>
        </div>

        <div class="header-right">
            <form id="verifyForm" action="{{ route('ptc.verify', ['coin' => strtolower($coin), 'id' => $ad->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn-claim" id="claimBtn">
                    <i class="fas fa-check-circle"></i> Claim Reward
                </button>
            </form>

            <a href="{{ route('ptc', ['coin' => strtolower($coin)]) }}" class="btn-close-surf">
                <i class="fas fa-times"></i> Leave
            </a>
        </div>
    </div>

    <!-- Website Ad Iframe -->
    <div class="frame-container">
        <iframe src="{{ $ad->url }}" sandbox="allow-scripts allow-same-origin allow-forms allow-popups"></iframe>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let totalTime = {{ (int) $ad->timer }};
            let timeLeft = totalTime;
            const countdownEl = document.getElementById('countdown');
            const progressBar = document.getElementById('progressBar');
            const timerDisplay = document.getElementById('timerDisplay');
            const claimBtn = document.getElementById('claimBtn');
            const verifyForm = document.getElementById('verifyForm');

            const timerInterval = setInterval(function () {
                timeLeft--;
                if (timeLeft >= 0) {
                    countdownEl.textContent = timeLeft;
                    const percent = (timeLeft / totalTime) * 100;
                    progressBar.style.width = percent + '%';
                }

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerDisplay.innerHTML = '<span style="color: #a9c94a;"><i class="fas fa-check"></i> Complete!</span>';
                    progressBar.style.width = '0%';
                    claimBtn.style.display = 'inline-flex';
                }
            }, 1000);
        });
    </script>
</body>
</html>
