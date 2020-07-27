<?php
require_once './DAO/GrupoDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();

$dao = new GrupoDAO();

$grupos = $dao->ConsultarGrupo();
?>
﻿<!DOCTYPE html>
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
                            if (isset($_GET['ret'])) {
                                ExibirMsg($_GET['ret']);
                            }
                            ?>
                            <h2>Consultar Grupos</h2>   
                            <h5>Veja todos o grupos cadastrados. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Grupos
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Local</th>
                                            <th>Professor</th>
                                            <th>Aulas</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($grupos); $i++) { ?>

                                            <tr class="odd gradeX">
                                                <td><?= $grupos[$i]['nome_grupo'] ?></td>
                                                <td><?= GrupoDAO::getLocalName($grupos[$i]['local']) ?></td>
                                                <td class="center"><?= $grupos[$i]['nome_professor'] ?></td>
                                                <td class="center">
                                                    <a href="confirmar_aula.php?id_grupo=<?=  $grupos[$i]['id_grupo'] ?>" class="btn btn-success btn-sm">Registrar</a>
                                                    <a href="consultar_aulas.php?id_grupo=<?=  $grupos[$i]['id_grupo'] ?>" class="btn btn-primary btn-sm">Histórico</a>
                                                </td>
                                                <td class="center">
                                                    <a href="gerenciar_grupo.php?cod=<?= $grupos[$i]['id_grupo'] ?>" class="btn btn-warning btn-sm">Gerenciar</a>
                                                    <a href="editar_grupo.php?cod=<?= $grupos[$i]['id_grupo'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

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
