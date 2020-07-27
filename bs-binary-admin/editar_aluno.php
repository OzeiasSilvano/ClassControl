<?php
require_once './DAO/AlunoDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $dao = new AlunoDAO();
    
    $alunos = $dao->DetalharAluno($_GET['cod']);
    
    if (count($alunos) == 0) {
        header('location: consultar_aluno.php');
    }
    
} else if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['alt_nome'];
    $sobrenome = $_POST['alt_sobrenome'];
    $telefone = $_POST['alt_tel'];
    $email = $_POST['alt_email'];
    $id = $_POST['cod'];
    
    $objdao = new AlunoDAO();
    
    $ret = $objdao->AlterarAluno($nome, $sobrenome, $telefone, $email, $id);
    
    header('location: consultar_aluno.php?cod=' . $id . '&ret=' . $ret);
    
} else if (isset ($_POST['btnExcluir'])) {
    $id = $_POST['cod'];
    
    $objdao = new AlunoDAO();
    
    $ret = $objdao->ExcluirAluno($id);
    
    header('location: consultar_aluno.php?ret=' . $ret);
    
} else {
    header('location: consultar_aluno.php');
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
                            <h2>Editar Aluno</h2>   
                            <h5>Altere informações de alunos já cadastrados.</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="post" action="editar_aluno.php">
                        <input type="hidden" name="cod" value="<?= $alunos[0]['id_aluno'] ?>" />
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite a alteração..." id="alt_nome" name="alt_nome" value="<?= $alunos[0]['nome_aluno'] ?>"/>
                        <label id="val_alt_nome" class="validar-campos"></label>
                    </div>

                    <div class="form-group">
                        <label>Sobrenome</label>
                        <input class="form-control" placeholder="Digite a alteração..." id="alt_sobrenome" name="alt_sobrenome" value="<?= $alunos[0]['sobrenome_aluno'] ?>"/>
                        <label id="val_alt_sobrenome" class="validar-campos"></label>
                    </div>

                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" placeholder="Digite a alteração..." id="alt_tel" name="alt_tel" value="<?= $alunos[0]['telefone_aluno'] ?>"/>
                        <label id="val_alt_tel" class="validar-campos"></label>
                    </div>

                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" placeholder="Digite a alteração..." id="alt_email" name="alt_email" value="<?= $alunos[0]['email_aluno'] ?>"/>
                        <label id="val_alt_email" class="validar-campos"></label>
                    </div>

                    <button onclick="return ValidarTela1(2)" class="btn btn-success" name="btnSalvar">Salvar</button>
                    <button type="submit" class="btn btn-danger" name="btnExcluir">Excluir</button>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->

    </body>
</html>


