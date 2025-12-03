<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử khám bệnh - Medpro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        body { font-family: 'Nunito', sans-serif; }
        .text-medpro { color: #00b5f1; }
        .bg-medpro { background-color: #00b5f1; }
        .hover-text-medpro:hover { color: #00b5f1; }
    </style>
</head>
<body class="bg-gray-50">

    <!-- 1. HEADER -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-8">
                <a href="/" class="text-2xl font-bold text-medpro">medpro</a>
                <nav class="hidden md:flex gap-6 text-gray-600 font-medium">
                    <a href="/" class="hover:text-medpro">Trang chủ</a>
                    <a href="#" class="hover:text-medpro">Cơ sở y tế</a>
                    <a href="#" class="hover:text-medpro">Tin tức</a>
                </nav>
            </div>

            <div class="flex items-center gap-4">
                <!-- Nút Đăng xuất -->
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="text-gray-500 hover:text-red-500 text-sm font-bold">
                        Đăng xuất
                    </button>
                </form>

                <!-- User Info -->
                <div class="text-medpro font-bold border border-cyan-500 px-4 py-2 rounded-full text-sm bg-cyan-50 cursor-default">
                    Chào, <?php echo e(Auth::user()->name); ?>

                </div>
            </div>
        </div>
    </header>

    <!-- 2. NỘI DUNG CHÍNH -->
    <div class="container mx-auto px-4 py-10 min-h-screen">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-500 pl-3">
                Lịch sử khám bệnh
            </h2>
            <a href="/" class="text-sm text-gray-500 hover:text-medpro flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Đặt khám mới
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="p-6">
                <?php if($appointments->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 uppercase text-xs leading-normal">
                                    <th class="py-3 px-4">Mã phiếu</th>
                                    <th class="py-3 px-4">Bác sĩ / Dịch vụ</th>
                                    <th class="py-3 px-4 text-center">Ngày khám</th>
                                    <th class="py-3 px-4 text-center">Giờ khám</th>
                                    <th class="py-3 px-4 text-center">Trạng thái</th>
                                    <th class="py-3 px-4 text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                    <td class="py-4 px-4 font-bold text-medpro">
                                        #<?php echo e($app->id); ?>

                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full overflow-hidden mr-3 border border-gray-200">
                                                <img class="w-full h-full object-cover" src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($app->doctor->name)); ?>&background=random"/>
                                            </div>
                                            <div>
                                                <span class="font-bold text-gray-800 block"><?php echo e($app->doctor->name); ?></span>
                                                <span class="text-xs text-gray-500"><?php echo e($app->doctor->specialty->name ?? 'Chuyên khoa'); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-center font-bold">
                                        <?php echo e(\Carbon\Carbon::parse($app->appointment_date)->format('d/m/Y')); ?>

                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="bg-blue-50 text-blue-600 py-1 px-3 rounded-full text-xs font-bold border border-blue-100">
                                            <?php echo e($app->appointment_time); ?>

                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <?php if($app->status == 'pending'): ?>
                                            <span class="bg-yellow-100 text-yellow-700 py-1 px-3 rounded-full text-xs font-bold border border-yellow-200">
                                                <span class="w-2 h-2 rounded-full bg-yellow-500 inline-block mr-1"></span> Chờ xác nhận
                                            </span>
                                        <?php elseif($app->status == 'confirmed'): ?>
                                            <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs font-bold border border-green-200">
                                                <span class="w-2 h-2 rounded-full bg-green-500 inline-block mr-1"></span> Đã duyệt
                                            </span>
                                        <?php elseif($app->status == 'cancelled'): ?>
                                            <span class="bg-red-100 text-red-700 py-1 px-3 rounded-full text-xs font-bold border border-red-200">
                                                <span class="w-2 h-2 rounded-full bg-red-500 inline-block mr-1"></span> Đã hủy
                                            </span>
                                        <?php else: ?>
                                            <span class="bg-gray-100 text-gray-700 py-1 px-3 rounded-full text-xs font-bold">Hoàn thành</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <?php if($app->status == 'pending'): ?>
                                            <form action="<?php echo e(route('booking.cancel', $app->id)); ?>" method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy lịch này không?');">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="text-red-500 hover:text-white border border-red-500 hover:bg-red-500 px-3 py-1 rounded-lg text-xs font-bold transition">
                                                    Hủy lịch
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="text-gray-400 text-xs italic">---</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-16">
                        <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <p class="text-gray-500 text-lg mb-4 font-medium">Bạn chưa có lịch khám nào.</p>
                        <a href="<?php echo e(route('home')); ?>" class="bg-medpro text-white px-6 py-2.5 rounded-full font-bold hover:opacity-90 transition shadow-lg shadow-blue-200">
                            Đặt khám ngay
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- 3. FOOTER -->
    <footer class="bg-gray-800 text-white py-8 text-center mt-auto">
        <p class="opacity-80">Copyright © 2025 Medpro Clone. Built with Laravel 11.</p>
    </footer>

    <!-- SCRIPT THÔNG BÁO (ĐÃ SỬA TRIỆT ĐỂ LỖI SYNTAX CHO VS CODE) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sử dụng dấu nháy kép bao quanh blade directive
            // VS Code sẽ hiểu đây là một chuỗi string bình thường -> Không báo lỗi nữa
            var successMsg = "<?php echo e(session('success')); ?>";
            var errorMsg = "<?php echo e(session('error')); ?>";

            if (successMsg) {
                Toastify({
                    text: successMsg,
                    duration: 3000,
                    close: true,
                    gravity: "top", 
                    position: "right", 
                    backgroundColor: "#4CAF50",
                }).showToast();
            }

            if (errorMsg) {
                Toastify({
                    text: errorMsg,
                    duration: 3000,
                    close: true,
                    gravity: "top", 
                    position: "right", 
                    backgroundColor: "#F44336",
                }).showToast();
            }
        });
    </script>

</body>
</html><?php /**PATH C:\xampp\htdocs\Project_Yte\resources\views/dashboard.blade.php ENDPATH**/ ?>