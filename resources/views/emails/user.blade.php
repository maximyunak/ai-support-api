<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thanks for your message</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px;">

<div style="
    max-width:600px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:10px;
">

    <h1>
        Спасибо за обращение, {{ $messageData['name'] }}!
    </h1>


    <p>
        Мы получили ваше сообщение и скоро свяжемся с вами.
    </p>


    <h3>
        Ваше сообщение:
    </h3>

    <div style="
    background:#f3f3f3;
    padding:15px;
    border-radius:8px;
">
        {{ $messageData['comment'] }}
    </div>


    <h3>
        Предварительный ответ:
    </h3>

    <div style="
    background:#eef6ff;
    padding:15px;
    border-radius:8px;
">
        {{ $messageData['ai_reply'] }}
    </div>


    <p style="margin-top:30px;">
        С уважением,<br>
        Команда {{ config('app.name') }}
    </p>


</div>

</body>
</html>
