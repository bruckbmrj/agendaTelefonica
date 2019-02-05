<?php 
session_start();
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

require 'vendor/autoload.php';
require_once 'config/constants.php';
require_once 'config/config.php';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer('resources/views/');

$container['db'] = function ($c) {
    $db = $c['settings']['db'];

    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname']."; charset=utf8",
        $db['user'], $db['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", 'SET character_set_connection=utf8', 'SET character_set_client=utf8', 'SET character_set_results=utf8'));

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    return $pdo;
};

require_once 'app/routes.php';

/*
$app->get('/', function ($request, $response) {

    $vars['page'] = 'home';

    $response = $this->view->render($response, 'template.php', $vars);

    return $response;
});

$app->get('/ola[/{nome}]', function ($request, $response) {

	$nome = ($request->getAttribute('nome') == true) ? $request->getAttribute('nome') : 'visitante';

	if ($nome == true) {
		$vars['nome'] = $nome;
	} else {
		$vars['visitante'] = $nome;	
	}


    $response = $this->view->render($response, 'ola.html', $vars);

    return $response;
});

$app->get('/sobre', function ($request, $response) {

    $vars['page'] = 'sobre';

    $response = $this->view->render($response, 'template.php', $vars);

    return $response;
});

$app->get('/contato', function ($request, $response) {

    $vars['page'] = 'contato';

    $response = $this->view->render($response, 'template.php', $vars);

    return $response;
}); */

$app->run();

 ?>