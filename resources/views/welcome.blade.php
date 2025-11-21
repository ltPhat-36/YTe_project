<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medpro - Đặt lịch khám bệnh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- THÊM THƯ VIỆN THÔNG BÁO (TOASTIFY) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        body { font-family: 'Nunito', sans-serif; }
        .hero-bg {
            background: linear-gradient(to right, #eef6ff, #ffffff);
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- HEADER -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-8">
                <a href="/" class="text-2xl font-bold text-cyan-500">medpro</a>
                <nav class="hidden md:flex gap-6 text-gray-600 font-medium">
                    <a href="#" class="hover:text-cyan-500">Cơ sở y tế</a>
                    <a href="#" class="hover:text-cyan-500">Dịch vụ y tế</a>
                    <a href="#" class="hover:text-cyan-500">Tin tức</a>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden lg:block">
                    <p class="text-xs text-gray-500">Hỗ trợ đặt khám</p>
                    <p class="text-orange-500 font-bold text-lg">1900 2115</p>
                </div>
                
                <a href="#" class="bg-yellow-400 text-white px-4 py-2 rounded-full font-bold text-sm hover:bg-yellow-500">
                    Tải ứng dụng
                </a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-cyan-500 font-bold border border-cyan-500 px-4 py-2 rounded-full text-sm hover:bg-cyan-50">
                            Chào, {{ Auth::user()->name }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-cyan-500 font-bold border border-cyan-500 px-4 py-2 rounded-full text-sm hover:bg-cyan-50">
                            Tài khoản
                        </a>
                    @endauth
                @endif

            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="hero-bg py-16 relative overflow-hidden">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8">
                Kết nối Người Dân với <br> Cơ sở & Dịch vụ Y tế hàng đầu
            </h1>

            <div class="max-w-3xl mx-auto bg-white rounded-full shadow-lg p-2 flex items-center">
                <svg class="w-6 h-6 text-gray-400 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Tìm kiếm bệnh viện, chuyên khoa, bác sĩ..." class="w-full p-3 text-gray-700 outline-none rounded-full">
            </div>

            <div class="mt-6 space-y-2 text-gray-600 text-sm md:text-base">
                <p class="flex justify-center items-center gap-2">
                    <span class="text-green-500">✔</span> Đặt khám nhanh - Lấy số thứ tự trực tuyến
                </p>
                <p class="flex justify-center items-center gap-2">
                    <span class="text-green-500">✔</span> Đặt khám theo giờ - Giảm thời gian chờ đợi
                </p>
            </div>
        </div>
        
        <img src="https://medpro.vn/_next/image?url=https%3A%2F%2Fcdn-pkh.longvan.net%2Fprod-partner%2Ffa156640-f6c4-4590-8496-622527b77463-1729588241524.png&w=3840&q=75" 
             class="absolute bottom-0 right-0 w-1/3 hidden lg:block opacity-90" alt="Doctor">
        <img src="https://medpro.vn/_next/image?url=https%3A%2F%2Fcdn-pkh.longvan.net%2Fprod-partner%2F1d07c2d8-0739-4499-951d-034f0c35b81c-1729588241499.png&w=3840&q=75" 
             class="absolute bottom-0 left-0 w-1/4 hidden lg:block opacity-90" alt="Nurse">
    </section>

    <!-- SERVICE ICONS -->
    <section class="container mx-auto px-4 -mt-10 relative z-20 pb-10">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
            <div class="bg-white p-4 rounded-xl shadow-md text-center hover:shadow-xl transition cursor-pointer group">
                <div class="w-12 h-12 mx-auto bg-blue-100 text-blue-500 rounded-full flex items-center justify-center mb-3 group-hover:bg-blue-500 group-hover:text-white transition">📅</div>
                <h3 class="font-bold text-gray-700 text-sm">Đặt khám tại cơ sở</h3>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-md text-center hover:shadow-xl transition cursor-pointer group">
                <div class="w-12 h-12 mx-auto bg-green-100 text-green-500 rounded-full flex items-center justify-center mb-3 group-hover:bg-green-500 group-hover:text-white transition">🩺</div>
                <h3 class="font-bold text-gray-700 text-sm">Đặt khám chuyên khoa</h3>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-md text-center hover:shadow-xl transition cursor-pointer group">
                <div class="w-12 h-12 mx-auto bg-purple-100 text-purple-500 rounded-full flex items-center justify-center mb-3 group-hover:bg-purple-500 group-hover:text-white transition">📹</div>
                <h3 class="font-bold text-gray-700 text-sm">Gọi video với bác sĩ</h3>
            </div>
            @foreach($specialties as $spec)
            <div class="bg-white p-4 rounded-xl shadow-md text-center hover:shadow-xl transition cursor-pointer group">
                <div class="w-12 h-12 mx-auto bg-gray-100 text-gray-500 rounded-full flex items-center justify-center mb-3">🏥</div>
                <h3 class="font-bold text-gray-700 text-sm">{{ $spec->name }}</h3>
            </div>
            @endforeach
        </div>
    </section>

    <!-- BỆNH VIỆN NỔI BẬT -->
    <section class="container mx-auto px-4 py-10 bg-white">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-l-4 border-cyan-500 pl-3">Cơ sở y tế nổi bật</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($hospitals as $hospital)
            <div class="bg-white rounded-lg shadow overflow-hidden border hover:border-cyan-500 transition group">
                <div class="h-40 bg-gray-100 flex items-center justify-center text-gray-400 group-hover:bg-cyan-50 transition">
                    <span class="text-lg font-bold text-cyan-600">{{ $hospital->name }}</span>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg text-gray-800 group-hover:text-cyan-600">{{ $hospital->name }}</h3>
                    <p class="text-gray-500 text-sm mt-1 truncate">{{ $hospital->address }}</p>
                    <div class="mt-4 pt-4 border-t flex justify-between items-center">
                        <span class="text-orange-500 font-bold text-sm">📞 {{ $hospital->hotline }}</span>
                        <button class="text-cyan-500 font-bold text-sm hover:bg-cyan-500 hover:text-white px-3 py-1 rounded-full transition">Đặt ngay</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- BÁC SĨ TIÊU BIỂU -->
    <section class="container mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-l-4 border-blue-500 pl-3">Bác sĩ tiêu biểu</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($doctors as $doctor)
            <a href="{{ route('doctor.show', $doctor->id) }}" class="block bg-white p-4 rounded-lg shadow border hover:shadow-lg hover:border-cyan-500 transition text-center cursor-pointer">
                <div class="w-24 h-24 mx-auto bg-gray-200 rounded-full mb-3 flex items-center justify-center overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&background=random" alt="Avatar">
                </div>
                <h3 class="font-bold text-gray-800 group-hover:text-cyan-600">{{ $doctor->name }}</h3>
                <p class="text-blue-500 text-sm text-sm">{{ $doctor->specialty->name ?? 'Đa khoa' }}</p>
                <p class="text-gray-500 text-xs mt-1">{{ $doctor->hospital->name ?? 'Phòng khám tư' }}</p>
                <div class="mt-3">
                     <span class="block text-orange-500 font-bold">{{ number_format($doctor->price) }} đ</span>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white py-8 text-center mt-10">
        <p>Copyright © 2025 Medpro Clone. Built with Laravel 11.</p>
    </footer>

    <!-- SCRIPT HIỂN THỊ THÔNG BÁO THÀNH CÔNG -->
    <script>
        @if(session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#4CAF50", // Màu xanh thành côn
                style: {
                    fontSize: "16px",
                    fontWeight: "bold",
                    boxShadow: "0px 4px 10px rgba(0,0,0,0.1)"
                }
            }).showToast();
        @endif
    </script>

</body>
</html>