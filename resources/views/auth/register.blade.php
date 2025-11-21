<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản - Medpro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Nunito', sans-serif; }
        
        /* Màu thương hiệu Medpro */
        .text-medpro { color: #00b5f1; }
        .bg-medpro { background-color: #00b5f1; }
        .hover-bg-medpro:hover { background-color: #0099cc; }
        .focus-ring:focus { border-color: #00b5f1; --tw-ring-color: #00b5f1; }
        
        /* Ảnh nền khác với trang Login */
        .bg-image-wrapper {
            background-image: url('https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?q=80&w=2091&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
        .font-quote { font-family: 'Dancing Script', cursive; }
    </style>
</head>
<body class="h-screen w-full bg-white overflow-hidden">

    <div class="flex h-full w-full">
        
        <!-- ============================== -->
        <!-- CỘT TRÁI: FORM ĐĂNG KÝ (45%)   -->
        <!-- ============================== -->
        <div class="w-full lg:w-[45%] bg-white flex flex-col px-6 sm:px-12 md:px-16 relative z-10 justify-center overflow-y-auto py-10">
            
            <!-- Nút Quay lại -->
            <a href="/" class="absolute top-6 left-6 text-gray-400 hover:text-medpro transition" title="Quay lại trang chủ">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>

            <div class="w-full max-w-md mx-auto mt-10 lg:mt-0">
                
                <!-- Header Form -->
                <div class="text-center mb-8">
                    <h1 class="text-[40px] font-black text-medpro tracking-tighter mb-1">medpro</h1>
                    <p class="text-gray-500 font-bold text-sm uppercase tracking-widest">Đăng ký thành viên mới</p>
                </div>

                <!-- Form chính -->
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- 1. Họ và Tên -->
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase block mb-1 ml-1">Họ và tên</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" name="name" required value="{{ old('name') }}" autofocus
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus-ring font-bold text-gray-700 transition" 
                                placeholder="Nhập họ tên của bạn">
                        </div>
                        @error('name') <span class="text-red-500 text-xs ml-1 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- 2. Số điện thoại -->
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase block mb-1 ml-1">Số điện thoại</label>
                        <div class="relative">
                            <!-- Box đầu số +84 -->
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none border-r bg-gray-50 rounded-l-lg pr-2">
                                <img src="https://flagcdn.com/w20/vn.png" class="w-4 h-auto mr-1">
                                <span class="text-gray-600 font-bold text-sm">+84</span>
                            </div>
                            <input type="text" name="phone" required value="{{ old('phone') }}"
                                class="w-full pl-20 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus-ring font-bold text-gray-700 transition" 
                                placeholder="912xxxxxx">
                        </div>
                        @error('phone') <span class="text-red-500 text-xs ml-1 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- 3. Email -->
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase block mb-1 ml-1">Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus-ring font-bold text-gray-700 transition" 
                                placeholder="email@example.com">
                        </div>
                        @error('email') <span class="text-red-500 text-xs ml-1 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- 4. Mật khẩu & Xác nhận -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase block mb-1 ml-1">Mật khẩu</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input type="password" name="password" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus-ring font-medium transition" 
                                    placeholder="********">
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase block mb-1 ml-1">Nhập lại MK</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <input type="password" name="password_confirmation" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus-ring font-medium transition" 
                                    placeholder="********">
                            </div>
                        </div>
                    </div>
                    @error('password') <span class="text-red-500 text-xs ml-1 mt-1 block">{{ $message }}</span> @enderror

                    <!-- Điều khoản -->
                    <div class="flex items-start mt-2">
                        <input type="checkbox" required class="mt-1 mr-2 cursor-pointer accent-[#00b5f1]">
                        <p class="text-xs text-gray-500">
                            Tôi đồng ý với <a href="#" class="text-medpro font-bold hover:underline">Điều khoản sử dụng</a> và <a href="#" class="text-medpro font-bold hover:underline">Chính sách bảo mật</a> của Medpro.
                        </p>
                    </div>

                    <!-- Nút Submit -->
                    <button type="submit" class="w-full bg-medpro hover-bg-medpro text-white font-bold py-3.5 rounded-lg shadow-md hover:shadow-lg transition duration-300 mt-4 uppercase tracking-wide">
                        Đăng ký tài khoản
                    </button>

                    <!-- Footer chuyển trang -->
                    <div class="text-center text-sm mt-6 pt-4 border-t border-gray-100">
                        <span class="text-gray-500">Bạn đã có tài khoản?</span>
                        <a href="{{ route('login') }}" class="text-medpro font-extrabold hover:underline ml-1">
                            Đăng nhập ngay <i class="fas fa-chevron-right text-xs"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- ============================== -->
        <!-- CỘT PHẢI: ẢNH NỀN (55%)        -->
        <!-- ============================== -->
        <div class="hidden lg:block w-[55%] bg-image-wrapper relative">
            <!-- Lớp phủ Gradient giúp text dễ đọc hơn -->
            <div class="absolute inset-0 bg-gradient-to-r from-white/60 via-white/20 to-transparent"></div>
            
            <!-- Text Quote bên phải -->
            <div class="absolute top-[30%] right-[10%] text-right max-w-md">
                <div class="bg-white/30 backdrop-blur-sm p-6 rounded-2xl border border-white/50 shadow-lg">
                    <p class="text-[36px] font-quote text-gray-700 leading-tight mb-1">“Sức khỏe của bạn</p>
                    <p class="text-[42px] font-quote text-medpro italic font-bold mb-2">Là ưu tiên của chúng tôi”</p>
                    <p class="text-sm text-gray-600 font-sans font-medium mt-2">
                        Kết nối với hơn 100+ bệnh viện hàng đầu và đặt lịch khám chỉ trong 30 giây.
                    </p>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute bottom-10 right-10 flex gap-3">
                 <div class="bg-white p-3 rounded-full shadow-lg text-medpro">
                     <i class="fas fa-hospital-alt text-xl"></i>
                 </div>
                 <div class="bg-white p-3 rounded-full shadow-lg text-orange-500">
                    <i class="fas fa-star text-xl"></i>
                </div>
            </div>
        </div>

    </div>

</body>
</html>