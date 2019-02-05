<?php 

// Administração
$app->get('/admin/login', 'App\Action\Admin\LoginAction:index');
$app->post('/admin/login', 'App\Action\Admin\LoginAction:logar');
$app->get('/admin/logout', 'App\Action\Admin\LoginAction:logout');

$app->group('/admin', function(){

	//auth da home
	$this->get('', 'App\Action\Admin\HomeAction:index');

	//auth dos posts
	$this->get('/contatos', 'App\Action\Admin\PostAction:index');
	$this->get('/contatos/add', 'App\Action\Admin\PostAction:add');
	$this->post('/contatos/add', 'App\Action\Admin\PostAction:store');
	$this->get('/contatos/{id}/edit', 'App\Action\Admin\PostAction:edit');
	$this->post('/contatos/{id}/edit', 'App\Action\Admin\PostAction:update');
	$this->get('/contatos/{id}/del', 'App\Action\Admin\PostAction:del');
	$this->get('/contatos/{id}/view', 'App\Action\Admin\PostAction:view');

})->add(App\Middleware\Admin\AuthMiddleware::class);;



/* SITE */
$app->redirect('/', '/admin');
$app->get('/sobre', 'App\Action\HomeAction:sobre');
$app->get('/contato', 'App\Action\HomeAction:contato');
?>