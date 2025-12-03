<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($currentType); ?> - Medpro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; } /* Ẩn thanh cuộn ngang cho đẹp */
    </style>
</head>
<body class="bg-gray-50">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-extrabold text-cyan-500">medpro</a>
            <div class="text-sm font-bold text-gray-500">Header Demo</div>
        </div>
    </header>

    <div class="bg-white pb-8 pt-4">
        <div class="container mx-auto px-4">
            <div class="text-sm text-gray-500 mb-6 flex gap-2 items-center">
                <a href="/" class="hover:text-cyan-500">Trang chủ</a> 
                <span class="text-gray-300">›</span> 
                <span class="font-bold text-gray-800"><?php echo e($currentType); ?></span>
            </div>

            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-3xl md:text-4xl font-extrabold text-cyan-500 mb-3"><?php echo e($currentType); ?></h1>
                <p class="text-gray-500 mb-8">Đặt khám dễ dàng, không lo chờ đợi tại các <?php echo e(Str::lower($currentType)); ?> hàng đầu Việt Nam</p>

                <form action="<?php echo e(route('search')); ?>" method="GET" class="relative max-w-xl mx-auto">
                    <input type="hidden" name="type" value="<?php echo e($currentType); ?>">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <i class="fas fa-search text-lg"></i>
                        </span>
                        <input type="text" name="keyword" value="<?php echo e($keyword); ?>" 
                               class="w-full py-3 pl-12 pr-4 bg-gray-100 rounded-full border-none focus:ring-2 focus:ring-cyan-500 text-gray-700 outline-none transition"
                               placeholder="Tìm kiếm cơ sở y tế...">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-white border-b sticky top-[60px] z-40 shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex gap-3 overflow-x-auto py-4 scrollbar-hide whitespace-nowrap">
                <?php $__currentLoopData = $typeCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeName => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('search', ['type' => $typeName])); ?>" 
                       class="px-5 py-2 rounded-full text-sm font-bold transition flex items-center gap-2 
                       <?php echo e($currentType == $typeName ? 'bg-cyan-500 text-white shadow-lg shadow-cyan-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                        <?php echo e($typeName); ?> 
                        <span class="<?php echo e($currentType == $typeName ? 'text-cyan-100' : 'text-gray-400'); ?>">(<?php echo e($count); ?>)</span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 min-h-screen">
        
        <?php if($hospitals->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-md transition flex flex-col sm:flex-row gap-5 group">
                    
                    <div class="w-full sm:w-32 h-32 flex-shrink-0 flex items-center justify-center bg-white rounded-xl border border-gray-100 p-2">
                        <img src="<?php echo e($hospital->logo ? asset('storage/' . $hospital->logo) : 'https://medpro.vn/_next/image?url=https%3A%2F%2Fcdn-pkh.longvan.net%2Fprod-partner%2F08e3e077-c744-4d97-af9a-5283d7259035-20231225_092222.png&w=128&q=75'); ?>" 
                             alt="<?php echo e($hospital->name); ?>" 
                             class="w-full h-full object-contain">
                    </div>

                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800 group-hover:text-cyan-600 transition leading-tight mb-2">
                                <?php echo e($hospital->name); ?>

                                <i class="fas fa-check-circle text-blue-500 text-sm ml-1" title="Đã xác minh"></i>
                            </h3>
                            
                            <p class="text-gray-500 text-sm mb-2 line-clamp-2">
                                <i class="fas fa-map-marker-alt text-orange-400 mr-1"></i> 
                                <?php echo e($hospital->address); ?>

                            </p>

                            <div class="flex items-center gap-1 text-sm mb-3">
                                <span class="font-bold text-orange-400">(4.7)</span>
                                <div class="text-yellow-400 text-xs">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-2">
                        <a href="<?php echo e(route('hospital.show', $hospital->id)); ?>" class="flex-1 bg-white border border-cyan-500 text-cyan-500 py-2 rounded-full text-sm font-bold hover:bg-cyan-50 transition text-center">
    Xem chi tiết
</a>
                            <a href="#" class="flex-1 bg-cyan-500 text-white py-2 rounded-full text-sm font-bold hover:bg-cyan-600 transition text-center shadow-lg shadow-cyan-200">
                                Đặt khám ngay
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-8">
                <?php echo e($hospitals->appends(['type' => $currentType, 'keyword' => $keyword])->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-20">
                <img src="https://medpro.vn/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fempty-data.3d330326.png&w=384&q=75" class="w-40 mx-auto mb-4 opacity-50">
                <p class="text-gray-500">Không tìm thấy cơ sở y tế nào phù hợp.</p>
            </div>
        <?php endif; ?>

    </div>

    <footer class="bg-gray-800 text-white py-8 text-center mt-10">
        <p>MEDPRO CLONE © 2025</p>
    </footer>

</body>
</html><?php /**PATH C:\xampp\htdocs\Project_Yte\resources\views/frontend/search.blade.php ENDPATH**/ ?>