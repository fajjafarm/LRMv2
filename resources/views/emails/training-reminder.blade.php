{{-- 003 resources/views/emails/training-reminder.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reminder: Training Tomorrow – LRM</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f0f9ff; padding: 40px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
        <div style="background: linear-gradient(135deg, #0ea5e9, #3b82f6); padding: 60px 40px; text-align: center; color: white;">
            <h1 style="font-size: 48px; margin: 0;">REMINDER</h1>
            <p style="font-size: 32px; margin: 16px 0 0;">Your training is TOMORROW!</p>
        </div>
        <div style="padding: 60px 40px; text-align: center;">
            <div style="background: #f59e0b; width: 140px; height: 140px; border-radius: 50%; margin: 0 auto -70px; display: flex; align-items: center; justify-content: center;">
                <svg width="80" height="80" fill="white" viewBox="0 0 24 24">
                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 style="font-size: 40px; margin: 60px 0 20px;">Don't Forget!</h2>
            <div style="background: #dbeafe; padding: 40px; border-radius: 16px;">
                <h3 style="font-size: 36px; margin: 0; color: #1d4ed8;">{{ $session->qualification->name }}</h3>
                <p style="font-size: 32px; margin: 20px 0;">{{ $session->date->format('l j F Y') }}</p>
                <p style="font-size: 32px; color: #1d4ed8;">{{ $session->start_time->format('H:i') }} – {{ $session->end_time->format('H:i') }}</p>
            </div>
        </div>
    </div>
</body>
</html>