<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Email - Medpro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .text-medpro { color: #00b5f1; }
        .bg-medpro { background-color: #00b5f1; }
        .hover-bg-medpro:hover { background-color: #0099cc; }
    </style>
</head>
<body class="bg-gray-50 h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-md w-full text-center border border-gray-100">
        
        <!-- Logo / Icon -->
        <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
            <i class="fas fa-envelope-open-text text-5xl text-medpro"></i>
        </div>

        <h1 class="text-2xl font-extrabold text-gray-800 mb-3">Kiểm tra hòm thư của bạn</h1>
        
        <div class="text-gray-600 text-sm mb-6 leading-relaxed">
            Cảm ơn bạn đã đăng ký tài khoản Medpro! <br>
            Chúng tôi đã gửi một liên kết xác thực đến email:
            <span class="font-bold text-gray-900 block mt-1 text-base">{{ Auth::user()->email }}</span>
            <br>
            Vui lòng bấm vào liên kết trong email để kích hoạt tài khoản và bắt đầu đặt lịch khám.
        </div>

        <!-- Thông báo khi đã gửi lại mail -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 text-sm text-green-700 bg-green-100 p-4 rounded-lg border border-green-200 flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>Một liên kết xác thực mới đã được gửi đến email của bạn.</span>
            </div>
        @endif

        <!-- Nút Gửi lại -->
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-medpro hover-bg-medpro text-white font-bold py-3.5 rounded-xl shadow-md hover:shadow-lg transition duration-300 uppercase tracking-wide text-sm mb-4 flex items-center justify-center gap-2">
                <i class="fas fa-paper-plane"></i> Gửi lại email xác thực
            </button>
        </form>

        <!-- Nút Đăng xuất -->
        <div class="border-t pt-4 mt-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-medpro text-sm font-bold underline transition flex items-center justify-center gap-1 mx-auto">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </button>
            </form>
        </div>

    </div>

</body>
</html>