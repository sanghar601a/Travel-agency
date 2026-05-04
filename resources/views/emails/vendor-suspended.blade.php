<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #1e293b; padding: 40px; }
        .container { max-width: 600px; background-color: #ffffff; border-radius: 24px; padding: 40px; margin: 0 auto; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e2e8f0; }
        .logo { font-size: 24px; font-weight: 800; color: #4f46e5; text-transform: uppercase; letter-spacing: -1px; margin-bottom: 30px; }
        h1 { font-size: 24px; font-weight: 800; color: #e11d48; margin-bottom: 20px; line-height: 1.2; }
        p { font-size: 16px; line-height: 1.6; color: #64748b; margin-bottom: 24px; }
        .notice-box { border-left: 4px solid #e11d48; background-color: #fff1f2; padding: 20px; margin-bottom: 30px; }
        .footer { font-size: 12px; color: #94a3b8; text-align: center; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">Pak Travel</div>
        <h1>Account Notice</h1>
        <p>Hi {{ $vendor->agency_name }},</p>
        <p>This is to inform you that your vendor account on Pak Travel has been <strong>suspended</strong> by the administrator.</p>
        
        <div class="notice-box">
            <p style="margin-bottom: 0; color: #9f1239; font-weight: 600;">Your account access has been temporarily restricted and your tour listings are now hidden from the public.</p>
        </div>

        <p>If you believe this is a mistake or would like to discuss the reasons for this suspension, please contact our support team as soon as possible.</p>
        
        <p>Thank you for your cooperation.</p>
        
        <div class="footer">
            © 2026 Pak Travel Marketplaces. All rights reserved.<br>
            For support, please reply to this email or visit our help center.
        </div>
    </div>
</body>
</html>
