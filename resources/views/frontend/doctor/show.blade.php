<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $doctor->name }} - Medpro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #F3F5F7; }
        .text-medpro { color: #00b5f1; } /* Màu xanh đặc trưng Medpro */
        .bg-medpro { background-color: #00b5f1; }
        .btn-booking { background: linear-gradient(90deg, #00b5f1 0%, #00e0ff 100%); }
    </style>
</head>
<body>

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center gap-4">
            <a href="/" class="text-medpro font-bold text-2xl">medpro</a>
            <div class="flex-1">
                <input type="text" placeholder="Tìm kiếm bác sĩ..." class="bg-gray-100 px-4 py-2 rounded-full w-full max-w-md outline-none text-sm">
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-3 text-sm text-gray-500">
        Trang chủ <span class="mx-1">></span> Bác sĩ <span class="mx-1">></span> <span class="text-medpro font-bold">{{ $doctor->name }}</span>
    </div>

    <div class="container mx-auto px-4 pb-10">
        
        <div class="bg-white rounded-xl p-6 shadow-sm mb-6">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-48 flex-shrink-0">
                    <div class="w-32 h-32 md:w-40 md:h-40 mx-auto rounded-full overflow-hidden border-4 border-gray-100 shadow-inner">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=200&background=random" class="w-full h-full object-cover" alt="Avatar">
                    </div>
                </div>

                <div class="flex-1">
                    <h1 class="text-2xl md:text-3xl font-bold text-medpro mb-2">{{ $doctor->name }}</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-[120px_1fr] gap-y-2 text-sm md:text-base mb-4">
                        <span class="font-bold text-gray-700">Chuyên khoa:</span>
                        <span class="text-gray-600">{{ $doctor->specialty->name }}</span>

                        <span class="font-bold text-gray-700">Chuyên trị:</span>
                        <span class="text-gray-600 line-clamp-2">{{ $doctor->treatments ?? 'Đang cập nhật...' }}</span>

                        <span class="font-bold text-gray-700">Giá khám:</span>
                        <span class="font-bold text-gray-800">{{ number_format($doctor->price) }}đ</span>

                        <span class="font-bold text-gray-700">Lịch khám:</span>
                        <span class="text-gray-600">Hẹn khám</span>
                    </div>

                    <div class="flex flex-col md:flex-row justify-end items-center gap-4 border-t pt-4">
                        <div class="text-sm text-gray-500 flex items-center gap-1">
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500"></span>
                            Tư vấn Online qua App Medpro
                        </div>
                        <button class="btn-booking text-white font-bold py-2 px-8 rounded-full shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                            Đặt ngay
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-medpro mb-4">Giới thiệu</h2>
                    <div class="text-gray-700 text-justify leading-relaxed">
                        {{ $doctor->bio }}
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-medpro mb-4">Kinh nghiệm làm việc</h2>
                    <div class="text-gray-700 text-sm leading-loose">
                        {!! $doctor->experience ?? 'Đang cập nhật kinh nghiệm...' !!}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl p-6 shadow-sm sticky top-20">
                    <h2 class="text-xl font-bold text-medpro mb-4 border-b pb-2">Bài viết liên quan</h2>
                    <div class="space-y-4">
                        <div class="flex gap-3 items-start group cursor-pointer">
                            <img src="https://medpro.vn/_next/image?url=https%3A%2F%2Fcdn.medpro.vn%2Fmedpro-production%2Fposts%2F1731988800-chinh-ham-ho-mom-o-dau-tieu-chi-lua-chon-dia-chi-uy-tin.jpg&w=256&q=75" class="w-20 h-20 rounded-lg object-cover flex-shrink-0" alt="Post">
                            <div>
                                <span class="text-xs text-gray-400">Tin y tế</span>
                                <h3 class="text-sm font-bold text-gray-700 group-hover:text-medpro transition line-clamp-2">
                                    Chỉnh hàm hô móm ở đâu? Gợi ý 4 địa chỉ uy tín 2025
                                </h3>
                                <span class="text-xs text-gray-400">06/11/2025</span>
                            </div>
                        </div>
                         <div class="flex gap-3 items-start group cursor-pointer">
                            <img src="https://medpro.vn/_next/image?url=https%3A%2F%2Fcdn.medpro.vn%2Fmedpro-production%2Fposts%2F1731988800-sieu-am-tim-thai-bao-nhieu-tien-top-4-dia-chi-uy-tin-tp-hcm.jpg&w=256&q=75" class="w-20 h-20 rounded-lg object-cover flex-shrink-0" alt="Post">
                            <div>
                                <span class="text-xs text-gray-400">Tin y tế</span>
                                <h3 class="text-sm font-bold text-gray-700 group-hover:text-medpro transition line-clamp-2">
                                    Siêu âm tim thai bao nhiêu tiền?
                                </h3>
                                <span class="text-xs text-gray-400">05/11/2025</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-bold text-medpro mb-6 text-center">Bác sĩ cùng cơ sở y tế</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($relatedDoctors as $relDoctor)
                <div class="bg-white rounded-xl p-4 shadow-sm border hover:shadow-md transition flex flex-col sm:flex-row gap-4">
                    <div class="flex-shrink-0 mx-auto sm:mx-0">
                        <div class="w-24 h-24 rounded-full overflow-hidden border border-gray-200">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($relDoctor->name) }}&background=random" class="w-full h-full object-cover">
                        </div>
                        <div class="text-center mt-2">
                            <a href="{{ route('doctor.show', $relDoctor->id) }}" class="text-xs text-gray-500 underline hover:text-medpro">Xem chi tiết</a>
                        </div>
                    </div>
                    
                    <div class="flex-1 text-center sm:text-left">
                        <a href="{{ route('doctor.show', $relDoctor->id) }}" class="text-lg font-bold text-medpro block mb-1 hover:underline">
                            {{ $relDoctor->name }}
                        </a>
                        <p class="text-sm font-bold text-gray-600 mb-2">
                             | {{ $relDoctor->specialty->name }}
                        </p>
                        
                        <div class="text-sm text-gray-600 mb-2 line-clamp-2">
                            <span class="font-bold">Chuyên trị:</span> {{ $relDoctor->treatments ?? 'Tư vấn và điều trị chuyên khoa...' }}
                        </div>

                        <div class="text-sm mb-1">
                            <span class="font-bold text-gray-700">Giá khám:</span> 
                            <span class="font-bold text-gray-800">{{ number_format($relDoctor->price) }}đ</span>
                        </div>

                        <div class="flex justify-center sm:justify-end mt-3">
                            <button class="btn-booking text-white text-sm font-bold py-2 px-6 rounded-full hover:opacity-90">
                                Đặt ngay
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

</body>
</html>