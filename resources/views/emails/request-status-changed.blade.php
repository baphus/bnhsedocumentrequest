<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Status Update</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #f8f9fa; padding: 30px; border-radius: 10px;">
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="https://res.cloudinary.com/dc3cbupaq/image/upload/v1768134861/Untitled_design_7_z0gxhq.png" alt="BNHS Logo" style="height: 100px; width: auto;">
        </div>
        <h1 style="color: #2563eb; margin-top: 0; text-align: center;">Bato National High School</h1>
        <h2 style="color: #1f2937;">Request Status Update</h2>
        
        <p>Dear {{ $request->first_name }} {{ $request->last_name }},</p>
        
        <p>The status of your document request has been updated.</p>
        
        <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
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
                    <td style="padding: 8px 0; color: #6b7280;">Current Status:</td>
                    <td style="padding: 8px 0; font-weight: bold; text-transform: capitalize;">
                        <span style="
                            @if($request->status === 'pending') background: #e5e7eb; color: #374151;
                            @elseif($request->status === 'processing') background: #dbeafe; color: #1e40af;
                            @elseif($request->status === 'ready') background: #d1fae5; color: #065f46;
                            @elseif($request->status === 'completed') background: #e0e7ff; color: #3730a3;
                            @endif
                            padding: 4px 12px; border-radius: 9999px; display: inline-block;">
                            {{ ucfirst($request->status) }}
                        </span>
                    </td>
                </tr>
                @if($request->estimated_completion_date)
                <tr>
                    <td style="padding: 8px 0; color: #6b7280;">Estimated Completion:</td>
                    <td style="padding: 8px 0; font-weight: bold;">{{ $request->estimated_completion_date->format('F d, Y') }}</td>
                </tr>
                @endif
            </table>
        </div>

        @if($request->admin_remarks)
        <div style="background: #eff6ff; padding: 15px; border-left: 4px solid #2563eb; border-radius: 4px; margin: 20px 0;">
            <p style="margin: 0; font-weight: bold; color: #1e40af;">Registrar's Remarks:</p>
            <p style="margin: 5px 0 0 0; color: #1e3a8a;">{{ $request->admin_remarks }}</p>
        </div>
        @endif

        @if($request->status === 'ready')
        <div style="background: #d1fae5; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0; font-weight: bold; color: #065f46;">✓ Your document is ready for pickup!</p>
            <p style="margin: 5px 0 0 0; color: #047857;">Please visit the Registrar's Office during office hours to claim your document.</p>
        </div>
        @elseif($request->status === 'completed')
        <div style="background: #e0e7ff; padding: 15px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0; font-weight: bold; color: #3730a3;">✓ Request Completed</p>
            <p style="margin: 5px 0 0 0; color: #4338ca;">Your document request has been successfully completed. Thank you!</p>
        </div>
        @endif

        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #6b7280; text-align: center;">
            © {{ date('Y') }} Bato National High School. All rights reserved.
        </p>
    </div>
</body>
</html>
