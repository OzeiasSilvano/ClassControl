<?php
require_once './DAO/AlunoDAO.php';
require_once './DAO/UtilDAO.php';
UtilDao::VerLogado();


if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['nome_aluno'];
    $sobrenome = $_POST['sobrenome_aluno'];
    $telefone = $_POST['tel_aluno'];
    $email = $_POST['email_aluno'];

    $objdao = new AlunoDAO();

    $ret = $objdao->CadastrarAluno($nome, $sobrenome, $telefone, $email);
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
                            <h2>Cadastrar Novo Aluno</h2>   
                            <h5>Insira os dados para cadastrar um novo aluno.</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <form method="post" action="novo_aluno.php">
                        <div class="form-group">
                            <label>Nome</label>
                            <input class="form-control" placeholder="Digite o nome do aluno..." id="nome_aluno" name="nome_aluno" />
                            <label id="val_nome_aluno" class="validar-campos"></label>
                        </div>

                        <div class="form-group">
                            <label>Sobrenome</label>
                            <input class="form-control" placeholder="Digite o sobrenome do aluno..." id="sobrenome_aluno" name="sobrenome_aluno"/>
                            <label id="val_sobrenome_aluno" class="validar-campos"></label>
                        </div>

                        <div class="form-group">
                            <label>Telefone</label>
                            <input class="form-control" placeholder="Digite o telefone do aluno..." id="tel_aluno" name="tel_aluno"/>
                            <label id="val_tel_aluno" class="validar-campos"></label>
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input class="form-control" placeholder="Digite o e-mail do aluno..." id="email_aluno" name="email_aluno" />
                            <label id="val_email_aluno" class="validar-campos"></label>
                        </div>

                        <button onclick="return ValidarTela(7)" class="btn btn-success" name="btnSalvar">Cadastrar</button>
                    </form>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->

    </body>
</html>
