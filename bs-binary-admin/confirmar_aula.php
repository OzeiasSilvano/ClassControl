<?php
require_once './DAO/GrupoDAO.php';
require_once './DAO/RelacionamentoDAO.php';
require_once './DAO/AulaDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();

if (isset($_GET['id_grupo']) && is_numeric($_GET['id_grupo'])) {
    $idgrupo = $_GET['id_grupo'];
} elseif (isset ($_POST['btnSalvar'])) {
    $situacao = $_POST['situacao'];
    $data = $_POST['data'];
    $hrini = $_POST['hrini'];
    $hrfin = $_POST['hrfin'];
    $presentes = isset($_POST['presente']) ? $_POST['presente'] : [];
    $obs = $_POST['obs'];
    $idgrupo = $_POST['id_grupo'];
    
    $objdao = new AulaDAO();
    $ret = $objdao->CriarAula($situacao, $data, $hrini, $hrfin, $presentes, $obs, $idgrupo);
    
    if ($ret == 1) {
        header('Location: consultar_aulas.php?id_grupo=' . $idgrupo . '&ret=' . $ret);
    }
}

$objdao_alunos = new RelacionamentoDAO();
$alunos = $objdao_alunos->ConsultarRelacionamento($idgrupo);
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
                        <div class="col-xs-12">
                            <?php
                            if (isset($ret)) {
                                ExibirMsg($ret);
                            }
                            ?>
                            <h2>Confirmar Aula</h2>   
                            <h5>Confirme as aulas que aconteceram com os alunos presentes. </h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="post" action="confirmar_aula.php">
                        <input type="hidden" name="id_grupo" value="<?= $idgrupo ?>" />
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Situação</label>
                                    <select name="situacao" id="situacao" class="form-control">
                                        <option value="1">Aula Realizada</option>
                                        <option value="0">Aula Cancelada</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group" >
                                    <label>Data</label>
                                    <input type="date" class="form-control" name="data" />
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Horário Inicial</label>
                                    <input type="time" class="form-control" name="hrini" />
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Horário Final</label>
                                    <input type="time" class="form-control" name="hrfin" />
                                </div>
                            </div>
                        </div>
                        
                        <div id="lista_presentes">
                        
                            <br />

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Lista de Chamada
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="1">Presente</th>
                                                            <th>Nome</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php for ($i = 0; $i < count($alunos); $i++) { ?>
                                                            <tr>
                                                                <td style="text-align: center;">
                                                                    <label>
                                                                        <input type="checkbox" value="<?= $alunos[$i]['id_aluno'] ?>" name="presente[]" />
                                                                    </label>
                                                                </td>
                                                                <td><?= $alunos[$i]['nome_aluno'] ?> <?= $alunos[$i]['sobrenome_aluno'] ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Observações</label>
                                    <textarea class="form-control" rows="3" name="obs"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-success" name="btnSalvar">Salvar</button>
                                <button type="button" class="btn btn-default" onclick="window.open('consultar_grupo.php', '_self');">Voltar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        
        <script type="text/javascript">
            var checarSituacao = function () {
                if (Math.ceil($('#situacao').val()) === 1) {
                    $('#lista_presentes').show();
                } else {
                    $('#lista_presentes').hide();
                }
            };
            
            $(window).load(checarSituacao);
            $('#situacao').change(checarSituacao);
        </script>
    </body>
</html>
