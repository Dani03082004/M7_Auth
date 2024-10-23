<?php

$routes=[
    'home',
    'login',
    'auth',
    'dashboard',
    'error'
];

function dd(){
    foreach (func_get_args() as $arg){
        echo "<pre>";
        var_dump($arg);
        "</pre>";
    }
    die;
}

function sendMail(
    string $fileAttachment,
    string $mailMessage = MAIL_CONF["mailMessage"],
    string $subject     = MAIL_CONF["subject"],
    string $toAddress   = MAIL_CONF["toAddress"],
    string $fromMail    = MAIL_CONF["fromMail"]
): bool {
    $fileAttachment = trim($fileAttachment);
    $from           = $fromMail;
    $pathInfo       = pathinfo($fileAttachment);
    $attchmentName  = "attachment_".date("YmdHms").(
    (isset($pathInfo['extension']))? ".".$pathInfo['extension'] : ""
    );
    $attachment    = chunk_split(base64_encode(file_get_contents($fileAttachment)));
    $boundary      = "PHP-mixed-".md5(time());
    $boundWithPre  = "\n--".$boundary;
    $headers   = "From: $from";
    $headers  .= "\nReply-To: $from";
    $headers  .= "\nContent-Type: multipart/mixed; boundary=\"".$boundary."\"";
    $message   = $boundWithPre;
    $message  .= "\n Content-Type: text/plain; charset=UTF-8\n";
    $message  .= "\n $mailMessage";
    $message .= $boundWithPre;
    $message .= "\nContent-Type: application/octet-stream; name=\"".$attchmentName."\"";
    $message .= "\nContent-Transfer-Encoding: base64\n";
    $message .= "\nContent-Disposition: attachment\n";
    $message .= $attachment;
    $message .= $boundWithPre."--";
    return mail($toAddress, $subject, $message, $headers);
}

function router(array $routes,string $default_router=null):string 
{
    $url=parse_url($_SERVER['REQUEST_URI'])['path'];
    $path=explode('/',$url);
    $uri=array_filter($path,function($item){
        return $item!=='';
    });
    $uri=array_values($uri);
    if(empty($uri[0])){
        $uri[0]=$default_router??'home';
    }
    if(in_array($uri[0],$routes,true)){
        return $uri[0];
    }
    set_error("Ruta no encontrada");

}

function set_error(string $message){
    $_SESSION['error']=$message;
    http_redirect('error',404);
}

function http_redirect(string $location, int $status_code){
    header('Location: '.$location);
}

function view(string $view,array $data=null){
    if (is_array($data)){
        extract($data,EXTR_OVERWRITE);
    }
    ob_start();
    require VIEWS.$view.'.view.php';
    $rendered=ob_get_clean();
    return $rendered;
}



//echo view('login',['title'=>'Login']);