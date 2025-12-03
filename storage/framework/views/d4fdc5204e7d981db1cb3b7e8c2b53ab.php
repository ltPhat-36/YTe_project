<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Medpro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <style>
        body { font-family: 'Nunito', sans-serif; }
        .active-nav { @apply bg-blue-50 text-blue-600 border-r-4 border-blue-600; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans leading-normal tracking-normal">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white shadow-md hidden md:flex flex-col z-20">
            <div class="h-16 flex items-center justify-center border-b border-gray-200">
                <a href="/" class="text-2xl font-extrabold text-blue-600 flex items-center gap-2">
                    <i class="fas fa-heartbeat"></i> MEDPRO
                </a>
            </div>

            <div class="flex-1 overflow-y-auto py-4">
                <nav class="space-y-1">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 px-6 py-3 hover:bg-gray-50 transition active-nav">
                        <i class="fas fa-th-large w-5"></i> Dashboard
                    </a>

                    <div class="px-6 pt-4 pb-2 text-xs font-bold text-gray-400 uppercase">Quản lý hệ thống</div>
                    
                    <a href="<?php echo e(route('admin.hospitals.create')); ?>" class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition group">
                        <i class="fas fa-hospital w-5 group-hover:text-blue-600"></i> 
                        <span>Cơ sở y tế</span>
                        <i class="fas fa-plus ml-auto text-xs opacity-0 group-hover:opacity-100 bg-blue-100 p-1 rounded-full text-blue-600"></i>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                        <i class="fas fa-user-md w-5"></i> Bác sĩ
                    </a>

                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                        <i class="fas fa-calendar-check w-5"></i> Lịch hẹn
                    </a>

                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                        <i class="fas fa-users w-5"></i> Bệnh nhân
                    </a>

                    <div class="px-6 pt-4 pb-2 text-xs font-bold text-gray-400 uppercase">Cài đặt</div>
                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                        <i class="fas fa-cog w-5"></i> Cấu hình chung
                    </a>
                </nav>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 z-10">
                <div class="flex items-center">
                    <button class="md:hidden text-gray-500 focus:outline-none mr-4">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-xl font-bold text-gray-700">Tổng quan</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <div class="text-gray-800 font-bold text-sm"><?php echo e(Auth::user()->name); ?></div>
                        <div class="text-gray-500 text-xs">Admin</div>
                    </div>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="bg-gray-100 hover:bg-red-50 hover:text-red-600 text-gray-600 w-10 h-10 rounded-full flex items-center justify-center transition" title="Đăng xuất">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                
                <div class="mb-8 flex gap-4">
                    <a href="<?php echo e(route('admin.hospitals.create')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg shadow-blue-500/30 flex items-center gap-2 transition transform hover:-translate-y-1">
                        <i class="fas fa-plus-circle"></i> Thêm Cơ Sở Y Tế Mới
                    </a>
                    </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500 flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Tổng bệnh nhân</p>
                            <p class="text-2xl font-extrabold text-gray-800 mt-1"><?php echo e(number_format($totalPatients)); ?></p>
                        </div>
                        <div class="text-blue-200"><i class="fas fa-users text-4xl"></i></div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500 flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Đội ngũ bác sĩ</p>
                            <p class="text-2xl font-extrabold text-gray-800 mt-1"><?php echo e($totalDoctors); ?></p>
                        </div>
                        <div class="text-green-200"><i class="fas fa-user-md text-4xl"></i></div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500 flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Lịch hẹn</p>
                            <p class="text-2xl font-extrabold text-gray-800 mt-1"><?php echo e(number_format($totalAppointments)); ?></p>
                        </div>
                        <div class="text-purple-200"><i class="fas fa-calendar-check text-4xl"></i></div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-orange-500 flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase">Doanh thu</p>
                            <p class="text-2xl font-extrabold text-orange-500 mt-1"><?php echo e(number_format($totalRevenue)); ?> đ</p>
                        </div>
                        <div class="text-orange-200"><i class="fas fa-coins text-4xl"></i></div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-gray-700">Lịch đặt khám gần đây</h3>
                        <span class="text-xs text-gray-500">Cập nhật realtime</span>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr class="bg-white text-gray-600 uppercase text-xs leading-normal font-bold tracking-wider">
                                    <th class="px-5 py-3 text-left">Mã</th>
                                    <th class="px-5 py-3 text-left">Bệnh nhân</th>
                                    <th class="px-5 py-3 text-left">Bác sĩ</th>
                                    <th class="px-5 py-3 text-center">Thời gian</th>
                                    <th class="px-5 py-3 text-center">Trạng thái</th>
                                    <th class="px-5 py-3 text-center">Xử lý</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                    <td class="px-5 py-4"><span class="font-bold text-blue-600">#<?php echo e($app->id); ?></span></td>
                                    <td class="px-5 py-4">
                                        <div class="font-bold text-gray-800"><?php echo e($app->user->name); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo e($app->user->phone ?? '---'); ?></div>
                                    </td>
                                    <td class="px-5 py-4 text-gray-700"><?php echo e($app->doctor->name); ?></td>
                                    <td class="px-5 py-4 text-center">
                                        <div class="font-bold"><?php echo e($app->appointment_time); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo e(\Carbon\Carbon::parse($app->appointment_date)->format('d/m/Y')); ?></div>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <?php if($app->status == 'pending'): ?>
                                            <span class="px-2 py-1 font-semibold text-yellow-700 bg-yellow-100 rounded-full text-xs">⏳ Chờ duyệt</span>
                                        <?php elseif($app->status == 'confirmed'): ?>
                                            <span class="px-2 py-1 font-semibold text-green-700 bg-green-100 rounded-full text-xs">✅ Đã duyệt</span>
                                        <?php elseif($app->status == 'cancelled'): ?>
                                            <span class="px-2 py-1 font-semibold text-red-700 bg-red-100 rounded-full text-xs">❌ Hủy</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 font-semibold text-gray-700 bg-gray-100 rounded-full text-xs">Hoàn thành</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <?php if($app->status == 'pending'): ?>
                                                <form action="<?php echo e(route('admin.appointment.update', $app->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?> <input type="hidden" name="status" value="confirmed">
                                                    <button class="w-8 h-8 rounded bg-green-500 text-white hover:bg-green-600 flex items-center justify-center shadow"><i class="fas fa-check"></i></button>
                                                </form>
                                                <form action="<?php echo e(route('admin.appointment.update', $app->id)); ?>" method="POST" onsubmit="return confirm('Hủy lịch này?');">
                                                    <?php echo csrf_field(); ?> <input type="hidden" name="status" value="cancelled">
                                                    <button class="w-8 h-8 rounded bg-red-500 text-white hover:bg-red-600 flex items-center justify-center shadow"><i class="fas fa-times"></i></button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-gray-300"><i class="fas fa-lock"></i></span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-5 py-3 border-t bg-gray-50"><?php echo e($appointments->links()); ?></div>
                </div>

            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gán nội dung session vào biến JS để tránh lỗi cú pháp trong Editor
            var successMessage = "<?php echo e(session('success')); ?>";
            
            if(successMessage) {
                Toastify({ 
                    text: successMessage, 
                    duration: 3000, 
                    backgroundColor: "#4CAF50" 
                }).showToast();
            }
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Project_Yte\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>