<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #1e293b; padding: 40px; }
        .container { max-width: 600px; background-color: #ffffff; border-radius: 24px; padding: 40px; margin: 0 auto; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e2e8f0; }
        .logo { font-size: 24px; font-weight: 800; color: #4f46e5; text-transform: uppercase; letter-spacing: -1px; margin-bottom: 30px; }
        h1 { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 20px; line-height: 1.2; }
        p { font-size: 16px; line-height: 1.6; color: #64748b; margin-bottom: 24px; }
        .cta-button { display: inline-block; background-color: #4f46e5; color: #ffffff; padding: 16px 32px; border-radius: 12px; font-weight: 700; text-decoration: none; margin: 20px 0; }
        .success-icon { font-size: 48px; margin-bottom: 20px; }
        .footer { font-size: 12px; color: #94a3b8; text-align: center; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="container" style="text-align: center;">
        <div class="logo" style="text-align: left;">Pak Travel</div>
        <div class="success-icon">🎉</div>
        <h1>Congratulations!</h1>
        <p>Hi {{ $vendor->agency_name }},</p>
        <p>We are thrilled to inform you that your vendor account has been <strong>Approved</strong> and is now fully <strong>Active</strong>.</p>
        
        <p>You can now log in to your dashboard to create tour packages, manage bookings, and start growing your business with Pak Travel.</p>
        
        <a href="{{ route('vendor.dashboard') }}" class="cta-button">Go to Dashboard</a>

        <p>Welcome aboard! We are excited to see the amazing experiences you will offer to our travelers.</p>
        
        <div class="footer">
            © 2026 Pak Travel Marketplaces. All rights reserved.<br>
            Need help? Contact our partner support team.
        </div>
    </div>
</body>
</html>
