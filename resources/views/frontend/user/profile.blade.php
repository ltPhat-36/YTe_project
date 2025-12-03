<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ cá nhân - Medpro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <style> body { font-family: 'Nunito', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600">Medpro</a>
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 font-bold">Quay lại Dashboard</a>
        </div>
    </div>

    <div class="container mx-auto px-4 py-10 max-w-5xl">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Quản lý hồ sơ cá nhân</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center border border-gray-100">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="relative w-32 h-32 mx-auto mb-4 group">
                            <img id="avatarPreview" 
                                 src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0D8ABC&color=fff' }}" 
                                 class="w-full h-full rounded-full object-cover border-4 border-blue-50 shadow-md">
                            
                            <label for="avatarInput" class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition cursor-pointer">
                                <span class="text-white text-xs font-bold">Đổi ảnh</span>
                            </label>
                            <input type="file" id="avatarInput" name="avatar" class="hidden" onchange="previewImage(event)">
                        </div>

                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-500 text-sm mb-4">{{ $user->email }}</p>
                        
                        <div class="flex justify-center gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-bold uppercase">{{ $user->role }}</span>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg shadow transition md:hidden">
                            Lưu thay đổi
                        </button>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-700 mb-6 border-b pb-2">Thông tin chi tiết</h3>
                    
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-600 text-sm font-bold mb-2">Họ và tên</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                            </div>

                            <div>
                                <label class="block text-gray-600 text-sm font-bold mb-2">Số điện thoại</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                            </div>

                            <div>
                                <label class="block text-gray-600 text-sm font-bold mb-2">Giới tính</label>
                                <select name="gender" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Nam</option>
                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Nữ</option>
                                    <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Khác</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-gray-600 text-sm font-bold mb-2">Email (Không thể sửa)</label>
                                <input type="email" value="{{ $user->email }}" disabled class="w-full border border-gray-200 bg-gray-100 rounded-lg p-3 text-gray-500 cursor-not-allowed">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-gray-600 text-sm font-bold mb-2">Địa chỉ liên hệ</label>
                                <input type="text" name="address" value="{{ old('address', $user->address) }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Nhập địa chỉ của bạn...">
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:-translate-y-1 transition duration-200">
                                Lưu thay đổi
                            </button>
                        </div>
                    </form> </div>
            </div>
        </div>
    </div>

    <script>
        // Preview ảnh khi chọn file
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('avatarPreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        // Toastify thông báo
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('status') === 'profile-updated')
                Toastify({
                    text: "Cập nhật hồ sơ thành công!",
                    duration: 3000,
                    backgroundColor: "#4CAF50",
                    gravity: "top", position: "right", close: true
                }).showToast();
            @endif

            @if ($errors->any())
                Toastify({
                    text: "Vui lòng kiểm tra lại thông tin nhập vào.",
                    duration: 3000,
                    backgroundColor: "#F44336",
                    gravity: "top", position: "right", close: true
                }).showToast();
            @endif
        });
    </script>
</body>
</html>