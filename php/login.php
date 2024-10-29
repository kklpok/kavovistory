
    <?php
    @session_start();
    $auth = false;
    $error_message = '';

    if (isset($_GET['logout'])) {
        unset($_SESSION['user']);
        unset($_SESSION['name']);
        @session_destroy();
        echo "Ви вийшли з системи. <a href=\"login.php\">Натисніть</a>, щоб увійти знову.";
        exit(); 
    }

   
        $lgn = trim($_POST['login']);
        $pss = trim($_POST['password']);
        if (empty($lgn) || empty($pss)) {

        } else {
            $db = mysql_connect ("localhost", "root", "");
            mysql_select_db("eeee");
            mysql_query ("set names 'utf8'");
            $res = mysql_query("SELECT COUNT(*) AS 'cnt', `Name` FROM `user` WHERE (`login`='".$lgn."') AND (`password`='".$pss."');");
            
            if ($row = mysql_fetch_array($res)){
                $cnt = $row['cnt'];
                $nam = $row['name'];
                
                if ($cnt == 1) {
                    $auth = true;
                    $_SESSION['user'] = $lgn;
                    $_SESSION['Name'] = $nam;
                    $_SESSION['password'] = $pss;
                    
                    echo "<h2>Доброго дня, " . $nam . ".<br/>Ви успішно увійшли до системи.</h2>";
                    echo "<p>" . $nam . ", Ви можете:</p>";
                    echo "<a href=\"products.php\"><button>Перейти до перегляду каталогу продукції</button></a>";

                    if ($lgn == "admin") {
                        echo "<a href=\"../products_add.html\"><button>Додати товар до каталогу продукції</button></a>
                              <a href=\"../products_edit.html\"><button>Редагувати товар в каталозі продукції</button></a>
                              <a href=\"../products_del.html\"><button>Видалити товар в каталозі продукції</button></a>
                              <a href=\"products_ord.php\"><button>Переглянути замовлений товар</button></a>";
                    } else {
                        echo "<a href=\"products_order.php\"><button>Замовити товар</button></a>";
                    }

                    echo "<a href=\"?logout=true\"><button>Вихід</button></a>";
                } else {
                    $error_message = "Неправильний логін або пароль!";
                }
            }
            mysql_close($db);
        }
    
    ?>

    <?php if (!$auth):?>
        <h2>Авторизуватися</h2>
        <?php if (!empty($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="post">
            <label for="login">Логін:</label>
            <input type="text" id="login" name="login">

            <label for="password">Пароль:</label>
            <input type="text" id="password" name="password">

            <input type="submit" value="Авторизація">
        </form>
        <a href="R_U.html"><button>Зареєструватися</button></a>
    <?php endif; ?> 
    </div>
</body>
</html>
