<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($hospital->name); ?> - Medpro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .text-primary { color: #00b5f1; }
        .bg-primary { background-color: #00b5f1; }
        .btn-primary { background-color: #00b5f1; color: white; }
        .btn-primary:hover { background-color: #009cd0; }
        .shadow-card { box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="bg-gray-50">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-extrabold text-primary">medpro</a>
            <div class="hidden md:flex gap-6 text-sm font-bold text-gray-600">
                <a href="#" class="hover:text-primary">Trang chủ</a>
                <a href="#" class="hover:text-primary">Cơ sở y tế</a>
                <a href="#" class="hover:text-primary">Tin tức</a>
            </div>
        </div>
    </header>

    <div class="bg-gray-50 py-3 border-b border-gray-100">
        <div class="container mx-auto px-4 text-sm text-gray-500">
            <a href="/" class="hover:text-primary">Trang chủ</a> 
            <span class="mx-2">›</span>
            <a href="#" class="hover:text-primary"><?php echo e($hospital->type); ?></a>
            <span class="mx-2">›</span>
            <span class="text-gray-800 font-semibold"><?php echo e($hospital->name); ?></span>
        </div>
    </div>

    <div class="container mx-auto px-4 py-6">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-10">
            
            <div class="lg:col-span-5">
                <div class="bg-white rounded-2xl p-6 shadow-card h-full flex flex-col border border-gray-100">
                    <div class="flex flex-col items-center text-center mb-6">
                        <div class="w-32 h-32 border border-gray-200 rounded-xl flex items-center justify-center mb-4 p-2 bg-white shadow-sm">
                            <img src="<?php echo e(asset('storage/' . $hospital->logo)); ?>" 
                                 onerror="this.src='https://placehold.co/200x200?text=No+Logo'"
                                 class="w-full h-full object-contain" alt="Logo">
                        </div>
                        <h1 class="text-xl font-extrabold text-primary flex items-center gap-1 leading-tight">
                            <?php echo e($hospital->name); ?>

                            <i class="fas fa-check-circle text-blue-500 text-lg" title="Đã xác thực"></i>
                        </h1>
                        <div class="flex items-center gap-1 text-yellow-400 text-sm mt-2 bg-yellow-50 px-3 py-1 rounded-full">
                            <span class="font-bold text-gray-600 text-lg mr-1">4.7</span>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>

                    <div class="space-y-4 flex-1 text-sm text-gray-600">
                        <div class="flex gap-3 items-start">
                            <i class="fas fa-map-marker-alt text-orange-400 mt-1 text-lg min-w-[20px]"></i>
                            <p class="font-medium"><?php echo e($hospital->address); ?></p>
                        </div>
                        <div class="flex gap-3 items-start">
                             <i class="far fa-clock text-orange-400 mt-1 text-lg min-w-[20px]"></i>
                             <div class="text-gray-600">
                              <?php if($hospital->work_hours): ?>
                                   <?php echo nl2br(e($hospital->work_hours)); ?>

                               <?php else: ?>
                                 <p>Thứ 2 - Thứ 6 (07:00 - 17:00)</p>
                                 <?php endif; ?>
                                 </div>
                            </div>
                        <div class="flex gap-3 items-center">
                            <i class="fas fa-phone-alt text-orange-400 text-lg min-w-[20px]"></i>
                            <p>Tổng đài đặt khám: <span class="font-bold text-xl text-gray-800"><?php echo e($hospital->hotline); ?></span></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-8">
                        <button class="border-2 border-primary text-primary font-bold py-3 rounded-full hover:bg-blue-50 transition">
                            Xem chi tiết
                        </button>
                        <button class="btn-primary font-bold py-3 rounded-full shadow-lg shadow-cyan-200 transition transform hover:-translate-y-1">
                            Đặt khám ngay
                        </button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="bg-white p-2 rounded-2xl shadow-card h-full border border-gray-100">
                    <div class="relative h-full min-h-[400px] rounded-xl overflow-hidden group bg-gray-100 flex flex-col">
                        
                        <div class="flex-1 relative overflow-hidden">
                            <?php if($hospital->images && $hospital->images->count() > 0): ?>
                                <img src="<?php echo e(asset('storage/' . $hospital->images->first()->image_path)); ?>" 
                                     class="w-full h-full object-cover transition duration-500 absolute inset-0" 
                                     id="mainSliderImage"
                                     alt="Slide">
                            <?php else: ?>
                                <div class="flex items-center justify-center h-full text-gray-400 flex-col">
                                    <i class="fas fa-image text-6xl mb-2"></i>
                                    <p>Chưa có hình ảnh</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if($hospital->images && $hospital->images->count() > 0): ?>
<div class="h-20 bg-white border-t p-2 flex gap-2 overflow-x-auto">
    <?php $__currentLoopData = $hospital->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <img src="<?php echo e(asset('storage/' . $img->image_path)); ?>" 
             onclick="changeImage(this.src)" 
             class="h-full w-24 object-cover rounded-lg cursor-pointer border-2 border-transparent hover:border-primary transition opacity-70 hover:opacity-100"
             alt="Thumbnail">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-12">
            <h2 class="text-2xl font-extrabold text-primary mb-8 relative inline-block">
                Các dịch vụ
                <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-orange-400 rounded-full"></span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border border-gray-50 cursor-pointer group">
                    <div class="w-16 h-16 mx-auto bg-blue-50 text-primary rounded-2xl flex items-center justify-center mb-4 text-3xl group-hover:bg-primary group-hover:text-white transition">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Khám dịch vụ</h3>
                    <p class="text-sm text-gray-500">(Không thanh toán bảo hiểm)</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border border-gray-50 cursor-pointer group">
                    <div class="w-16 h-16 mx-auto bg-blue-50 text-primary rounded-2xl flex items-center justify-center mb-4 text-3xl group-hover:bg-primary group-hover:text-white transition">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Đặt khám theo Bác sĩ</h3>
                    <p class="text-sm text-gray-500">(Chủ động chọn bác sĩ)</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition border border-gray-50 cursor-pointer group">
                    <div class="w-16 h-16 mx-auto bg-blue-50 text-primary rounded-2xl flex items-center justify-center mb-4 text-3xl group-hover:bg-primary group-hover:text-white transition">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Đặt khám ngoài giờ</h3>
                    <p class="text-sm text-gray-500">(Phục vụ sau 16h30)</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8 space-y-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-l-4 border-primary pl-3">Mô tả chi tiết</h3>
                    <div class="text-gray-600 leading-relaxed text-justify space-y-4">
                        <?php echo nl2br(e($hospital->description)); ?>

                        
                        <?php if(!$hospital->description): ?>
                            <p>Thông tin đang được cập nhật...</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-4">
                <img src="https://medpro.vn/_next/image?url=https%3A%2F%2Fcdn-pkh.longvan.net%2Fprod-partner%2F5272e7d7-0233-4087-8245-73190000f30a-20240522_095754.png&w=1920&q=75" class="w-full rounded-2xl shadow-md hover:opacity-90 transition cursor-pointer">
                <img src="https://medpro.vn/_next/image?url=https%3A%2F%2Fcdn-pkh.longvan.net%2Fprod-partner%2F38453022-5002-4226-8206-227429c4382b-20240819_101736.jpg&w=1920&q=75" class="w-full rounded-2xl shadow-md hover:opacity-90 transition cursor-pointer">
            </div>
        </div>

    </div>

    <footer class="bg-white border-t mt-12 py-8 text-center text-gray-500 text-sm">
        <div class="container mx-auto">
            <p class="font-bold text-lg text-primary mb-2">MEDPRO - ĐẶT LỊCH KHÁM NHANH</p>
            <p>Copyright © 2025 Medpro Clone. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function changeImage(src) {
            const mainImage = document.getElementById('mainSliderImage');
            // Hiệu ứng mờ đi rồi hiện lại
            mainImage.style.opacity = 0;
            setTimeout(() => {
                mainImage.src = src;
                mainImage.style.opacity = 1;
            }, 200);
        }
    </script>

</body>
</html><?php /**PATH C:\xampp\htdocs\Project_Yte\resources\views/frontend/hospitals/show.blade.php ENDPATH**/ ?>