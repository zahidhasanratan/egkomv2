<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f5f5f5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(90deg, #648b45 0%, #223f1f 100%); padding: 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 600;">EZBOOKING - Vendor Portal</h1>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #333; font-size: 20px; margin-top: 0; margin-bottom: 20px;">Hello {{ $name }},</h2>
                            
                            <p style="color: #666; font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                                We received a request to reset your password. Click the button below to reset it:
                            </p>
                            
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $resetUrl }}" style="display: inline-block; padding: 14px 30px; background: linear-gradient(90deg, #648b45 0%, #223f1f 100%); color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px;">Reset Password</a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 10px;">
                                Or copy and paste this link into your browser:
                            </p>
                            <p style="color: #648b45; font-size: 14px; word-break: break-all; margin-bottom: 20px;">
                                {{ $resetUrl }}
                            </p>
                            
                            <p style="color: #999; font-size: 14px; line-height: 1.6; margin-bottom: 0;">
                                This link will expire in 60 minutes. If you didn't request a password reset, please ignore this email.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 20px; text-align: center; border-top: 1px solid #eee;">
                            <p style="color: #999; font-size: 12px; margin: 0;">
                                © {{ date('Y') }} EZBOOKING. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

