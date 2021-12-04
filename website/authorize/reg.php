<link rel="stylesheet" href="/authorize/authorize.css">
<body class="bodyb">

<?php
require_once 'db.php';

$login = trim( $_POST['login'] );
$pwd = trim( $_POST['pwd'] );
if( !empty($login) && !empty($pwd) ) {
    
    //Перевірка існування облікового запису користувача
    $sql_check = 'SELECT EXISTS( SELECT login FROM users WHERE login = :login )';
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute( [':login' => $login] );
    
    if( $stmt_check->fetchColumn() ) {
        die('Вже є такий користувач');
    }
    
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    $sql = 'INSERT INTO users(login, password) VALUES(:login,
    :pwd)';
    $params = [ 'login' => $login, ':pwd' => $pwd ];
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    
    echo 'Ви успішно зареєструвалися!';
    
} else {
    echo 'Будь ласка, заповніть усі поля';
}

"/n"
?>
<br>
<br>
<a href="login.php" class="button_log">Назад</a>

</body>