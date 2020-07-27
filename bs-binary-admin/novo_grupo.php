<?php
require_once './DAO/GrupoDAO.php';
require_once './DAO/ProfessorDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();

$objdao_prof = new ProfessorDAO();
$professores = $objdao_prof->ConsultarProfessorParaSelect();

if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['nome'];
    $local = $_POST['local'];
    $professor = $_POST['professor'];
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
    
    $objdao = new GrupoDAO();
    
    $ret = $objdao->CadastrarGrupo($nome, $local, $professor, $endereco);
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
                            if (isset($ret)) {
                                ExibirMsg($ret);
                            }
                            ?>
                            <h2>Criar Novo Grupo</h2>   
                            <h5>Crie grupos de alunos com data e hora das aulas. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="post" action="novo_grupo.php">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Ex: Quinta-Feira - 18:00/19:00" id="nome" name="nome"/>
                        <label id="val_nome" class="validar-campos"></label>
                    </div>
                    <div class="form-group">
                        <label>Local da Aula</label>
                        <select class="form-control" onchange="MostrarCampoEndereco(this.value)" id="local" name="local">
                            <option value="">Selecione</option>
                            <?php foreach (GrupoDAO::getLocals() as $k => $v): ?>
                            <option value="<?= $k ?>"><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label id="val_local" class="validar-campos"></label>
                    </div>
                    <div class="form-group" id="divEnd" style="display: none">
                        <div class="form-group" class="ocultar-campos">
                            <label>Endereço</label>
                            <input class="form-control" placeholder="Insira o endereço onde acontecerá a aula..." />
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Selecione o Professor</label>
                        <select class="form-control" id="professor" name="professor">
                            <option value="">Selecione</option>
                            <?php foreach ($professores as $professor): ?>
                            <option value="<?= $professor['id_professor'] ?>"><?= $professor['nome_professor'] ?></option>
                            <?php endforeach; ?>
                            
                            <?php for ($i = 0; $i < count($professores); $i++) { ?>
                            <!--<option value="<?= $professores[$i]['id_professor'] ?>"><?= $professores[$i]['nome_professor'] ?></option>-->
                            <?php } ?>
                        </select>
                        <label id="val_professor" class="validar-campos"></label>
                    </div>

                    <button onclick="return ValidarTela123(9)" class="btn btn-success" name="btnSalvar">Salvar</button>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <script>
            function MostrarCampoEndereco(valor) {
                if (valor == 4) {
                    $("#divEnd").show();
                } else {
                    $("#divEnd").hide();
                }
            }
        </script>
    </body>
</html>
