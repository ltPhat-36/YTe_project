<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; }
        .header { background-color: #e53e3e; color: white; padding: 15px; text-align: center; border-radius: 10px 10px 0 0; }
        .info-box { background-color: #fff5f5; padding: 15px; border-left: 4px solid #e53e3e; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Thông Báo Hủy Lịch</h2>
        </div>
        <div class="content">
            <p>Xin chào <strong>{{ $appointment->user->name }}</strong>,</p>
            <p>Rất tiếc, lịch khám của bạn mã số <strong>#{{ $appointment->id }}</strong> đã bị hủy.</p>
            
            <div class="info-box">
                <p><strong>Bác sĩ:</strong> {{ $appointment->doctor->name }}</p>
                <p><strong>Thời gian cũ:</strong> {{ $appointment->appointment_time }} - {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</p>
            </div>

            <p>Nếu bạn không thực hiện yêu cầu này hoặc cần hỗ trợ, vui lòng liên hệ hotline <strong>1900 2115</strong>.</p>
            <p>Bạn có thể đặt lại lịch khám mới bất cứ lúc nào.</p>
        </div>
    </div>
</body>
</html>