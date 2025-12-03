<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận lịch khám</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; }
        .header { background-color: #00b5f1; color: white; padding: 15px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 20px; }
        .info-box { background-color: #f9f9f9; padding: 15px; border-left: 4px solid #00b5f1; margin: 15px 0; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 20px; }
        .btn { display: inline-block; background-color: #00b5f1; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>MEDPRO - Đặt Lịch Khám</h2>
        </div>
        <div class="content">
            <p>Xin chào <strong>{{ $appointment->user->name }}</strong>,</p>
            <p>Lịch đặt khám của bạn đã được <strong>XÁC NHẬN THÀNH CÔNG</strong>.</p>
            
            <div class="info-box">
                <p><strong>Mã phiếu:</strong> #{{ $appointment->id }}</p>
                <p><strong>Bác sĩ:</strong> {{ $appointment->doctor->name }}</p>
                <p><strong>Chuyên khoa:</strong> {{ $appointment->doctor->specialty->name }}</p>
                <p><strong>Thời gian:</strong> {{ $appointment->appointment_time }} - Ngày {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</p>
                <p><strong>Địa điểm:</strong> {{ $appointment->doctor->hospital->name }}</p>
                <p><strong>Địa chỉ:</strong> {{ $appointment->doctor->hospital->address }}</p>
            </div>

            <p>Vui lòng đến trước 15 phút để làm thủ tục.</p>
            <center>
                <a href="{{ route('dashboard') }}" class="btn">Xem chi tiết lịch hẹn</a>
            </center>
        </div>
        <div class="footer">
            <p>Cảm ơn bạn đã sử dụng dịch vụ của Medpro.</p>
            <p>Hotline hỗ trợ: 1900 2115</p>
        </div>
    </div>
</body>
</html>