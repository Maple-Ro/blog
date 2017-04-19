<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register</title>
</head>
<body>
<div style="width: 1200px;margin: 30px auto">
    <form action="/i/register" method="post">
        {{csrf_field()}}
        <p><label><input name="name" type="text"></label></p>
        <p><label><input name="pwd" type="password"></label></p>
        <p><label><input name="submit" type="submit"></label></p>
    </form>
</div>
</body>
</html>