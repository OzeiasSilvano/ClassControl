<?php
require_once 'Conexao.php';
require_once 'UtilDAO.php';

class GrupoDAO extends Conexao {
    
    public function CadastrarGrupo($nome, $local, $professor, $endereco = null) {
        if (trim($nome) == '' || trim($local) == '' || trim($professor) == '') {
            return 0;
        }
        
        $conexao = parent::retornaConexao();
        
        $comando = 'insert into tb_grupo
                               (nome_grupo,
                                local,
                                endereco,
                                id_professor,
                                status,
                                id_usuario)
                    values (?, ?, ?, ?, ?, ?)';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $local);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, $professor);
        $sql->bindValue(5, 1);
        $sql->bindValue(6, UtilDao::CodigoLogado());
        
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
                
    }
    
    public function AlterarGrupo($nome, $local, $professor, $status, $id) {
        if (trim($nome) == '' || trim($local) == '' || trim($professor) == '') {
            return 0;
        }
        
        $conexao = parent::retornaConexao();
        
        $comando = 'update tb_grupo
                       set nome_grupo = ?,
                           local = ?,
                           id_professor = ?,
                           status = ?
                    where id_grupo = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $local);
        $sql->bindValue(3, $professor);
        $sql->bindValue(4, $status);
        $sql->bindValue(5, $id);
        
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
//            return -1;
            throw $ex;
        }
        
    }
    
    public function ConsultarGrupo() {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'select nome_grupo,
                           local,
                           nome_professor,
                           id_grupo,
                           status,
                           tb_grupo.id_professor
                      from tb_grupo
                    inner join tb_professor
                        on tb_professor.id_professor = tb_grupo.id_professor
                    where tb_grupo.id_usuario = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, UtilDao::CodigoLogado());
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();
        
        return $sql->fetchAll();
                
        
    }
    
    public function ExibirGrupo($id) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'select nome_grupo,
                           local,
                           nome_professor,
                           sobrenome_professor,
                           id_grupo,
                           status
                      from tb_grupo
                    inner join tb_professor
                        on tb_professor.id_professor = tb_grupo.id_professor
                    where id_grupo = ? LIMIT 1';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $id);
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();
        
        return $sql->fetch();
    }
    
    public function ExcluirGrupo($id) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'delete from tb_grupo
                          where id_grupo = ? and id_usuario = ?';
        
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
    
    public function DetalharGrupo($id) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'select id_grupo,
                           nome_grupo,
                           local,
                           nome_professor,
                           status
                      from tb_grupo
                    inner join tb_professor
                        on tb_professor.id_professor = tb_grupo.id_professor
                    where id_grupo = ? and tb_grupo.id_usuario = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $id);
        $sql->bindValue(2, UtilDao::CodigoLogado());
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $sql->execute();
        
        return $sql->fetchAll();
        
    }
    
    protected static $locals = [
        1 => 'Escola',
        2 => 'Skype',
        3 => 'Hangouts',
        4 => 'Casa do Aluno',
        5 => 'Novo local',
    ];
    
    public static function getLocalName($id)
    {
        return isset(static::$locals[$id]) ? static::$locals[$id] : 'Desconhecido';
    }
    
    public static function getLocals()
    {
        return static::$locals;
    }
    
    public static function getStatusName($id)
    {
        switch ($id) {
            case 1:
                return 'Ativo';
            case 0:
                return 'Inativo';
            default:
                return 'Desconhecido';
        }
    }
}
