<?php
require_once './DAO/ProfessorDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $dao = new ProfessorDAO();
    
    $professores = $dao->DetalharProfessor($_GET['cod']);
    
    if (count($professores) == 0) {
        header('location: consultar_professor.php');
    }
    
} else if (isset($_POST['btnSalvar'])) {
    
    $nome = $_POST['alt_prof'];
    $sobre = $_POST['alt_sobreprof'];
    $tel = $_POST['alt_telprof'];
    $email = $_POST['alt_emailprof'];
    $id = $_POST['cod'];

    $objdao = new ProfessorDAO();

    $ret = $objdao->AlterarProfessor($nome, $sobre, $tel, $email, $id);
    
    header('location: editar_professor.php?cod=' . $id . '&ret=' . $ret);
    
} else if (isset ($_POST['btnExcluir'])) {
    $id = $_POST['cod'];
    
    $dao = new ProfessorDAO();
    $ret = $dao->ExcluirProfessor($id);
    
    header('location: consultar_professor.php?ret=' . $ret);
    
} else {
    header('consultar_professor.php');
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
                            if (isset($_GET['ret'])) {
                                ExibirMsg($_GET['ret']);
                            }
                            ?>
                            <h2>Editar Professor</h2>   
                            <h5>Altere informações de professores já cadastrados. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="post" action="editar_professor.php">
                        <input type="hidden" name="cod" value="<?= $professores[0]['id_professor'] ?>" />
                        <div class="form-group">
                            <label>Nome</label>
                            <input class="form-control" placeholder="Digite a alteração desejada." id="alt_prof" name="alt_prof" value="<?= $professores[0]['nome_professor'] ?>"/>
                            <label id="val_alt_prof" class="validar-campos"></label>
                        </div>

                        <div class="form-group">
                            <label>Sobrenome</label>
                            <input class="form-control" placeholder="Digite a alteração desejada." id="alt_sobreprof" name="alt_sobreprof" value="<?= $professores[0]['sobrenome_professor'] ?>"/>
                            <label id="val_alt_sobreprof" class="validar-campos"></label>
                        </div>

                        <div class="form-group">
                            <label>Telefone</label>
                            <input class="form-control" placeholder="Digite a alteração desejada." id="alt_telprof" name="alt_telprof" value="<?= $professores[0]['telefone_professor'] ?>"/>
                            <label id="val_alt_telprof" class="validar-campos"></label>
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="Digite a alteração desejada." id="alt_emailprof" name="alt_emailprof" value="<?= $professores[0]['email_professor'] ?>"/>
                            <label id="val_alt_emailprof" class="validar-campos"></label>
                        </div>

                        <button onclick="return ValidarTela(4)" class="btn btn-success" name="btnSalvar">Salvar</button>
                        <button type="submit" class="btn btn-danger btn-sm" name="btnExcluir">Excluir</button>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
    </body>
</html>
