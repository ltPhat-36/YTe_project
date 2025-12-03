<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bác sĩ - Lịch làm việc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        body { font-family: 'Nunito', sans-serif; }
        .modal { transition: opacity 0.25s ease; }
        body.modal-active { overflow-x: hidden; overflow-y: hidden !important; }
    </style>
</head>
<body class="bg-blue-50 font-sans text-gray-800">

    <header class="bg-white shadow sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="bg-blue-600 text-white p-2 rounded-lg shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <span class="font-bold text-xl text-gray-800">Khu vực Bác sĩ</span>
            </div>
            <div class="flex items-center gap-6">
                <div class="text-right hidden md:block">
                    <div class="font-bold text-gray-800 text-lg">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-green-600 font-bold uppercase tracking-wide">● Đang hoạt động</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-100 text-red-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-200 transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Thoát
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-6 py-8">
        
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Danh sách bệnh nhân cần khám
                </h2>
                <p class="text-gray-500 text-sm mt-1 ml-8">Chỉ hiển thị các lịch hẹn đã được Admin duyệt.</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <table class="min-w-full text-left">
                <thead class="bg-blue-50 text-blue-800 uppercase text-xs font-bold">
                    <tr>
                        <th class="py-4 px-6">Thông tin bệnh nhân</th>
                        <th class="py-4 px-6 text-center">Thời gian khám</th>
                        <th class="py-4 px-6">Triệu chứng / Ghi chú</th>
                        <th class="py-4 px-6 text-center">Trạng thái</th>
                        <th class="py-4 px-6 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @forelse($appointments as $app)
                    <tr class="border-b hover:bg-blue-50 transition duration-150">
                        <td class="py-4 px-6">
                            <div class="font-bold text-gray-800 text-base">{{ $app->user->name }}</div>
                            <div class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $app->user->phone ?? 'Chưa cập nhật SĐT' }}
                            </div>
                        </td>

                        <td class="py-4 px-6 text-center">
                            <div class="font-bold text-blue-600 text-lg">{{ $app->appointment_time }}</div>
                            <div class="text-xs text-gray-500 font-medium">{{ \Carbon\Carbon::parse($app->appointment_date)->format('d/m/Y') }}</div>
                        </td>

                        <td class="py-4 px-6 max-w-xs">
                            <p class="truncate text-gray-700" title="{{ $app->symptoms }}">{{ $app->symptoms }}</p>
                        </td>

                        <td class="py-4 px-6 text-center">
                            @if($app->status == 'confirmed')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200 flex items-center justify-center gap-1 w-max mx-auto">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Sẵn sàng
                                </span>
                            @elseif($app->status == 'completed')
                                <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-xs font-bold border border-gray-200 w-max mx-auto block">
                                    Đã xong
                                </span>
                            @endif
                        </td>

                        <td class="py-4 px-6 text-center">
                            @if($app->status == 'confirmed')
                                <button onclick="openModal('{{ $app->id }}', '{{ $app->user->name }}')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-bold shadow-md transition transform hover:scale-105 flex items-center gap-2 mx-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Khám bệnh
                                </button>
                            @elseif($app->status == 'completed')
                                <div class="text-xs text-gray-500 italic bg-gray-50 p-2 rounded border border-gray-200 max-w-[150px] mx-auto truncate cursor-help" title="{{ $app->diagnosis }}">
                                    <strong>KQ:</strong> {{ $app->diagnosis }}
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-16">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                <p class="text-lg font-medium">Hiện chưa có lịch hẹn nào được duyệt.</p>
                                <p class="text-sm">Vui lòng chờ Admin phân phối bệnh nhân.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="p-4 border-t border-gray-200 bg-gray-50">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>

    <div id="diagnosisModal" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        
        <div class="modal-container bg-white w-11/12 md:max-w-lg mx-auto rounded-xl shadow-2xl z-50 overflow-y-auto transform transition-all scale-95">
            <div class="bg-blue-600 px-6 py-4 rounded-t-xl flex justify-between items-center">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    Ghi kết quả khám bệnh
                </h3>
                <button onclick="closeModal()" class="text-white hover:text-gray-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <form id="diagnosisForm" method="POST">
                @csrf
                <div class="p-6">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4 rounded">
                        <p class="text-sm text-gray-700">Đang khám cho bệnh nhân: <strong id="modalPatientName" class="text-blue-700 text-lg ml-1"></strong></p>
                    </div>
                    
                    <label class="block text-gray-700 text-sm font-bold mb-2">Chẩn đoán & Lời dặn của bác sĩ:</label>
                    <textarea name="diagnosis" rows="6" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none text-gray-700" placeholder="Ví dụ: Viêm họng cấp.&#10;- Uống thuốc 5 ngày."></textarea>
                    <p class="text-xs text-gray-400 mt-2 text-right">Nhập tối thiểu 5 ký tự.</p>
                </div>

                <div class="bg-gray-50 px-6 py-3 flex justify-end gap-3 rounded-b-xl border-t border-gray-200">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-bold hover:bg-gray-100 transition">Đóng</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 shadow-md transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Lưu & Hoàn thành
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('diagnosisModal');
        const container = modal.querySelector('.modal-container');
        const form = document.getElementById('diagnosisForm');
        const patientNameSpan = document.getElementById('modalPatientName');

        function openModal(id, name) {
            form.action = "/doctor/complete/" + id;
            patientNameSpan.textContent = name;
            modal.classList.remove('opacity-0', 'pointer-events-none');
            document.body.classList.add('modal-active');
            container.classList.remove('scale-95');
            container.classList.add('scale-100');
        }

        function closeModal() {
            modal.classList.add('opacity-0', 'pointer-events-none');
            document.body.classList.remove('modal-active');
            container.classList.remove('scale-100');
            container.classList.add('scale-95');
        }

        document.addEventListener('DOMContentLoaded', function() {
            var successMsg = @json(session('success'));
            if (successMsg) {
                Toastify({
                    text: successMsg,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4CAF50",
                    style: { boxShadow: "0px 4px 15px rgba(0,0,0,0.1)", borderRadius: "8px", fontWeight: "bold" }
                }).showToast();
            }

            @if($errors->any())
                Toastify({
                    text: "{{ $errors->first() }}",
                    duration: 4000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#F44336",
                }).showToast();
            @endif
        });
    </script>
</body>
</html>