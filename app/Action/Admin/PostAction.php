<?php 

namespace App\Action\Admin;

use App\Action\Action;

final class PostAction extends Action{

	public function index($request, $response){
		$vars['title'] = 'Lista de Contatos';
		$vars['page'] = 'contatos/list';

		$contatos = $this->db->prepare("SELECT id, nome, telefone, email FROM registro ORDER BY id DESC");
		$contatos->execute();

		if ($contatos->rowCount() > 0) {
			$vars['contatos'] = $contatos->fetchAll(\PDO::FETCH_OBJ);
		}

    	return $this->view->render($response, 'admin/template.php', $vars);

	}

	public function view($request, $response){

		$id = $request->getAttribute('id');

		if (! is_numeric($id)) {
			return $response->withRedirect(PATH.'/admin/contatos');	
		}

		$contato = $this->db->prepare("SELECT id, nome, telefone, telefone2, celular, email, cep, endereco,numero, complemento, cidade, uf, pais FROM registro WHERE id = ?");
		$contato->execute(array($id));

		if ($contato->rowCount() == 0) {
			return $response->withRedirect(PATH.'/admin/contatos');	
		}

		$vars['contato'] = $contato->fetch(\PDO::FETCH_OBJ);

		$data = $request->getParsedBody();

		$titulo = filter_var($data['nome'],FILTER_SANITIZE_STRING);

		$vars['title'] = 'Visualizando';
		$vars['page'] = 'contatos/view';

    	return $this->view->render($response, 'admin/template.php', $vars);

	}

	public function add($request, $response){
		$vars['title'] = 'Novo Contato';
		$vars['page'] = 'contatos/add';

    	return $this->view->render($response, 'admin/template.php', $vars);

	}

	public function store($request, $response){
		$data = $request->getParsedBody();

		$removemascara = array("(",")","-"," ");

		$nome = filter_var($data['nome'],FILTER_SANITIZE_STRING);
		$telefone = filter_var(str_replace($removemascara, "", $data['telefone']) ,FILTER_SANITIZE_STRING);
		$telefone2 = filter_var(str_replace($removemascara, "", $data['telefone2']),FILTER_SANITIZE_STRING);
		$celular = filter_var(str_replace($removemascara, "", $data['celular']),FILTER_SANITIZE_STRING);
		$email = filter_var($data['email'],FILTER_VALIDATE_EMAIL);
		$cep = filter_var(str_replace('-','', $data['cep']),FILTER_VALIDATE_INT);
		$endereco = filter_var($data['endereco'],FILTER_SANITIZE_STRING);
		$numero = filter_var($data['numero'],FILTER_VALIDATE_INT);
		$complemento = filter_var($data['complemento'],FILTER_SANITIZE_STRING);
		$cidade = filter_var($data['cidade'],FILTER_SANITIZE_STRING);
		$uf = filter_var($data['uf'],FILTER_SANITIZE_STRING);
		$pais = filter_var($data['pais'],FILTER_SANITIZE_STRING);


		if ($nome != "" && $telefone != "" && $email != "") {

			$cadastrar = $this->db->prepare("INSERT INTO registro SET nome = ?, telefone = ?, telefone2 = ?, celular = ?, email = ?, cep = ?, endereco = ?, numero = ?, complemento = ?, cidade = ?, uf = ?, pais = ?");
			$cadastrar->execute(array($nome, $telefone, $telefone2, $celular, $email, $cep, $endereco, $numero, $complemento, $cidade, $uf, $pais));

			return $response->withRedirect(PATH.'/admin/contatos');
		}

		$vars['title'] = 'Novo Contato';
		$vars['page'] = 'contatos/add';

		$vars['error'] = 'Preencha todos os campos.';

    	return $this->view->render($response, 'admin/template.php', $vars);

	}

	public function edit($request, $response){

		$id = $request->getAttribute('id');

		if (! is_numeric($id)) {
			return $response->withRedirect(PATH.'/admin/contatos');	
		}

		$contato = $this->db->prepare("SELECT id, nome, telefone, telefone2, celular, email, cep, endereco,numero, complemento, cidade, uf, pais FROM registro WHERE id = ?");
		$contato->execute(array($id));

		if ($contato->rowCount() == 0) {
			return $response->withRedirect(PATH.'/admin/contatos');	
		}

		$vars['contato'] = $contato->fetch(\PDO::FETCH_OBJ);

		$vars['title'] = 'Editar Contato';
		$vars['page'] = 'contatos/edit';

    	return $this->view->render($response, 'admin/template.php', $vars);

	}

	public function update($request, $response){

		$id = $request->getAttribute('id');

		if (! is_numeric($id)) {
			return $response->withRedirect(PATH.'/admin/contatos');	
		}

		$contato = $this->db->prepare("SELECT id, nome, telefone, telefone2, celular, email, cep, endereco, numero, complemento, cidade, uf, pais FROM registro WHERE id = ?");
		$contato->execute(array($id));

		if ($contato->rowCount() == 0) {
			return $response->withRedirect(PATH.'/admin/contatos');	
		}

		$data = $request->getParsedBody();

		$removemascara = array("(",")","-"," ");

		$nome = filter_var($data['nome'],FILTER_SANITIZE_STRING);
		$telefone = filter_var(str_replace($removemascara, "", $data['telefone']) ,FILTER_SANITIZE_STRING);
		$telefone2 = filter_var(str_replace($removemascara, "", $data['telefone2']),FILTER_SANITIZE_STRING);
		$celular = filter_var(str_replace($removemascara, "", $data['celular']),FILTER_SANITIZE_STRING);
		$email = filter_var($data['email'],FILTER_VALIDATE_EMAIL);
		$cep = filter_var(str_replace('-','', $data['cep']),FILTER_VALIDATE_INT);
		$endereco = filter_var($data['endereco'],FILTER_SANITIZE_STRING);
		$numero = filter_var($data['numero'],FILTER_VALIDATE_INT);
		$complemento = filter_var($data['complemento'],FILTER_SANITIZE_STRING);
		$cidade = filter_var($data['cidade'],FILTER_SANITIZE_STRING);
		$uf = filter_var($data['uf'],FILTER_SANITIZE_STRING);
		$pais = filter_var($data['pais'],FILTER_SANITIZE_STRING); 

		if ($nome != "" && $telefone != "" && $email != "") {

			$atualizar = $this->db->prepare("UPDATE registro SET nome = ?, telefone = ?, telefone2 = ?, celular = ?, email = ?, cep = ?, endereco = ?, numero = ?, complemento = ?, cidade = ?, uf = ?, pais = ? WHERE id = ? ");
			$atualizar->execute(array($nome, $telefone, $telefone2, $celular, $email, $cep, $endereco, $numero, $complemento, $cidade, $uf, $pais, $id));

			return $response->withRedirect(PATH.'/admin/contatos');
		}

		$vars['contato'] = $contato->fetch(\PDO::FETCH_OBJ);

		$vars['title'] = 'Editar Contato';
		$vars['page'] = 'contatos/edit';

		$vars['error'] = 'Preencha todos os campos.';

    	return $this->view->render($response, 'admin/template.php', $vars);

	}

	public function del($request, $response){

		$id = $request->getAttribute('id');

		if (! is_numeric($id)) {
			return $response->withRedirect(PATH.'/admin/contatos');	
		}

		$contato = $this->db->prepare("SELECT id, nome, telefone, telefone2, celular, email, cep, endereco,numero, complemento, cidade, uf, pais FROM registro WHERE id = ?");
		$contato->execute(array($id));

		if ($contato->rowCount() == 0) {
			return $response->withRedirect(PATH.'/admin/contatos');	
		}

		$deletar = $this->db->prepare("DELETE FROM registro WHERE id = ?");
		$deletar->execute(array($id));
		return $response->withRedirect(PATH.'/admin/contatos');

	}

}

 ?>