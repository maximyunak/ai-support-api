<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New contact request</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px;">

<div style="
    max-width: 600px;
    margin: 0 auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
">

    <h1 style="color: #333;">
        Новое обращение с сайта
    </h1>

    <hr>

    <h3>Контактные данные</h3>

    <p>
        <strong>Имя:</strong>
        {{ $messageData['name'] }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $messageData['email'] }}
    </p>

    <p>
        <strong>Телефон:</strong>
        {{ $messageData['phone'] }}
    </p>


    <h3>Комментарий</h3>

    <div style="
        background: #f3f3f3;
        padding: 15px;
        border-radius: 8px;
    ">
        {{ $messageData['comment'] }}
    </div>


    <h3>AI анализ</h3>

    <p>
        <strong>Тональность:</strong>
        {{ $messageData['sentiment'] }}
    </p>

    <p>
        <strong>Категория:</strong>
        {{ $messageData['category'] }}
    </p>


    <h3>Ответ AI</h3>

    <div style="
        background: #eef6ff;
        padding: 15px;
        border-radius: 8px;
    ">
        {{ $messageData['ai_reply'] }}
    </div>


    <hr>

    <p style="color: #777; font-size: 12px;">
        Это автоматическое уведомление.
    </p>

</div>

</body>
</html>
