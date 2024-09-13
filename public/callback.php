<?php

require '../vendor/autoload.php';

use GoogleLoginSDK\GoogleLogin;

$clientId = '555489147734-dumba37dc53e80unh7n2aoijjvt3tin8.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/google-login-sdk-php/public/callback.php'; // Certifique-se de definir o URI corretamente

$googleLogin = new GoogleLogin($clientId, $clientSecret, $redirectUri);

if ($_GET['action'] === 'getLoginUrl') {
    // Retorna a URL de login para o frontend
    echo json_encode(['authorizeUrl' => $googleLogin->getLoginUrl()]);
    exit;
}

if (isset($_GET['code'])) {
    try {
        // Obter as informações do usuário após o login
        $userInfo = $googleLogin->getUserInfo($_GET['code']);
        echo '<pre>';
        print_r($userInfo);
        echo '</pre>';
    } catch (Exception $e) {
        echo 'Erro ao autenticar: ' . $e->getMessage();
    }
} else {
    echo 'Código de autorização não fornecido.';
}
