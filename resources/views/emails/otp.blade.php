<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8f9fa; padding: 30px; border-radius: 10px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="https://res.cloudinary.com/dc3cbupaq/image/upload/v1768131525/bato-logo_wo3eqa.png" alt="BNHS Logo" style="height: 100px; width: auto;">
        </div>
        <h1 style="color: #2563eb; margin-top: 0; text-align: center;">Bato National High School</h1>
        <h2 style="color: #1f2937;">Your OTP Code</h2>
        
        <p>You have requested an OTP code for {{ $purpose === 'submission' ? 'document request submission' : 'request tracking' }}.</p>
        
        <div style="background: white; padding: 20px; border-radius: 8px; text-align: center; margin: 30px 0;">
            <p style="margin: 0; font-size: 14px; color: #6b7280;">Your OTP Code:</p>
            <h1 style="font-size: 48px; letter-spacing: 10px; color: #2563eb; margin: 10px 0;">{{ $otp->code }}</h1>
            <p style="margin: 0; font-size: 14px; color: #6b7280;">This code will expire in 10 minutes</p>
        </div>

        <p><strong>Important:</strong> This is a one-time password. Do not share this code with anyone.</p>

        <p>If you did not request this code, please ignore this email.</p>

        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #6b7280; text-align: center;">
            © {{ date('Y') }} Bato National High School. All rights reserved.
        </p>
    </div>
</body>
</html>
