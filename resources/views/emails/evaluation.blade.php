<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['subject'] }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="background-color: #ff6b6b; padding: 20px; text-align: center; color: white;">
                            <h1 style="margin: 0;">Student Evaluation</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="color: #333333;">{{ $details['greeting'] }}</h2>
                            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                                {{ $details['message'] }}
                            </p>


                            <p style="margin-top: 40px; font-size: 14px; color: #999999;">
                                If you have any questions, feel free to reply to this email.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9f9f9; padding: 20px; text-align: center; font-size: 12px; color: #999999;">
                            &copy; {{ date('Y') }} Student Evaluation. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
