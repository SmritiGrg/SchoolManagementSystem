<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Account Credentials</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .email-body {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #1e293b;
            margin-bottom: 20px;
        }
        .intro-text {
            color: #64748b;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        .credentials-box {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
        }
        .credentials-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 20px;
            text-align: center;
        }
        .credential-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .credential-item:last-child {
            border-bottom: none;
        }
        .credential-label {
            font-weight: 600;
            color: #475569;
        }
        .credential-value {
            color: #1e293b;
            font-family: 'Courier New', monospace;
            background: #ffffff;
            padding: 4px 12px;
            border-radius: 4px;
            border: 1px solid #cbd5e1;
        }
        .login-button {
            display: inline-block;
            background: #10b981;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
        }
        .login-button:hover {
            background: #059669;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .warning-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .warning-box p {
            margin: 0;
            color: #92400e;
            font-size: 14px;
        }
        .footer {
            background: #f8fafc;
            padding: 20px 30px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 5px 0;
        }
        .help-text {
            color: #64748b;
            font-size: 14px;
            margin-top: 30px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🎓 Welcome to EduFlow</h1>
        </div>
        
        <div class="email-body">
            <p class="greeting">Hello {{ $user->name }},</p>
            
            <p class="intro-text">
                Welcome to EduFlow! Your student account has been successfully created. 
                You can now access the student portal to view your classes, assignments, grades, and more.
            </p>
            
            <div class="credentials-box">
                <div class="credentials-title">Your Login Credentials</div>
                
                <div class="credential-item">
                    <span class="credential-label">Admission Number:</span>
                    <span class="credential-value">{{ $admissionNumber }}</span>
                </div>
                
                <div class="credential-item">
                    <span class="credential-label">Email:</span>
                    <span class="credential-value">{{ $user->email }}</span>
                </div>
                
                <div class="credential-item">
                    <span class="credential-label">Password:</span>
                    <span class="credential-value">{{ $password }}</span>
                </div>
            </div>
            
            <div class="warning-box">
                <p>
                    <strong>⚠️ Important:</strong> Please change your password after your first login for security purposes. 
                    Keep your credentials confidential and do not share them with anyone.
                </p>
            </div>
            
            <div class="button-container">
                <a href="{{ url('/login') }}" class="login-button">Login to Your Account</a>
            </div>
            
            <p class="help-text">
                If you have any questions or need assistance, please contact the school administration.
                We're excited to have you as part of our learning community!
            </p>
        </div>
        
        <div class="footer">
            <p><strong>EduFlow School Management System</strong></p>
            <p>This is an automated email. Please do not reply to this message.</p>
            <p>&copy; {{ date('Y') }} EduFlow. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
