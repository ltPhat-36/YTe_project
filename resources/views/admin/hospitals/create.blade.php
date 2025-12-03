<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Cơ Sở Y Tế - Medpro Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .bg-admin { background-color: #1e293b; }
        /* Style cho bảng chọn giờ */
        .schedule-row { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; padding: 8px; background: #f9fafb; border-radius: 8px; border: 1px solid #e5e7eb; }
        .day-label { width: 100px; font-weight: bold; color: #4b5563; }
        .time-input { padding: 4px 8px; border: 1px solid #d1d5db; border-radius: 4px; font-size: 14px; width: 110px; }
        .status-toggle { cursor: pointer; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="bg-admin shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-xl tracking-wider flex items-center gap-2 transition hover:text-blue-400">
                    <i class="fas fa-arrow-left"></i> Quay lại Dashboard
                </a>
            </div>
            <div class="text-white text-sm font-bold">Thêm Mới Cơ Sở Y Tế</div>
        </div>
    </header>

    <div class="container mx-auto px-6 py-8">
        
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <div class="bg-blue-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <i class="fas fa-plus-circle"></i> Nhập thông tin cơ sở y tế
                </h2>
            </div>

            <form action="{{ route('admin.hospitals.store') }}" method="POST" enctype="multipart/form-data" class="p-8" onsubmit="compileSchedule()">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Tên Bệnh Viện / Phòng Khám <span class="text-red-500">*</span></label>
                        <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" placeholder="VD: Bệnh viện Đại học Y Dược...">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Loại hình cơ sở <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="type" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50 appearance-none cursor-pointer">
                                <option value="" disabled selected>-- Chọn loại hình --</option>
                                <option value="Bệnh viện công">Bệnh viện công</option>
                                <option value="Bệnh viện tư">Bệnh viện tư</option>
                                <option value="Phòng khám">Phòng khám</option>
                                <option value="Phòng mạch">Phòng mạch</option>
                                <option value="Xét nghiệm">Xét nghiệm</option>
                                <option value="Y tế tại nhà">Y tế tại nhà</option>
                                <option value="Tiêm chủng">Tiêm chủng</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Số Hotline <span class="text-red-500">*</span></label>
                        <input type="text" name="hotline" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" placeholder="VD: 1900 2115">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Logo / Ảnh đại diện <span class="text-red-500">*</span></label>
                        <input type="file" name="logo" required class="w-full px-4 py-2 border rounded-lg bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Địa chỉ chi tiết <span class="text-red-500">*</span></label>
                    <input type="text" name="address" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" placeholder="VD: 215 Hồng Bàng, Phường 11, Quận 5, TP.HCM">
                </div>

                <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <label class="block text-blue-800 font-bold mb-4 flex items-center gap-2">
                        <i class="far fa-clock"></i> Cấu hình Thời gian làm việc
                    </label>

                    <div id="schedule-container">
                        </div>

                    <textarea name="work_hours" id="final_work_hours" class="hidden"></textarea>
                </div>
                <div class="mb-6 bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <label class="block text-blue-800 font-bold mb-2">
                        <i class="fas fa-images"></i> Ảnh Slide giới thiệu (Chọn nhiều ảnh)
                    </label>
                    <input type="file" name="gallery[]" multiple class="w-full px-4 py-2 border rounded-lg bg-white">
                    <p class="text-xs text-gray-500 mt-1 italic">Giữ phím <strong>Ctrl</strong> (hoặc Command) để chọn nhiều ảnh cùng lúc.</p>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-bold mb-2">Mô tả / Giới thiệu</label>
                    <textarea name="description" rows="5" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50" placeholder="Nhập thông tin giới thiệu về bệnh viện..."></textarea>
                </div>

                <div class="flex items-center gap-4 border-t pt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform transition hover:-translate-y-1 flex items-center gap-2">
                        <i class="fas fa-save"></i> Lưu thông tin
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-6 rounded-lg transition">
                        Hủy bỏ
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script>
        const daysOfWeek = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'];
        const container = document.getElementById('schedule-container');

        // 1. Khởi tạo giao diện chọn giờ
        daysOfWeek.forEach((day, index) => {
            const row = document.createElement('div');
            row.className = 'schedule-row';
            
            // Mặc định T2-T6 làm việc, T7-CN nghỉ
            const isWorking = index < 5; 
            
            row.innerHTML = `
                <div class="flex items-center gap-3 w-full">
                    <input type="checkbox" id="chk_${index}" class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500 cursor-pointer" 
                           ${isWorking ? 'checked' : ''} onchange="toggleDay(${index})">
                    <span class="day-label">${day}</span>
                    
                    <div id="time_inputs_${index}" class="flex items-center gap-2 ${isWorking ? '' : 'opacity-50 pointer-events-none'}">
                        <select id="start_${index}" class="time-input bg-white">
                            ${generateTimeOptions('07:00')}
                        </select>
                        <span class="text-gray-400">đến</span>
                        <select id="end_${index}" class="time-input bg-white">
                            ${generateTimeOptions('16:30')}
                        </select>
                    </div>
                    
                    <span id="status_${index}" class="ml-auto text-xs font-bold ${isWorking ? 'text-green-600' : 'text-red-500'}">
                        ${isWorking ? 'Đang mở' : 'Nghỉ'}
                    </span>
                </div>
            `;
            container.appendChild(row);
        });

        // 2. Hàm tạo danh sách giờ (06:00 -> 20:00)
        function generateTimeOptions(selectedTime) {
            let options = '';
            for (let h = 6; h <= 20; h++) {
                ['00', '30'].forEach(m => {
                    const time = `${h.toString().padStart(2, '0')}:${m}`;
                    options += `<option value="${time}" ${time === selectedTime ? 'selected' : ''}>${time}</option>`;
                });
            }
            return options;
        }

        // 3. Bật/Tắt ngày làm việc
        function toggleDay(index) {
            const checkbox = document.getElementById(`chk_${index}`);
            const timeInputs = document.getElementById(`time_inputs_${index}`);
            const statusLabel = document.getElementById(`status_${index}`);

            if (checkbox.checked) {
                timeInputs.classList.remove('opacity-50', 'pointer-events-none');
                statusLabel.innerText = 'Đang mở';
                statusLabel.className = 'ml-auto text-xs font-bold text-green-600';
            } else {
                timeInputs.classList.add('opacity-50', 'pointer-events-none');
                statusLabel.innerText = 'Nghỉ';
                statusLabel.className = 'ml-auto text-xs font-bold text-red-500';
            }
        }

        // 4. GỘP DỮ LIỆU TRƯỚC KHI GỬI FORM
        function compileSchedule() {
            let finalString = "";
            let groups = [];
            let currentGroup = null;

            // Thuật toán gộp ngày giống nhau (VD: T2-T6: 07:00-16:30)
            daysOfWeek.forEach((day, index) => {
                const checkbox = document.getElementById(`chk_${index}`);
                if (checkbox.checked) {
                    const start = document.getElementById(`start_${index}`).value;
                    const end = document.getElementById(`end_${index}`).value;
                    const timeStr = `(${start} - ${end})`;

                    if (currentGroup && currentGroup.time === timeStr) {
                        currentGroup.endDay = day; // Kéo dài nhóm
                    } else {
                        if (currentGroup) groups.push(currentGroup);
                        currentGroup = { startDay: day, endDay: day, time: timeStr };
                    }
                } else {
                    if (currentGroup) {
                        groups.push(currentGroup);
                        currentGroup = null;
                    }
                }
            });
            if (currentGroup) groups.push(currentGroup);

            // Tạo chuỗi hiển thị
            groups.forEach(g => {
                if (g.startDay === g.endDay) {
                    finalString += `${g.startDay} ${g.time}\n`;
                } else {
                    finalString += `${g.startDay} - ${g.endDay} ${g.time}\n`;
                }
            });

            if (finalString === "") finalString = "Tạm nghỉ";

            // Gán vào textarea ẩn
            document.getElementById('final_work_hours').value = finalString.trim();
        }
    </script>

</body>
</html>