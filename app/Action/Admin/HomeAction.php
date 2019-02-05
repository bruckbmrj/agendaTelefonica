<?php 

namespace App\Action\Admin;

use App\Action\Action;

final class HomeAction extends Action{

	public function index($request, $response){

		$vars['page'] = 'home';

    	return $this->view->render($response, 'admin/template.php', $vars);

	}

}

 ?>