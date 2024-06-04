<!DOCTYPE html>
<html>
<head>
    <title>Reply to your comment</title>
</head>
<body>
    <p>Hello {{ $contact->name }},</p>
    <p>cmt của bạn :{{ $contact->message }},</p>
    <p>Thank you for your comment. Here is our reply:</p>
    <p>{{ $replyMessage }}</p>
    <p>Best regards,<br/>Your Company</p>
</body>
</html>