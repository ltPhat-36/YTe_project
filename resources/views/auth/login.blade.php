<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Medpro</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Nunito', sans-serif; }
        
        /* Màu thương hiệu */
        .text-medpro { color: #00b5f1; }
        .bg-medpro { background-color: #00b5f1; }
        .hover-bg-medpro:hover { background-color: #0099cc; }
        
        /* Ảnh nền bên phải */
        .bg-image-wrapper {
            background-image: url('https://images.unsplash.com/photo-1512428559087-560fa0ce6987?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
        
        .font-quote { font-family: 'Dancing Script', cursive; }
        .focus-ring:focus { --tw-ring-color: #00b5f1; border-color: #00b5f1; }
    </style>
</head>
<body class="h-screen w-full bg-white overflow-hidden">

    <div class="flex h-full w-full">
        
        <!-- ============================== -->
        <!-- CỘT TRÁI: FORM ĐĂNG NHẬP (45%) -->
        <!-- ============================== -->
        <div class="w-full lg:w-[45%] bg-white flex flex-col px-6 sm:px-12 md:px-20 relative z-10 justify-center">
            
            <!-- Nút Quay lại trang chủ -->
            <a href="/" class="absolute top-8 left-8 text-gray-400 hover:text-medpro transition" title="Về trang chủ">
                <i class="fas fa-arrow-left text-2xl"></i>
            </a>

            <div class="w-full max-w-md mx-auto text-center">
                
                <!-- Logo & Tiêu đề -->
                <div class="mb-8">
                    <h1 class="text-[40px] font-black text-medpro tracking-tighter">medpro</h1>
                    <p class="text-gray-500 font-bold text-sm uppercase tracking-wide mt-1">Đăng nhập hệ thống</p>
                </div>

                <p class="text-gray-600 mb-6 font-bold text-lg">Vui lòng nhập thông tin để tiếp tục</p>

                <!-- Form Login -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- INPUT 1: SỐ ĐIỆN THOẠI / EMAIL -->
                    <div class="relative group">
                        <!-- Box giả lập mã vùng +84 -->
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none border-r border-gray-300 pr-2 bg-gray-50 rounded-l-lg">
                            <img src="https://flagcdn.com/w20/vn.png" alt="VN" class="w-5 h-auto mr-1 shadow-sm">
                            <span class="text-gray-600 font-bold text-sm">+84</span>
                        </div>
                        
                        <!-- Ô nhập liệu (Cho phép nhập cả SĐT hoặc Email) -->
                        <input type="text" name="email" required autofocus value="{{ old('email') }}"
                            class="w-full pl-[88px] pr-4 py-3.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus-ring transition placeholder-gray-400 font-bold text-gray-700 shadow-sm" 
                            placeholder="Số điện thoại hoặc Email">
                    </div>
                    @error('email') <span class="text-red-500 text-sm text-left block pl-1 mt-1 ml-1">{{ $message }}</span> @enderror

                    <!-- INPUT 2: MẬT KHẨU -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" name="password" required 
                            class="w-full pl-10 pr-4 py-3.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus-ring transition placeholder-gray-400 font-medium shadow-sm" 
                            placeholder="Mật khẩu">
                    </div>
                    @error('password') <span class="text-red-500 text-sm text-left block pl-1 mt-1 ml-1">{{ $message }}</span> @enderror

                    <!-- Quên mật khẩu -->
                    <div class="text-right">
                        <a href="#" class="text-sm text-gray-500 hover:text-medpro hover:underline">Quên mật khẩu?</a>
                    </div>

                    <!-- Nút Tiếp tục -->
                    <button type="submit" class="w-full bg-medpro hover-bg-medpro text-white font-bold py-3.5 rounded-lg shadow-md hover:shadow-lg transition duration-300 mt-2 text-base uppercase tracking-wide">
                        Tiếp tục
                    </button>

                    <!-- LINK CHUYỂN SANG ĐĂNG KÝ (QUAN TRỌNG) -->
                    <div class="text-center text-sm mt-6 pt-4 border-t border-gray-100">
                        <span class="text-gray-500">Bạn chưa có tài khoản?</span>
                        <a href="{{ route('register') }}" class="text-medpro font-extrabold hover:underline ml-1 text-base">
                            Đăng ký ngay <i class="fas fa-chevron-right text-xs"></i>
                        </a>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                    <div class="relative flex justify-center text-sm"><span class="px-4 bg-white text-gray-500 font-medium">Hoặc đăng nhập bằng tài khoản</span></div>
                </div>

                <!-- Social Buttons -->
                <div class="space-y-3">
                    <button class="w-full bg-[#dd4b39] hover:bg-[#c23321] text-white font-bold py-3 rounded-lg shadow flex items-center justify-center gap-3 transition group relative overflow-hidden">
                        <div class="absolute left-1.5 top-1.5 bottom-1.5 w-10 bg-white rounded flex items-center justify-center"><img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" class="w-5 h-5"></div>
                        <span class="pl-8 text-sm tracking-wide">ĐĂNG NHẬP VỚI GOOGLE</span>
                    </button>
                    <button class="w-full bg-[#3b5998] hover:bg-[#2d4373] text-white font-bold py-3 rounded-lg shadow flex items-center justify-center gap-3 transition relative">
                        <div class="absolute left-1.5 top-1.5 bottom-1.5 w-10 bg-white rounded flex items-center justify-center text-[#3b5998]"><i class="fab fa-facebook-f text-lg"></i></div>
                        <span class="pl-8 text-sm tracking-wide">ĐĂNG NHẬP VỚI FACEBOOK</span>
                    </button>
                </div>

            </div>
        </div>

        <!-- ============================== -->
        <!-- CỘT PHẢI: ẢNH NỀN (55%)        -->
        <!-- ============================== -->
        <div class="hidden lg:block w-[55%] bg-image-wrapper relative">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-white/40 to-transparent"></div>
            
            <!-- Text Quote -->
            <div class="absolute top-1/3 right-[10%] text-right w-[400px]">
                <p class="text-[42px] font-quote text-gray-700 leading-tight mb-2">“Không còn:</p>
                
                <div class="relative inline-block mb-1">
                    <p class="text-[32px] font-quote text-gray-600 pl-12 italic">xếp hàng</p>
                    <div class="absolute top-1/2 left-10 right-0 h-[2px] bg-gray-500 opacity-70 rotate-[-5deg]"></div>
                </div>
                <br>
                <div class="relative inline-block mb-4">
                    <p class="text-[32px] font-quote text-gray-600 pl-12 italic">chờ đợi</p>
                    <div class="absolute top-1/2 left-10 right-0 h-[2px] bg-gray-500 opacity-70 rotate-[-5deg]"></div>
                </div>

                <p class="text-[42px] font-quote text-gray-800 leading-tight mt-2">Để lấy số khám bệnh”</p>
            </div>

             <!-- Footer nhỏ góc phải -->
             <div class="absolute bottom-6 right-6 bg-white/80 backdrop-blur-sm p-2 rounded-lg shadow-lg">
                <i class="fas fa-heartbeat text-medpro text-2xl animate-pulse"></i>
            </div>
        </div>

    </div>

</body>
</html>