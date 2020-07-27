<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ProfessorDAO extends Conexao {

    public function CadastrarProfessor($nome, $sobrenome, $telefone, $email) {
        if (trim($nome) == '' || trim($sobrenome) == '' || trim($telefone) == '' || trim($email) == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();

        $comando = 'insert into tb_professor (nome_professor, sobrenome_professor, telefone_professor, email_professor, id_usuario)
                                values (?, ?, ?, ?, ?)';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $sobrenome);
        $sql->bindValue(3, $telefone);
        $sql->bindValue(4, $email);
        $sql->bindValue(5, UtilDao::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }


    public function AlterarProfessor($nome, $sobrenome, $telefone, $email, $id) {
        if (trim($nome) == '' || trim($sobrenome) == '' || trim($telefone) == '' || trim($email) == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        
        $comando = 'update tb_professor
                       set nome_professor = ?,
                           sobrenome_professor = ?,
                           telefone_professor = ?,
                           email_professor = ?
                    where id_professor = ? and id_usuario = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $sobrenome);
        $sql->bindValue(3, $telefone);
        $sql->bindValue(4, $email);
        $sql->bindValue(5, $id);
        $sql->bindValue(6, UtilDao::CodigoLogado());
        
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
//            throw $ex;
        }
    }

    public function ConsultarProfessor() {

        $conexao = parent::retornaConexao();

        $comando = 'SELECT tb_professor.id_professor,
                           nome_professor,
                           sobrenome_professor,
                           telefone_professor,
                           email_professor,
                           COUNT(id_grupo) AS grupos
                           FROM tb_professor
                 left JOIN tb_grupo
                        ON tb_professor.id_professor = tb_grupo.id_professor
                  group by tb_professor.id_professor';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
    
    public function ConsultarProfessorParaSelect() {

        $conexao = parent::retornaConexao();

        $comando = 'SELECT id_professor,
                           nome_professor,
                           sobrenome_professor
                           FROM tb_professor';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function ExcluirProfessor($id) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'delete from tb_professor
                        where id_professor = ? and id_usuario = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $id);
        $sql->bindValue(2, UtilDao::CodigoLogado());
        
        try {
            $sql->execute();
            return 4;
        } catch (Exception $ex) {
            return -2;
        }

    }

    public function DetalharProfessor($id) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'select id_professor,
                           nome_professor,
                           sobrenome_professor,
                           telefone_professor,
                           email_professor
                      from tb_professor
                    where id_professor = ? and id_usuario = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $id);
        $sql->bindValue(2, UtilDao::CodigoLogado());
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();
        
        return $sql->fetchAll();

    }

}
