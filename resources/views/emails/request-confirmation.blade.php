<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Request Confirmed</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8f9fa; padding: 30px; border-radius: 10px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="https://res.cloudinary.com/dc3cbupaq/image/upload/v1768134861/Untitled_design_7_z0gxhq.png" alt="BNHS Logo" style="height: 100px; width: auto;">
        </div>
        <h1 style="color: #2563eb; margin-top: 0; text-align: center;">Bato National High School</h1>
        <h2 style="color: #1f2937;">Document Request Confirmed</h2>
        
        <p>Dear {{ $request->first_name }} {{ $request->last_name }},</p>
        
        <p>Your document request has been successfully submitted and received. We will process your request as soon as possible.</p>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #1f2937;">Request Details</h3>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Tracking ID:</td>
                    <td style="padding: 8px 0; font-weight: bold; color: #2563eb;">{{ $request->tracking_id }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Document Type:</td>
                    <td style="padding: 8px 0; font-weight: bold;">{{ $request->documentType->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Quantity:</td>
                    <td style="padding: 8px 0; font-weight: bold;">{{ $request->quantity }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Status:</td>
                    <td style="padding: 8px 0; font-weight: bold; text-transform: capitalize;">{{ $request->status }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Estimated Completion:</td>
                    <td style="padding: 8px 0; font-weight: bold;">{{ $request->estimated_completion_date->format('F d, Y') }}</td>
                </tr>
            </table>
        </div>

        <p><strong>Save your tracking ID:</strong> Use <span style="background: #fef3c7; padding: 2px 8px; border-radius: 4px; font-weight: bold;">{{ $request->tracking_id }}</span> to track your request status online.</p>

        <p>You will receive email notifications when the status of your request changes.</p>

        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #6b7280; text-align: center;">
            © {{ date('Y') }} Bato National High School. All rights reserved.
        </p>
    </div>
</body>
</html>
