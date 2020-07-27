<?php
require_once './DAO/ProfessorDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();

if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['nome_prof'];
    $sobre = $_POST['sobrenome_prof'];
    $tel = $_POST['tel_prof'];
    $email = $_POST['email_prof'];

    $objdao = new ProfessorDAO();

    $ret = $objdao->CadastrarProfessor($nome, $sobre, $tel, $email);
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
                            <h2>Cadastrar Professor</h2>   
                            <h5>Insira os dados para cadastrar um novo professor. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="post" action="novo_professor.php">
                        <div class="form-group">
                            <label>Nome</label>
                            <input class="form-control" placeholder="Digite o nome." id="nome_prof" name="nome_prof" />
                            <label id="val_nome_prof" class="validar-campos"></label>
                        </div>

                        <div class="form-group">
                            <label>Sobrenome</label>
                            <input class="form-control" placeholder="Digite o sobrenome." id="sobrenome_prof" name="sobrenome_prof"/>
                            <label id="val_sobrenome_prof" class="validar-campos"></label>
                        </div>

                        <div class="form-group">
                            <label>Telefone</label>
                            <input class="form-control" placeholder="Digite o telefone para contato." id="tel_prof" name="tel_prof" />
                            <label id="val_tel_prof" class="validar-campos"></label>
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="Digite o e-mail para contato" id="email_prof" name="email_prof"/>
                            <label id="val_email_prof" class="validar-campos"></label>
                        </div>

                        <button onclick="return ValidarTela(8)" class="btn btn-success" name="btnSalvar">Salvar</button>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
    </body>
</html>
