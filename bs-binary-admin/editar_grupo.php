<?php
require_once './DAO/GrupoDAO.php';
require_once './DAO/ProfessorDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();

$objdao_prof = new ProfessorDAO();

$professor = $objdao_prof->ConsultarProfessorParaSelect();

if(isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    
    $dao = new GrupoDAO();
    $grupos = $dao->DetalharGrupo($_GET['cod']);
    
    if (count($grupos) == 0) {
        header('location: consultar_grupo.php');
    }
    
} else if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['nome'];
    $local = $_POST['local'];
    $professor = $_POST['professor'];
    $status = $_POST['status'];
    $id = $_POST['cod'];
    
    $objdao = new GrupoDAO();
    
    $ret = $objdao->AlterarGrupo($nome, $local, $professor, $status, $id);
    
    header('location: consultar_grupo.php?cod=' . $id . '&ret=' . $ret);
} else if (isset ($_POST['btnExcluir'])) {
    $id = $_POST['cod'];
    
    $objdao = new GrupoDAO();
    
    $ret = $objdao->ExcluirGrupo($id);
    
    header('location: consultar_grupo.php?ret=' . $ret);
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
                            if (isset($ret)) {
                            ExibirMsg($ret);
                            }
                            ?>
                            <h2>Editar Grupo</h2>   
                            <h5>Altere grupos já existentes. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="post" action="editar_grupo.php">
                        <input type="hidden" name="cod" value="<?= $grupos[0]['id_grupo'] ?>" />
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Ex: Quinta-Feira - 18:00/19:00" id="nome_grupo" name="nome" value="<?= $grupos[0]['nome_grupo'] ?>"/>
                        <label id="val_nome_grupo" class="validar-campos"></label>
                    </div>

                    <div class="form-group">
                        <label>Local da Aula</label>
                        <select class="form-control" onchange="MostrarCampoEndereco(this.value)" id="local" name="local">
                            <option value="">Selecione</option>
                            <option value="1" <?= $grupos[0]['local'] == 1 ? 'selected' : '' ?>>Escola</option>
                            <option value="2" <?= $grupos[0]['local'] == 2 ? 'selected' : '' ?>>Skype</option>
                            <option value="3" <?= $grupos[0]['local'] == 3 ? 'selected' : '' ?>>Google Hangouts</option>
                            <option value="4" <?= $grupos[0]['local'] == 4 ? 'selected' : '' ?>>Casa do Aluno</option>
                        </select>
                        <label id="val_local" class="validar-campos"></label>
                    </div>
                    <div class="form-group" id="divEnd" style="display: none">
                        <div class="form-group" class="ocultar-campos">
                            <label>Endereço</label>
                            <input class="form-control" placeholder="Rua exemplo, nnn - Cidade" />
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Selecione o Professor</label>
                        <select class="form-control" name="professor">
                            <?php for ($i = 0; $i < count($professor); $i++) { ?>
                            <option value="<?= $professor[$i]['id_professor'] ?>"><?= $professor[$i]['nome_professor'] ?> <?= $professor[$i]['sobrenome_professor'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1" <?= $grupos[0]['status'] == 1 ? 'selected' : '' ?>>Ativo</option>
                            <option value="0" <?= $grupos[0]['status'] == 0 ? 'selected' : '' ?>>Inativo</option>
                        </select>
                    </div>

                    <button onclick="return ValidarTela(3)" class="btn btn-success" name="btnSalvar">Salvar</button>
                    <button type="submit" class="btn btn-danger btn-sm" name="btnExcluir">Excluir</button>
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
