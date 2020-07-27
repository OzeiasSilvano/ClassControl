<?php
require_once './DAO/AlunoDAO.php';
require_once './DAO/RelacionamentoDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();

$dao = new AlunoDAO();
$alunos = $dao->ConsultarAluno();

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
                            <h2>Consultar Alunos</h2>   
                            <h5>Veja todos os alunos cadastrados </h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Alunos
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Telefone</th>
                                            <th>E-mail</th>
                                            <th>Grupo</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($alunos); $i++) : ?>
                                        <tr class="odd gradeX">
                                            <td> <?= $alunos[$i]['nome_aluno'] . ' ' . $alunos[$i]['sobrenome_aluno'] ?></td>
                                            <td> <?= $alunos[$i]['telefone_aluno'] ?></td>
                                            <td> <?= $alunos[$i]['email_aluno'] ?></td>
                                            <td  class="center"><?= $alunos[$i]['nome_grupo'] ?></td>
                                            <td class="center">
                                                <a href="editar_aluno.php?cod=<?= $alunos[$i]['id_aluno'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                                
                                            </td>
                                        </tr>
                                        <?php endfor; ?>
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

