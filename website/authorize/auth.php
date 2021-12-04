<link rel="stylesheet" href="/authorize/authorize.css">
<body class="bodyb">
<?php
require_once 'db.php';

$login = trim($_POST['login']);
$pwd = trim($_POST['pwd']);

if( !empty($login) && !empty($pwd) ) {
    
    $sql = 'SELECT login, password FROM users WHERE login = :login';
    $params = [':login' => $login];
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    
    if($user) {
        
        if( password_verify($pwd, $user->password) ) {
            $_SESSION['user_login'] = $user->login;
            header('Location: ../index.html');
        } else {
            echo 'Неправильний логін або пароль';
        }
        
    } else {
        echo 'Неправильний логін або пароль';
    }
    
} else {
    echo 'Будь ласка, заповніть усі поля';
} 
?>
<br>
</body>
<br>
<a href="login.php" class="button_log">Назад</a>