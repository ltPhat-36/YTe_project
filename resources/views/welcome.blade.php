<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medpro - Đặt lịch khám bệnh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        body { font-family: 'Nunito', sans-serif; }
        .hero-bg {
            background: linear-gradient(to right, #eef6ff, #ffffff);
        }
        .custom-select::-webkit-scrollbar { width: 8px; }
        .custom-select::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 4px; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-700">

    <div class="bg-white border-b hidden md:block">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center text-xs text-gray-500">
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-cyan-500 flex items-center gap-1">🎵 Tiktok</a>
                <a href="#" class="hover:text-cyan-500 flex items-center gap-1">📘 Facebook</a>
                <a href="#" class="hover:text-cyan-500 flex items-center gap-1">💬 Zalo</a>
                <a href="#" class="hover:text-cyan-500 flex items-center gap-1">▶ Youtube</a>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-orange-500 font-bold flex items-center gap-1">
                    🎧 Hỗ trợ đặt khám: <span class="text-lg">1900 2115</span>
                </span>
                <a href="#" class="bg-yellow-400 text-white px-3 py-1 rounded-md font-bold hover:bg-yellow-500 transition">Tải ứng dụng</a>
                <a href="{{ route('login') }}" class="border border-cyan-500 text-cyan-500 px-3 py-1 rounded-md font-bold hover:bg-cyan-50 transition">
    Tài khoản
</a>
            </div>
        </div>
    </div>

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-3xl font-extrabold text-cyan-500 tracking-tight">medpro</a>

            <nav class="hidden lg:flex gap-6 font-bold text-gray-600 text-sm h-full items-center">

    <div class="relative group h-full flex items-center">
        <a href="#" class="flex items-center gap-1 hover:text-cyan-500 transition py-4">
            Cơ sở y tế
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
        </a>
        <div class="absolute top-full left-0 w-56 bg-gradient-to-b from-[#FFF9EA] to-[#F0F9FF] shadow-xl rounded-b-xl hidden group-hover:block z-50 border-t-2 border-cyan-500 animate-fade-in-up">
        <div class="py-2 flex flex-col gap-1 p-2">
            <a href="{{ route('search', ['type' => 'Bệnh viện công']) }}" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Bệnh viện công</a>
            <a href="{{ route('search', ['type' => 'Bệnh viện tư']) }}" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Bệnh viện tư</a>
            <a href="{{ route('search', ['type' => 'Phòng khám']) }}" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Phòng khám</a>
            <a href="{{ route('search', ['type' => 'Phòng mạch']) }}" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Phòng mạch</a>
            <a href="{{ route('search', ['type' => 'Xét nghiệm']) }}" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Xét nghiệm</a>
            <a href="{{ route('search', ['type' => 'Y tế tại nhà']) }}" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Y tế tại nhà</a>
            <a href="{{ route('search', ['type' => 'Tiêm chủng']) }}" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Tiêm chủng</a>
        </div>
    </div>
    </div>

    <div class="relative group h-full flex items-center">
        <a href="#" class="flex items-center gap-1 hover:text-cyan-500 transition py-4">
            Dịch vụ y tế
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
        </a>
        <div class="absolute top-full left-0 w-64 bg-gradient-to-b from-[#FFF9EA] to-[#F0F9FF] shadow-xl rounded-b-xl hidden group-hover:block z-50 border-t-2 border-cyan-500">
            <div class="py-2 flex flex-col gap-1 p-2 max-h-[400px] overflow-y-auto custom-select">
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Đặt khám tại cơ sở</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Đặt khám chuyên khoa</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Gọi video với bác sĩ</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Đặt lịch xét nghiệm</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Mua thuốc tại An Khang</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Giúp việc cá nhân</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Khám doanh nghiệp</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Đặt khám theo bác sĩ</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Gói khám sức khỏe</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Y tế tại nhà</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Đặt lịch tiêm chủng</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Đặt khám ngoài giờ</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Khám sức khỏe thông tư</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Thanh toán Viện phí</a>
            </div>
        </div>
    </div>

    <a href="#" class="hover:text-cyan-500 transition py-4">Khám sức khỏe doanh nghiệp</a>

    <div class="relative group h-full flex items-center">
        <a href="#" class="flex items-center gap-1 hover:text-cyan-500 transition py-4">
            Tin tức
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
        </a>
        <div class="absolute top-full left-0 w-56 bg-gradient-to-b from-[#FFF9EA] to-[#F0F9FF] shadow-xl rounded-b-xl hidden group-hover:block z-50 border-t-2 border-cyan-500">
            <div class="py-2 flex flex-col gap-1 p-2">
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Tin dịch vụ</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Tin y tế</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Y học thường thức</a>
            </div>
        </div>
    </div>

    <div class="relative group h-full flex items-center">
        <a href="#" class="flex items-center gap-1 hover:text-cyan-500 transition py-4">
            Hướng dẫn
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
        </a>
        <div class="absolute top-full right-0 lg:left-0 w-64 bg-gradient-to-b from-[#FFF9EA] to-[#F0F9FF] shadow-xl rounded-b-xl hidden group-hover:block z-50 border-t-2 border-cyan-500">
            <div class="py-2 flex flex-col gap-1 p-2">
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Cài đặt ứng dụng</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Đặt lịch khám</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Tư vấn khám bệnh qua video</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Quy trình hoàn phí</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Câu hỏi thường gặp</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Quy trình đi khám</a>
            </div>
        </div>
    </div>

    <div class="relative group h-full flex items-center">
        <a href="#" class="flex items-center gap-1 hover:text-cyan-500 transition py-4">
            Liên hệ hợp tác
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
        </a>
        <div class="absolute top-full right-0 w-56 bg-gradient-to-b from-[#FFF9EA] to-[#F0F9FF] shadow-xl rounded-b-xl hidden group-hover:block z-50 border-t-2 border-cyan-500">
            <div class="py-2 flex flex-col gap-1 p-2">
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Cơ sở y tế</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Phòng mạch</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Quảng cáo</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Tuyển dụng</a>
                <a href="#" class="block px-4 py-2 hover:text-cyan-600 hover:font-bold rounded-lg transition">Về Medpro</a>
            </div>
        </div>
    </div>

</nav>

            <div class="flex items-center gap-3">
                 @if (Route::has('login'))
                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 font-bold text-cyan-600">
                                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}" class="w-8 h-8 rounded-full">
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            </div>
                    @else
                        <div class="lg:hidden">
                            <a href="{{ route('login') }}" class="text-cyan-600 font-bold">Đăng nhập</a>
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <section class="relative bg-gradient-to-b from-blue-50 to-blue-100 pt-12 pb-32 overflow-hidden">
        
        <div class="absolute inset-0 opacity-10 pointer-events-none" 
             style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/8/80/World_map_-_low_resolution.svg'); background-size: cover; background-position: center;">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex justify-between items-end">
                

                <div class="flex-1 text-center max-w-3xl mx-auto pb-10">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-800 mb-6 leading-tight">
                        Kết nối Người Dân với <br>
                        <span class="text-cyan-600">Cơ sở & Dịch vụ Y tế hàng đầu</span>
                    </h1>

                    <form action="{{ route('search') }}" method="GET" class="relative max-w-2xl mx-auto mb-8">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </span>
                            <input type="text" name="keyword" 
                                   class="w-full py-4 pl-12 pr-4 rounded-full border-none shadow-lg focus:ring-2 focus:ring-cyan-500 text-gray-700 placeholder-gray-400"
                                   placeholder="Tìm kiếm chuyên khoa, tên bác sĩ, bệnh viện...">
                        </div>
                    </form>

                    <div class="text-left inline-block space-y-2 text-sm md:text-base font-medium text-gray-600">
                        <p class="flex items-center gap-2">
                            <span class="text-green-500 bg-white rounded-full p-0.5">✔</span> 
                            Đặt khám nhanh - Lấy số thứ tự trực tuyến - Tư vấn sức khỏe từ xa
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="text-green-500 bg-white rounded-full p-0.5">✔</span> 
                            Đặt khám theo giờ - Đặt càng sớm để có thể có số thứ tự thấp nhất
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="text-green-500 bg-white rounded-full p-0.5">✔</span> 
                            Được hoàn tiền khi hủy khám - Có cơ hội nhận ưu đãi hoàn tiền
                        </p>
                    </div>
                </div>

                
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 relative z-20 -mt-20 mb-12">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
            
            <a href="#" class="bg-white rounded-2xl p-4 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center group h-full flex flex-col justify-center items-center">
                <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mb-3 group-hover:bg-blue-500 group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <h3 class="font-bold text-gray-700 text-sm leading-tight">Đặt khám tại cơ sở</h3>
            </a>

            <a href="#" class="bg-white rounded-2xl p-4 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center group h-full flex flex-col justify-center items-center">
                <div class="w-14 h-14 bg-cyan-50 text-cyan-500 rounded-full flex items-center justify-center mb-3 group-hover:bg-cyan-500 group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                </div>
                <h3 class="font-bold text-gray-700 text-sm leading-tight">Đặt khám chuyên khoa</h3>
            </a>

            <a href="#" class="bg-white rounded-2xl p-4 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center group h-full flex flex-col justify-center items-center">
                <div class="w-14 h-14 bg-red-50 text-red-500 rounded-full flex items-center justify-center mb-3 group-hover:bg-red-500 group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                </div>
                <h3 class="font-bold text-gray-700 text-sm leading-tight">Gọi video với bác sĩ</h3>
            </a>

            <a href="#" class="bg-white rounded-2xl p-4 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center group h-full flex flex-col justify-center items-center">
                <div class="w-14 h-14 bg-green-50 text-green-500 rounded-full flex items-center justify-center mb-3 group-hover:bg-green-500 group-hover:text-white transition">
                   <span class="text-2xl font-bold">🧪</span>
                </div>
                <h3 class="font-bold text-gray-700 text-sm leading-tight">Đặt lịch xét nghiệm</h3>
            </a>

            <a href="#" class="bg-white rounded-2xl p-4 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center group h-full flex flex-col justify-center items-center">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mb-3 group-hover:bg-emerald-500 group-hover:text-white transition">
                    <span class="text-2xl font-bold">💊</span>
                </div>
                <h3 class="font-bold text-gray-700 text-sm leading-tight">Mua thuốc tại An Khang</h3>
            </a>

             <a href="#" class="bg-white rounded-2xl p-4 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center group h-full flex flex-col justify-center items-center">
                <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mb-3 group-hover:bg-orange-500 group-hover:text-white transition">
                    <span class="text-2xl font-bold">👵</span>
                </div>
                <h3 class="font-bold text-gray-700 text-sm leading-tight">Giúp việc cá nhân</h3>
            </a>

            <a href="#" class="bg-white rounded-2xl p-4 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center group h-full flex flex-col justify-center items-center">
                <div class="w-14 h-14 bg-purple-50 text-purple-500 rounded-full flex items-center justify-center mb-3 group-hover:bg-purple-500 group-hover:text-white transition">
                    <span class="text-2xl font-bold">🏢</span>
                </div>
                <h3 class="font-bold text-gray-700 text-sm leading-tight">Khám doanh nghiệp</h3>
            </a>

        </div>
    </section>

    <section class="container mx-auto px-4 py-10 bg-white">
         <h2 class="text-2xl font-bold text-gray-800 mb-6 border-l-4 border-cyan-500 pl-3">Cơ sở y tế nổi bật</h2>
         <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($hospitals as $hospital)
            <div class="bg-white rounded-lg shadow overflow-hidden border hover:border-cyan-500 transition group flex flex-col h-full">
                <div class="p-4">
                    <h3 class="font-bold text-lg text-gray-800">{{ $hospital->name }}</h3>
                 </div>
            </div>
            @endforeach
        </div>
    </section>

    </body>
</html>