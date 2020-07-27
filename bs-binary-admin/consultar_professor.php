<?php
require_once './DAO/ProfessorDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();

$dao = new ProfessorDAO();

$professores = $dao->ConsultarProfessor();
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
                            <h2>Consultar Professor</h2>   
                            <h5>Veja todos os professores cadastrados. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Professores
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Telefone</th>
                                            <th>E-mail</th>
                                            <th width="5" style="text-align: center">Grupos Ativos</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($professores); $i++) { ?>
                                            <tr class="odd gradeX">
                                                <td><?= $professores[$i]['nome_professor'] ?> <?= $professores[$i]['sobrenome_professor'] ?></td>
                                                <td><?= $professores[$i]['telefone_professor'] ?></td>
                                                <td><?= $professores[$i]['email_professor'] ?></td>
                                                <td style="text-align: center" class="center"><?= $professores[$i]['grupos'] ?></td>
                                                <td class="center">
                                                    <a href="editar_professor.php?cod=<?= $professores[$i]['id_professor'] ?>" class="btn btn-warning btn-sm">Editar</a>
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


