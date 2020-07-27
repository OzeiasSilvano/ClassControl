<?php
require_once './DAO/AlunoDAO.php';
require_once './DAO/RelacionamentoDAO.php';
require_once './DAO/GrupoDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    if (isset ($_GET['idexc']) && is_numeric($_GET['idexc'])) {
        $idexc = $_GET['idexc'];
        $cod = $_GET['cod'];
        $obj_exc = new RelacionamentoDAO();
        $relacionados = $obj_exc->EncerrarRelacionamento($idexc);
    }
    
    $id = $_GET['cod'];
    $objdao_rel = new RelacionamentoDAO();
    $relacionados = $objdao_rel->ConsultarRelacionamento($id);
    $objdao_aluno = new AlunoDAO();
    $alunos = $objdao_aluno->ConsultarAlunoParaVincularGrupo($id);
    $objdao_nomegrupo = new GrupoDAO();
    $grupo = $objdao_nomegrupo->ExibirGrupo($id);
} else if (isset($_POST['btnSalvar'])) {
    $aluno = $_POST['aluno'];
    $idgrupo = $_POST['cod'];
    $mensalidade = $_POST['mensalidade'];

    $dao = new RelacionamentoDAO();

    $ret = $dao->CriarRelacionamento($aluno, $idgrupo, $mensalidade);

    header('location: gerenciar_grupo.php?cod=' . $idgrupo . '&ret=' . $ret);
} else {
    header('location: consultar_grupo.php');
}


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
                            <h2>Relacionar Aluno</h2>   
                            <h5>Relacione um aluno ao grupo para começar a registrar as aulas.</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?= $grupo['nome_grupo'] ?> - <?= $grupo['nome_professor'] ?> <?= $grupo['sobrenome_professor'] ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Mensalidade</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php for ($i = 0; $i < count($relacionados); $i++) { ?>
                                                <td><?= $relacionados[$i]['nome_aluno'] ?> <?= $relacionados[$i]['sobrenome_aluno'] ?></td>
                                                <td>R$ <?= $relacionados[$i]['mensalidade'] ?></td>
                                                <td><a href="gerenciar_grupo.php?cod=<?= $relacionados[$i]['id_grupo'] ?>&idexc=<?= $relacionados[$i]['id_grupoaluno'] ?>" class="btn btn-danger btn-sm">Excluir</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <form method="post" action="gerenciar_grupo.php">
                        <input type="hidden" name="cod" value="<?= $id ?>" />
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Aluno</label>
                                    <select class="form-control" name="aluno">
                                        <option>Selecione</option>
                                        <?php for ($i = 0; $i < count($alunos); $i++) { ?>
                                            <option value="<?= $alunos[$i]['id_aluno'] ?>"><?= $alunos[$i]['nome_aluno'] ?> <?= $alunos[$i]['sobrenome_aluno'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <label>Mensalidade</label>
                                <div class="form-group input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="text" class="form-control" name="mensalidade" placeholder="Digite o valor da mensalidade do aluno">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success" name="btnSalvar">Salvar</button>

                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
    </body>
</html>
