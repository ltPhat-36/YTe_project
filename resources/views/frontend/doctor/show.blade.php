<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $doctor->name }} - Medpro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #F3F5F7; }
        .text-medpro { color: #00b5f1; }
        .bg-medpro { background-color: #00b5f1; }
        .btn-booking { background: linear-gradient(90deg, #00b5f1 0%, #00e0ff 100%); }
        
        .selected-date { border-color: #00b5f1 !important; background-color: #e0f7fa !important; color: #00b5f1 !important; }
        .selected-time { background-color: #00b5f1 !important; color: white !important; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        /* Modal Animation */
        .modal { transition: opacity 0.25s ease; }
        body.modal-active { overflow-x: hidden; overflow-y: hidden !important; }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="/" class="text-medpro font-bold text-2xl">medpro</a>
            </div>
            @auth
                <div class="font-bold text-gray-700">Chào, {{ Auth::user()->name }}</div>
            @else
                <a href="{{ route('login') }}" class="text-medpro font-bold border border-cyan-500 px-4 py-2 rounded-full text-sm hover:bg-cyan-50">Đăng nhập</a>
            @endauth
        </div>
    </header>

    <div class="container mx-auto px-4 py-3 text-sm text-gray-500">
        Trang chủ <span class="mx-1">></span> Bác sĩ <span class="mx-1">></span> <span class="text-medpro font-bold">{{ $doctor->name }}</span>
    </div>

    <div class="container mx-auto px-4 pb-10">
        
        <!-- CARD THÔNG TIN CHÍNH -->
        <div class="bg-white rounded-xl p-6 shadow-sm mb-6">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-48 flex-shrink-0 text-center">
                    <div class="w-32 h-32 md:w-40 md:h-40 mx-auto rounded-full overflow-hidden border-4 border-gray-100 shadow-inner mb-2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=200&background=random" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="flex-1">
                    <h1 class="text-2xl md:text-3xl font-bold text-medpro mb-2">{{ $doctor->name }}</h1>
                    <div class="grid grid-cols-1 md:grid-cols-[120px_1fr] gap-y-2 text-sm md:text-base mb-4">
                        <span class="font-bold text-gray-700">Chuyên khoa:</span> <span class="text-gray-600">{{ $doctor->specialty->name }}</span>
                        <span class="font-bold text-gray-700">Bệnh viện:</span> <span class="text-gray-600">{{ $doctor->hospital->name }}</span>
                        <span class="font-bold text-gray-700">Giá khám:</span> <span class="font-bold text-orange-500">{{ number_format($doctor->price) }}đ</span>
                        <span class="font-bold text-gray-700">Lịch khám:</span> <span class="text-gray-600">Hẹn khám</span>
                    </div>

                    <div class="flex flex-col md:flex-row justify-end items-center gap-4 border-t pt-4">
                        <div class="text-sm text-gray-500 flex items-center gap-1">
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500"></span>
                            Tư vấn Online qua App Medpro
                        </div>
                        <!-- NÚT MỞ MODAL -->
                        <button onclick="toggleModal()" class="btn-booking text-white font-bold py-2 px-8 rounded-full shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                            Đặt khám ngay
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- NỘI DUNG CHÍNH -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- CỘT TRÁI: THÔNG TIN -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-medpro mb-4">Giới thiệu</h2>
                    <div class="text-gray-700 text-justify text-sm leading-relaxed">
                        {{ $doctor->bio }}
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h2 class="text-xl font-bold text-medpro mb-4">Kinh nghiệm</h2>
                    <div class="text-gray-700 text-sm leading-loose">
                        {!! $doctor->experience ?? 'Đang cập nhật...' !!}
                    </div>
                </div>
            </div>

            <!-- CỘT PHẢI: LIÊN QUAN -->
            <div class="lg:col-span-1 space-y-6">
                 <div class="bg-white rounded-xl p-6 shadow-sm sticky top-20">
                    <h2 class="text-xl font-bold text-medpro mb-4 border-b pb-2">Bài viết liên quan</h2>
                    <!-- (Giữ nguyên phần bài viết như cũ) -->
                    <div class="text-gray-500 text-sm italic">Đang cập nhật bài viết...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL CHỌN DỊCH VỤ (GIỐNG ẢNH BẠN GỬI) -->
    <!-- ========================================== -->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        
        <div class="modal-container bg-white w-11/12 md:max-w-3xl mx-auto rounded-xl shadow-2xl z-50 overflow-y-auto max-h-[90vh]">
            
            <!-- Header Modal -->
            <div class="bg-medpro px-6 py-4 rounded-t-xl flex justify-between items-center">
                <p class="text-xl font-bold text-white">Vui lòng chọn dịch vụ</p>
                <div onclick="toggleModal()" class="cursor-pointer z-50 text-white hover:text-gray-200">
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>

            <!-- Body Modal: Danh sách dịch vụ -->
            <div class="modal-content py-4 text-left px-6">
                
                <!-- Header Bảng -->
                <div class="bg-cyan-500 text-white p-3 flex font-bold text-sm rounded-t-lg">
                    <div class="w-10 text-center">#</div>
                    <div class="flex-1">Tên dịch vụ</div>
                    <div class="w-32 text-right pr-4">Giá tiền</div>
                    <div class="w-40 text-center">Hành động</div>
                </div>

                <!-- Row 1: Tư vấn online (Demo) -->
                <div class="border-b border-gray-200 p-4 flex flex-col md:flex-row items-center gap-4 hover:bg-gray-50 transition">
                    <div class="font-bold text-gray-500 w-10 text-center">1</div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-800">Tư vấn ngay online 01 lần</h3>
                        <p class="text-xs text-gray-500 italic">Lịch khám: Hẹn khám</p>
                    </div>
                    <div class="w-32 text-right font-bold text-gray-800">{{ number_format($doctor->price) }} đ</div>
                    <div class="w-40 flex justify-center gap-2">
                        <button class="text-cyan-500 bg-cyan-50 px-3 py-2 rounded text-xs font-bold hover:bg-cyan-100">Chi tiết</button>
                        <!-- Nút này sẽ mở ra phần chọn ngày giờ -->
                        <button onclick="showBookingForm()" class="bg-medpro text-white px-3 py-2 rounded text-xs font-bold hover:opacity-90 shadow">
                            Đặt khám ngay
                        </button>
                    </div>
                </div>

                <!-- Row 2: Khám tại viện (Demo) -->
                <div class="border-b border-gray-200 p-4 flex flex-col md:flex-row items-center gap-4 hover:bg-gray-50 transition">
                    <div class="font-bold text-gray-500 w-10 text-center">2</div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-800">Khám tại Bệnh viện {{ $doctor->hospital->name }}</h3>
                        <p class="text-xs text-gray-500 italic">Lịch khám: Thứ 2 - Thứ 7</p>
                    </div>
                    <div class="w-32 text-right font-bold text-gray-800">{{ number_format($doctor->price + 50000) }} đ</div>
                    <div class="w-40 flex justify-center gap-2">
                        <button class="text-cyan-500 bg-cyan-50 px-3 py-2 rounded text-xs font-bold hover:bg-cyan-100">Chi tiết</button>
                        <button onclick="showBookingForm()" class="bg-medpro text-white px-3 py-2 rounded text-xs font-bold hover:opacity-90 shadow">
                            Đặt khám ngay
                        </button>
                    </div>
                </div>

                <!-- KHU VỰC CHỌN NGÀY GIỜ (Ẩn mặc định, hiện khi bấm Đặt khám) -->
                <div id="bookingArea" class="hidden mt-6 border-t-2 border-dashed pt-6 animate-fade-in-down">
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-4">Vui lòng chọn ngày khám</h3>
                    
                    <!-- FORM GỬI DỮ LIỆU -->
                    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                        <input type="hidden" name="appointment_date" id="input_date" value="{{ now()->format('Y-m-d') }}">
                        <input type="hidden" name="appointment_time" id="input_time" value="">

                        <!-- Chọn Ngày -->
                        <div class="flex justify-center items-center mb-4">
                            <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide max-w-full">
                                @for($i = 0; $i < 7; $i++)
                                    @php 
                                        $date = now()->addDays($i);
                                        $dateVal = $date->format('Y-m-d'); // Format ở đây để tránh lỗi Blade
                                        $isToday = $i === 0;
                                    @endphp
                                    <div onclick="selectDate(this, '{{ $dateVal }}')" 
                                         class="min-w-[80px] p-2 rounded border cursor-pointer text-center date-item {{ $isToday ? 'selected-date' : 'border-gray-200 hover:border-cyan-300' }}">
                                        <div class="text-xs text-gray-500">{{ $date->format('d/m') }}</div>
                                        <div class="text-sm font-bold">{{ $date->dayName }}</div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <!-- Chọn Giờ -->
                        <div class="mb-4">
                            <p class="text-sm font-bold mb-2 text-gray-600">Buổi Sáng:</p>
                            <div class="grid grid-cols-4 gap-2 mb-3">
                                @foreach(['07:00', '07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00'] as $time)
                                    <div onclick="selectTime(this, '{{ $time }}')" class="time-item py-1 px-2 bg-gray-100 hover:bg-cyan-100 text-gray-700 rounded text-xs font-bold text-center cursor-pointer border">
                                        {{ $time }}
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-sm font-bold mb-2 text-gray-600">Buổi Chiều:</p>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach(['13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30'] as $time)
                                    <div onclick="selectTime(this, '{{ $time }}')" class="time-item py-1 px-2 bg-gray-100 hover:bg-cyan-100 text-gray-700 rounded text-xs font-bold text-center cursor-pointer border">
                                        {{ $time }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Nút Xác nhận cuối cùng -->
                        @auth
                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg shadow-lg transition uppercase">
                                Xác nhận đặt lịch
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-gray-500 text-white text-center font-bold py-3 rounded-lg">
                                Đăng nhập để tiếp tục
                            </a>
                        @endauth
                    </form>
                </div>

            </div>
            
            <!-- Footer Modal -->
            <div class="bg-gray-50 px-6 py-3 rounded-b-xl flex justify-end">
                <button onclick="toggleModal()" class="text-gray-500 hover:text-gray-700 font-bold text-sm">Đóng</button>
            </div>
        </div>
    </div>

    <!-- SCRIPT XỬ LÝ -->
    <script>
        // 1. Logic đóng mở Modal
        const body = document.querySelector('body');
        const modal = document.querySelector('.modal');

        function toggleModal () {
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
            body.classList.toggle('modal-active');
        }

        // Đóng khi click bên ngoài
        modal.addEventListener('click', function(event) {
            if (event.target === modal || event.target.classList.contains('modal-overlay')) {
                toggleModal();
            }
        });

        // 2. Hiển thị form đặt lịch khi chọn dịch vụ
        function showBookingForm() {
            document.getElementById('bookingArea').classList.remove('hidden');
            // Cuộn xuống phần chọn lịch
            document.getElementById('bookingArea').scrollIntoView({ behavior: 'smooth' });
        }

        // 3. Logic chọn Ngày/Giờ (Đã sửa lỗi syntax)
        function selectDate(element, dateValue) {
            document.querySelectorAll('.date-item').forEach(el => {
                el.classList.remove('selected-date');
                el.classList.add('border-gray-200');
            });
            element.classList.remove('border-gray-200');
            element.classList.add('selected-date');
            document.getElementById('input_date').value = dateValue;
        }

        function selectTime(element, timeValue) {
            document.querySelectorAll('.time-item').forEach(el => el.classList.remove('selected-time'));
            element.classList.add('selected-time');
            document.getElementById('input_time').value = timeValue;
        }

        document.addEventListener('DOMContentLoaded', function() {
            let successMsg = "{{ session('success') }}";
            if(successMsg) {
                Toastify({
                    text: successMsg,
                    duration: 4000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4CAF50",
                }).showToast();
            }
        });
    </script>

</body>
</html>