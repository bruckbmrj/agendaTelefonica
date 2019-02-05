<?php 

namespace App\Action\Admin;

use App\Action\Action;

final class LoginAction extends Action{

	public function index($request, $response){

		if (isset($_SESSION[PREFIX . 'logado'])){
			return $response->withRedirect(PATH . '/admin');
		}

		/*$vars['page'] = 'admin/home';*/

    	return $this->view->render($response, 'admin/login/login.php'/*, $vars*/);

	}

	public function logar($request, $response)
	{	
		$data = $request->getParsedBody();

		$email = strip_tags(filter_var($data['email'], FILTER_SANITIZE_STRING));
		$senha = strip_tags(filter_var($data['senha'], FILTER_SANITIZE_STRING));

		if($email !='' && $senha !=''){

			$verificarNoBanco = $this->db->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ? "); 
			$verificarNoBanco->execute(array($email, $senha));

			if ($verificarNoBanco->rowCount() > 0) {
				$_SESSION[PREFIX.'logado'] = true;

				return $response->withRedirect(PATH.'/admin');
			}else{
				$vars['erro'] = 'Você não foi encontrado no sistema.';
				return $this->view->render($response, 'admin/login/login.php', $vars);
			}

		} else{
			$vars['erro'] = 'Preencha todos os campos.';
			return $this->view->render($response, 'admin/login/login.php', $vars);
		}
	}

	public function logout($request, $response){

		unset($_SESSION[PREFIX.'logado']);
		session_destroy();

		return $response->withRedirect(PATH.'/admin/login');
	}

}

?>