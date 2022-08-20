<html>

<?php
    session_start();
    $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(32));
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <link href="style.css?v=4" rel="stylesheet">
    <script src="script.js?v=4" defer></script>
</head>

<body>
    <div class="center">
        <div class="content">
            <h1>獲取CUSIS時間表</h1>
            <p style="font-size: 0.4rem; margin-bottom: 5px;">ITSC見到可以Dup呢個web去server～😥<br>個Timetable
                APP有小小難用所以先寫個Web</p>
            <div class="Notes" style="margin: 10px 10% 20px 10%"
                onclick="window.location.href = 'https://github.com/AnsonCheng03/CUHK_Timetable_fetch'"">
                本網站並<b>不會</b>儲存任何資料。<br>按此查看Source Code~
            </div>
            <form action=" api.php" method="POST">
                <input placeholder="SID" name="SID" onkeypress="return isNumberKey(event)" type="number"
                    min="1000000000" max="1500000000" required></input><br>
                <input placeholder="密碼" name="pwd" type="password" required></input><br>
                <input style="display: none" name="_token" type="text" value="<?php echo $_SESSION['_token']?>"></input><br>
                <button type="submit" name="requestmode">下載時間表</button>
                </form>
                <div class="Notes" onclick="window.location.href = '/'">
                    [網站推薦] 唔識搭校巴？撳呢度查路線！
                </div>
                <script>
                    if(!/^((?!chrome|android).)*safari/i.test(navigator.userAgent)) 
                        document.write("<div class=\"Notes\" style=\"margin-top:10px\" onclick=\"window.location.href = 'https://support.google.com/calendar/answer/37118?hl=zh-Hant&co=GENIE.Platform%3DDesktop'\">Android／電腦Add落Google Calendar方法</div>");
                </script>
                <svg onclick="window.location.href = 'https://github.com/AnsonCheng03/CUHK_Timetable_fetch'"
                    xmlns="http://www.w3.org/2000/svg" width="5%" style="margin-top: 20px; cursor: pointer;"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                </svg>
            </div>
        </div>
        <script>
            if (navigator.userAgent.toLowerCase().indexOf("instagram") != -1)
                document.write("<div class=\"warning\" target=\"_blank\" href=\"https://cu-bus.000webhostapp.com/cusis/\"><p>IG唔知點解Add唔到Calendar<br>請點擊右上角，選擇在瀏覽器開啟！</p></div>");
            else if (!window.location.href.includes('cusis'))
                window.location.replace("https://cu-bus.000webhostapp.com/cusis/");
        </script>
</body>

</html>