<?php
require_once 'UtilDAO.php';
require_once 'Conexao.php';

class RelacionamentoDAO extends Conexao {
    public function CriarRelacionamento($aluno, $grupo, $mensalidade) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'insert into tb_grupoaluno (id_aluno, id_grupo, mensalidade) values (?,?,?)';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $aluno);
        $sql->bindValue(2, $grupo);
        $sql->bindValue(3, $mensalidade);
        
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
//            throw $ex;
            return -1;
        }
        
    }
    
    public function ConsultarGrupoDoAluno() {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'select tb_aluno.id_aluno as id_aluno,
                           nome_grupo,
                           tb_grupoaluno.id_grupo
                      from tb_grupoaluno
                    inner join tb_aluno
                        on tb_aluno.id_aluno = tb_grupoaluno.id_aluno
                    inner join tb_grupo
                        on tb_grupo.id_grupo = tb_grupoaluno.id_grupo';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();
        
        return $sql->fetchAll();
        
    }
    
    public function ConsultarRelacionamento($id) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'select id_grupoaluno,
                           tb_aluno.id_aluno as id_aluno,
                           nome_aluno,
                           sobrenome_aluno,
                           mensalidade,
                           tb_grupoaluno.id_grupo
                      from tb_grupoaluno
                    inner join tb_aluno
                        on tb_aluno.id_aluno = tb_grupoaluno.id_aluno
                    where tb_grupoaluno.id_grupo = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $id);
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();
        
        return $sql->fetchAll();
        
    }
    
    public function EncerrarRelacionamento($id) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'delete from tb_grupoaluno
                where id_grupoaluno = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $id);
        
        try {
            $sql->execute();
            return 4;
        } catch (Exception $ex) {
            return -2;
//            throw $ex;
        }
        
    }
    
    
    
}
