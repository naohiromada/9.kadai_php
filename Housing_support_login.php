<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>居住支援　福祉施設マスターF　登録　ログイン画面</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <form action="Housing_support_login_act.php" method="POST">
        <fieldset class="login_line">
            <legend>居住支援　福祉施設マスターF　登録　ログイン画面</legend>
            <p class="login_line">
                <label>ユーザーID<br>
                    <input type="text" name="username"></label>
            </p>
            <p class="login_line">
                <label>パスワード<br>
                    <input type="password" name="password"></label>
            </p>
            <div>
                <button>ログイン</button>
            </div>
            <a href="Housing_support_register.php"></a>
        </fieldset>
    </form>

</body>

</html>