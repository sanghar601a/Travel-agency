<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #1e293b; padding: 40px; }
        .container { max-width: 600px; background-color: #ffffff; border-radius: 24px; padding: 40px; margin: 0 auto; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e2e8f0; }
        .logo { font-size: 24px; font-weight: 800; color: #4f46e5; text-transform: uppercase; letter-spacing: -1px; margin-bottom: 30px; }
        h1 { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 20px; line-height: 1.2; }
        p { font-size: 16px; line-height: 1.6; color: #64748b; margin-bottom: 24px; }
        .status-box { background-color: #f1f5f9; border-radius: 16px; padding: 24px; margin-bottom: 30px; }
        .status-title { font-size: 14px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .status-value { font-size: 18px; font-weight: 800; color: #4f46e5; }
        .footer { font-size: 12px; color: #94a3b8; text-align: center; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">Pak Travel</div>
        <h1>Application Received!</h1>
        <p>Hi {{ $vendor->agency_name }},</p>
        <p>Thank you for your interest in joining Pak Travel! We have successfully received your application to become a partner.</p>
        
        <div class="status-box">
            <div class="status-title">Current Status</div>
            <div class="status-value">Review in Progress</div>
        </div>

        <p>Our verification team is currently reviewing your agency details. This process typically takes 24 to 48 hours.</p>
        <p>Once your account is approved, you will receive another email and gain full access to your vendor dashboard to start listing your amazing tours.</p>
        
        <p>Stay tuned!</p>
        
        <div class="footer">
            © 2026 Pak Travel Marketplaces. All rights reserved.<br>
            If you have any questions, reply to this email.
        </div>
    </div>
</body>
</html>
