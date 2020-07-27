<?php
require_once 'Conexao.php';
require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao {

    public function CadastrarUsuario($nome, $email, $senha, $rsenha) {
        if (trim($nome) == '' || trim($email) == '' || trim($senha) == '') {
            return 0;
        } else if (strlen(trim($senha)) < 6) {
            return 2;
        } else if ($senha !== $rsenha) {
            return 3;
        }
        
        $conexao = parent::retornaConexao();
        
        $comando = 'insert into tb_usuario (nome_usuario, email_usuario, senha_usuario) values (?,?,?)';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);
        
        try {
            $sql->execute();
            
            return 1;
            
        } catch (Exception $ex) {
            return -1;
        }
    }
    
    public function LogarUsuario($email, $senha) {
        if (trim($email) == '' || trim($senha) == '') {
            return 0;
        }
        
        $conexao = parent::retornaConexao();
        
        $comando = 'select id_usuario from tb_usuario where email_usuario = ? and senha_usuario = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();
        
        $user = $sql->fetchAll();
        
        if (count($user) == 0) {
            return -3;
        } else {
            $id_user = $user[0]['id_usuario'];
            UtilDao::CriarSessao($id_user);
            header('location: consultar_grupo.php');
        }
    }

}
