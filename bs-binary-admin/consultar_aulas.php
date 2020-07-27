<?php
require_once './DAO/AulaDAO.php';
require_once './DAO/GrupoDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();


if (isset($_GET['id_grupo']) && is_numeric($_GET['id_grupo'])) {
    if (isset($_GET['id_aula']) && is_numeric($_GET['id_aula'])) {
        $id_grupo = $_GET['id_grupo'];
        $idaula = $_GET['id_aula'];
        
        $objdao_exc = new AulaDAO();
        $ret = $objdao_exc->ExcluirAula($idaula);
        
    }
    $idgrupo = $_GET['id_grupo'];
    
    $obj_nomegrupo = new GrupoDAO();
    $grupo = $obj_nomegrupo->ExibirGrupo($idgrupo);
    
    $obj_aulas = new AulaDAO();
    $aulas = $obj_aulas->ConsultarAulas($idgrupo);
    
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
    include_once '_head.php';
    ?>
    <body>
        <div id="wrapper">
            <?php
            include_once '_topo.php';
            include_once '_menu.php';
            ?>
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            if (isset($ret)) {
                                ExibirMsg($ret);
                            }
                            ?>
                            <h2>Histórico de Aulas</h2>   
                            <h5>Veja todas as aulas realizadas ou canceladas deste grupo </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?= $grupo['nome_grupo'] ?> - <?= $grupo['nome_professor'] ?> <?= $grupo['sobrenome_professor'] ?>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Situação</th>
                                                    <th>Data</th>
                                                    <th>Hora</th>
                                                    <th>Alunos Presentes</th>
                                                    <th>Alunos Ausentes</th>
                                                    <th width="1" class="text-center">Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i = 0; $i < count($aulas); $i++) { ?>
                                                <tr class="<?= $aulas[$i]['situacao'] == 1 ? '' : 'bg-danger'?>">
                                                    <td><?= $aulas[$i]['situacao'] == 0 ? 'Cancelada' : 'Realizada' ?></td>
                                                    <td><?= $aulas[$i]['data'] ?></td>
                                                    <td><?= $aulas[$i]['hora_inicio'] ?> - <?= $aulas[$i]['hora_fim'] ?></td>
                                                    <td class="center"><?= $aulas[$i]['alunos_presentes'] ?></td>
                                                    <td class="center"><?= $aulas[$i]['alunos_ausentes'] ?></td>
                                                    <td class="text-center"> 
                                                        <a href="consultar_aulas.php?id_grupo=<?= $aulas[$i]['id_grupo'] ?>&id_aula=<?= $aulas[$i]['id_aula'] ?>" class="btn btn-danger btn-xs">Excluir</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
    </body>
</html>
