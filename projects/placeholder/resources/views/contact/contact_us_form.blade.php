<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us Form</title>
</head>
<body>
    <form method="post">
        @csrf
        <input type="text" name="data[first_name]" placeholder="John" /> <br/>
        <input type="text" name="data[last_name]" placeholder="Doe" /><br/>
        <input type="email" name="email" placeholder="doe@example.com" /><br/>
        <input type="hidden" name="type" value="general" /><br/>
        <textarea name="data[message]" placeholder="message"></textarea><br/>
        <input type="submit" value="Submit" />
    </form>
</body>
</html>
