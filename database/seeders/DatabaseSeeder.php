<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // -------------------------------------------------------
        // 1. TẠO TÀI KHOẢN (Dùng để đăng nhập test)
        // -------------------------------------------------------
        
        // Admin
        User::factory()->create([
            'name' => 'Admin Tổng',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ]);

        // User (Bệnh nhân)
        User::factory()->create([
            'name' => 'Nguyễn Văn Bệnh Nhân',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
        ]);

        // Doctor (Bác sĩ)
        User::factory()->create([
            'name' => 'Bác Sĩ Chuyên Khoa',
            'email' => 'doctor@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'doctor',
        ]);

        // -------------------------------------------------------
        // 2. TẠO CHUYÊN KHOA
        // -------------------------------------------------------
        $k_tim = Specialty::create(['name' => 'Tim mạch', 'image' => 'tim-mach.png']);
        $k_nhi = Specialty::create(['name' => 'Nhi khoa', 'image' => 'nhi-khoa.png']);
        $k_san = Specialty::create(['name' => 'Sản phụ khoa', 'image' => 'san-phu-khoa.png']);
        $k_mat = Specialty::create(['name' => 'Chuyên khoa Mắt', 'image' => 'mat.png']);
        $k_da = Specialty::create(['name' => 'Da liễu', 'image' => 'da-lieu.png']);

        // -------------------------------------------------------
        // 3. TẠO BỆNH VIỆN
        // -------------------------------------------------------
        $bv_cr = Hospital::create([
            'name' => 'Bệnh viện Chợ Rẫy',
            'address' => '201B Nguyễn Chí Thanh, Q.5, TP.HCM',
            'hotline' => '1900 1234',
            'logo' => 'logo-cr.png'
        ]);
        
        $bv_yd = Hospital::create([
            'name' => 'Đại học Y Dược TP.HCM',
            'address' => '215 Hồng Bàng, Q.5, TP.HCM',
            'hotline' => '1900 5678',
            'logo' => 'logo-yd.png'
        ]);

        // -------------------------------------------------------
        // 4. TẠO BÁC SĨ (DỮ LIỆU GIỐNG ẢNH MEDPRO)
        // -------------------------------------------------------

        // Bác sĩ chính (BS CKII. Ngô Trung Nam)
        Doctor::create([
            'name' => 'BS CKII. Ngô Trung Nam',
            'hospital_id' => $bv_cr->id,
            'specialty_id' => $k_san->id,
            'price' => 200000,
            'treatments' => 'Phẫu thuật nội soi phụ khoa - Mổ thai ngoài nội soi - bóc u nang - u xơ - thu hẹp âm đạo - Tái tạo màng trinh; Điều trị lạc nội mạc tử cung; Siêu âm bơm nước buồng tử cung; Soi cổ tử cung...',
            'bio' => 'Bác sĩ CKII Ngô Trung Nam là chuyên gia Sản Phụ khoa với hơn 18 năm kinh nghiệm tại các bệnh viện lớn như Hùng Vương, FV và Đại học Y Dược TP.HCM. Ông có chuyên môn sâu trong phẫu thuật nội soi phụ khoa, điều trị lạc nội mạc tử cung, y học bào thai và quản lý thai kỳ nguy cơ cao.',
            'experience' => '
                <ul class="list-disc pl-5 space-y-2">
                    <li>Siêu âm Doppler, Tổ chức y học bào thai FMF, London - Vương quốc Anh 2010</li>
                    <li>Soi cổ tử cung nâng cao, Trường Đại học Y dược Tp.HCM, 2013.</li>
                    <li>Siêu âm tim thai và bệnh lý tim bẩm sinh khóa 2, Viện tim Tp.HCM, 2013.</li>
                    <li>Tầm soát ung thư cổ tử cung trong thời đại HPV, BV Hùng Vương, 2013.</li>
                    <li>Phá thai nội khoa, BV Từ Dũ, 2014.</li>
                    <li>Phẫu thuật nội soi cơ bản trong phụ khoa, BV Từ Dũ, 2015</li>
                    <li>Đánh giá Tiền sản giật, Tổ chức y học bào thai FMF, London - Vương quốc Anh 2018</li>
                </ul>'
        ]);

        // --- BÁC SĨ LIÊN QUAN (Để hiển thị mục "Bác sĩ cùng cơ sở") ---
        
        // 1. Bác sĩ Tim mạch (cùng BV Chợ Rẫy)
        Doctor::create([
            'name' => 'BS.CKI. Đỗ Đăng Khoa',
            'hospital_id' => $bv_cr->id, 
            'specialty_id' => $k_tim->id,
            'price' => 200000,
            'treatments' => 'BS Đỗ Đăng Khoa là Bác sĩ chuyên ngành Nội tim mạch – Tim mạch can thiệp.',
            'bio' => 'Chuyên gia tim mạch hàng đầu.',
            'experience' => '<ul class="list-disc pl-5"><li>10 năm kinh nghiệm tại khoa Tim mạch can thiệp</li></ul>'
        ]);

        // 2. Bác sĩ Nhi (cùng BV Chợ Rẫy)
        Doctor::create([
            'name' => 'Ths BS. Lê Hoàng Thiên',
            'hospital_id' => $bv_cr->id,
            'specialty_id' => $k_nhi->id,
            'price' => 149000,
            'treatments' => 'Nội tổng quát',
            'bio' => 'Bác sĩ nhi khoa tận tâm.',
            'experience' => '<ul class="list-disc pl-5"><li>Chuyên khoa Nhi BV Nhi Đồng 1</li></ul>'
        ]);

         // 3. Bác sĩ Mắt (cùng BV Chợ Rẫy)
         Doctor::create([
            'name' => 'BS CKI. Vũ Thị Hà',
            'hospital_id' => $bv_cr->id,
            'specialty_id' => $k_mat->id,
            'price' => 150000,
            'treatments' => 'Điều trị, tư vấn cũng như phẫu thuật các bệnh lý tại mắt như đục thể thủy tinh, glaucoma, mộng thịt...',
            'bio' => 'Bác sĩ chuyên khoa Mắt.',
            'experience' => '<ul class="list-disc pl-5"><li>Phẫu thuật viên chính khoa Mắt</li></ul>'
        ]);

        // 4. Bác sĩ Da liễu (cùng BV Chợ Rẫy)
        Doctor::create([
            'name' => 'Bác sĩ Vũ Đình Khôi',
            'hospital_id' => $bv_cr->id,
            'specialty_id' => $k_da->id,
            'price' => 150000,
            'treatments' => 'Khám, chẩn đoán và điều trị các bệnh Da Liễu người lớn và trẻ em: Ngứa mạn tính, nhiễm giun sán các loại...',
            'bio' => 'Chuyên gia da liễu.',
            'experience' => '<ul class="list-disc pl-5"><li>Trưởng khoa Da liễu</li></ul>'
        ]);

        // Bác sĩ ở bệnh viện khác (Để test không hiện ra ở mục liên quan)
        Doctor::create([
            'name' => 'ThS. BS Trần Thị B',
            'hospital_id' => $bv_yd->id, // BV Y Dược
            'specialty_id' => $k_nhi->id,
            'price' => 300000,
            'bio' => 'Chuyên gia tâm lý trẻ em.'
        ]);
    }
}