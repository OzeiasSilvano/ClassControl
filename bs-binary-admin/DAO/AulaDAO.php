<?php
require_once 'UtilDAO.php';
require_once 'Conexao.php';
require_once 'RelacionamentoDAO.php';

class AulaDAO extends Conexao {
    
    public function CriarAula($situacao, $data, $hrini, $hrfin, $presentes, $obs, $idgrupo) {
        
        
        $conexao = parent::retornaConexao();
        
        $comando = 'insert into tb_aula (situacao, data, hora_inicio, hora_fim, obs, id_grupo, id_usuario) values (?, ?, ?, ?, ?, ?, ?)';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $i = 0;
        
        $sql->bindValue(++$i, $situacao);
        $sql->bindValue(++$i, $data);
        $sql->bindValue(++$i, $data . ' ' . $hrini);
        $sql->bindValue(++$i, $data . ' ' . $hrfin);
        $sql->bindValue(++$i, $obs);
        $sql->bindValue(++$i, $idgrupo);
        $sql->bindValue(++$i, UtilDao::CodigoLogado());
        
        try {
            $sql->execute();
            
            if ($situacao == 0) {
                return 1;
            }
            
            $id_aula = $conexao->lastInsertId();
            
            $objdao_alunos = new RelacionamentoDAO();
            $alunos = $objdao_alunos->ConsultarRelacionamento($idgrupo);
            
            foreach ($alunos as $aluno) {                
                $presente = in_array($aluno['id_aluno'], $presentes) ? 1 : 0;
                
                $comando = 'insert into tb_chamada (id_aula, id_aluno, presente) values (?, ?, ?)';
                
                $sql = new PDOStatement();
        
                $sql = $conexao->prepare($comando);

                $i = 0;

                $sql->bindValue(++$i, $id_aula);
                $sql->bindValue(++$i, $aluno['id_aluno']);
                $sql->bindValue(++$i, $presente);
                
                $sql->execute();
            }
            
            return 1;
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }
    
    public function ConsultarAulas($idgrupo) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'select tb_aula.id_aula,
                           tb_aula.situacao,
                           date_format(tb_aula.data, "%d/%m/%y") as data,
                           date_format(tb_aula.hora_inicio, "%H:%i") as hora_inicio,
                           date_format(tb_aula.hora_fim, "%H:%i") as hora_fim,
                           tb_aula.id_grupo,
                           tb_aula.obs,
                           GROUP_CONCAT(
								CONCAT(tb_aluno_presente.nome_aluno, " ", tb_aluno_presente.sobrenome_aluno)
								ORDER BY CONCAT(tb_aluno_presente.nome_aluno, tb_aluno_presente.sobrenome_aluno)
								SEPARATOR \', \'
							) AS alunos_presentes,
                            GROUP_CONCAT(
								CONCAT(tb_aluno_ausente.nome_aluno, " ", tb_aluno_ausente.sobrenome_aluno)
								ORDER BY CONCAT(tb_aluno_ausente.nome_aluno, tb_aluno_ausente.sobrenome_aluno)
								SEPARATOR \', \'
							) AS alunos_ausentes
                      from tb_aula
                inner join tb_grupo
                        on tb_grupo.id_grupo = tb_aula.id_grupo
                        
                        LEFT JOIN tb_chamada AS tb_chamada_presente ON
							tb_chamada_presente.id_aula = tb_aula.id_aula
                            AND tb_chamada_presente.presente = 1
						LEFT JOIN tb_aluno as tb_aluno_presente ON
							tb_aluno_presente.id_aluno = tb_chamada_presente.id_aluno
                            
                        
                        LEFT JOIN tb_chamada AS tb_chamada_ausente ON
							tb_chamada_ausente.id_aula = tb_aula.id_aula
                            AND tb_chamada_ausente.presente = 0
						LEFT JOIN tb_aluno as tb_aluno_ausente ON
							tb_aluno_ausente.id_aluno = tb_chamada_ausente.id_aluno
                           
                     where tb_aula.id_grupo = ?
                      GROUP BY tb_aula.id_aula';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $idgrupo);
        
        $sql->execute();
        
        return $sql->fetchAll();
                
        
    }
    
    public function ExcluirAula($idaula) {
        
        $conexao = parent::retornaConexao();
        
        $comando = 'delete from tb_aula where id_aula = ?';
        
        $sql = new PDOStatement();
        
        $sql = $conexao->prepare($comando);
        
        $sql->bindValue(1, $idaula);
        
        try {
            $sql->execute();
            return 4;
        } catch (Exception $ex) {
            return -2;
        }
        
    }
    
}
