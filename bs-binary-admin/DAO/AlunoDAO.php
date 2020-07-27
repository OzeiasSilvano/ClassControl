<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class AlunoDAO extends Conexao {
    
    public function CadastrarAluno($nome, $sobrenome, $telefone, $email) {
        if (trim($nome) == '' || trim($sobrenome) == '' || trim($telefone) == '' || trim($email) == '') {
            return 0;
        }
        
        $conexao = parent::retornaConexao();

        $comando = 'insert into tb_aluno (nome_aluno, sobrenome_aluno, telefone_aluno, email_aluno, id_usuario)
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
            echo $ex->getMessage();
        }
    }
    
    public function AlterarAluno($nome, $sobrenome, $telefone, $email, $id) {
        if (trim($nome) == '' || trim($sobrenome) == '' || trim($telefone) == '' || trim($email) == '') {
            return 0;
        }
        
        $conexao = parent::retornaConexao();
        
        $comando = 'update tb_aluno
                      set nome_aluno = ?,
                          sobrenome_aluno = ?,
                          telefone_aluno = ?,
                          email_aluno = ?
                    where id_aluno = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $sobrenome);
        $sql->bindValue(3, $telefone);
        $sql->bindValue(4, $email);
        $sql->bindValue(5, $id);
        
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            throw $ex;
            //return -1;
        }
    }
    
    public function ConsultarAluno() {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'SELECT tb_aluno.id_aluno AS id_aluno,
                           nome_aluno,
                           sobrenome_aluno,
                           telefone_aluno,
                           email_aluno,
                           GROUP_CONCAT(nome_grupo ORDER BY nome_grupo SEPARATOR \'<br>\') AS nome_grupo
                        from tb_aluno
                        LEFT JOIN tb_grupoaluno ON
                            tb_grupoaluno.id_aluno = tb_aluno.id_aluno
                        LEFT JOIN tb_grupo ON
                            tb_grupo.id_grupo = tb_grupoaluno.id_grupo
                        WHERE tb_aluno.id_usuario = ?
                        GROUP BY tb_aluno.id_aluno
                        ORDER BY nome_aluno, sobrenome_aluno
                        ';
        
//        $comando = 'SELECT tb_aluno.id_aluno AS id_aluno,
//                           nome_aluno,
//                           sobrenome_aluno,
//                           telefone_aluno,
//                           email_aluno,
//                           nome_grupo
//                           from tb_grupoaluno
//                 left join tb_grupo
//                        on tb_grupo.id_grupo = tb_grupoaluno.id_grupo
//                 right join tb_aluno
//                        on tb_aluno.id_aluno = tb_grupoaluno.id_aluno
//                    WHERE tb_aluno.id_usuario = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, UtilDao::CodigoLogado());
        
        $sql->execute();
        
        return $sql->fetchAll();
        
    }
    
    public function ConsultarAlunoParaVincularGrupo($id) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'SELECT tb_aluno.id_aluno AS id_aluno,
                           nome_aluno,
                           sobrenome_aluno,
                           telefone_aluno,
                           email_aluno
                    FROM  tb_aluno
                    WHERE tb_aluno.id_usuario = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, UtilDao::CodigoLogado());
        
        $sql->execute();
        
        return $sql->fetchAll();
        
    }
    
    
    public function ExcluirAluno($id) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'delete from tb_aluno
                        where id_aluno = ? and id_usuario = ?';
        
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
    
    public function DetalharAluno($id) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'select id_aluno,
                           nome_aluno,
                           sobrenome_aluno,
                           telefone_aluno,
                           email_aluno
                      from tb_aluno
                    where id_aluno = ? and tb_aluno.id_usuario = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $id);
        $sql->bindValue(2, UtilDao::CodigoLogado());
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();
        
        return $sql->fetchAll();
        
    }
    
}
