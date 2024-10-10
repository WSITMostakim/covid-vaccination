<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Schedule Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        .status {
            font-weight: bold;
            margin: 20px 0;
        }

        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Vaccination Schedule Notification</h2>
        <p>Dear User,</p>
        <p>We would like to inform you about your vaccination schedule:</p>
        <div class="status">
            Scheduled Date: {{ $record->scheduled_date }} <br>
            Vaccination Center: {{ $record->center->name }}
        </div>
        <p>If you have any questions, feel free to reach out to our support team.</p>
        <p>Best Regards,<br>Your Vaccination Team</p>
        <div class="footer">
            <p>This email was generated automatically, please do not reply.</p>
        </div>
    </div>
</body>

</html>
