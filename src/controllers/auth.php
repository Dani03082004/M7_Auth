<?php
    $logins=[
        [
        'email'=>'test@test.com',
        'password'=>'1234'
        ],
        [
        'email'=>'jamoncitorico@gmail.com',
        'password'=>'patanegra'
        ],
    ];
    // recoger datos
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $email=filter_input(INPUT_POST,'email');
        $password=filter_input(INPUT_POST,'password');
        // crear conexion
        $sql="SELECT * FROM users WHERE email=? LIMIT 1";
        $stmt=$pdo->prepare($sql);
        if($stmt->execute([':email'=>$email])){
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $user=$result[0];
            // verificar password
            $user['password'];
        }
    }else {
        http_redirect('login',302);
    }

    // validar

    // determinar si dashboard o repetimos en login