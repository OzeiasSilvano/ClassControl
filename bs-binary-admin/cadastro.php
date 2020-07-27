<?php
require_once '../bs-binary-admin/DAO/UsuarioDAO.php';

if (isset($_POST['btnSalvar'])) {
    $nome = $_POST['seu_nome'];
    $email = $_POST['seu_email'];
    $senha = $_POST['sua_senha'];
    $rsenha = $_POST['rsenha'];
    
    $objdao = new UsuarioDAO();
    
    $ret = $objdao->CadastrarUsuario($nome, $email, $senha, $rsenha);
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
    include_once '_head.php';
    ?>
    <body>
        <div class="container">
            <div class="row text-center  ">
                <div class="col-md-12">
                    <br /><br />
                    <?php
                    if (isset($ret)) {
                        ExibirMsg($ret);
                    }
                    ?>
                    <h2>Class Control</h2>

                    <h5>(Faça seu cadastro para acesso)</h5>
                    <br />
                </div>
            </div>
            <div class="row">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>  Preencher os campos abaixo </strong>  
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="cadastro.php" >
                                <br/>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                    <input type="text" class="form-control" placeholder="Seu nome" id="seu_nome" name="seu_nome"/>
                                </div>

                                <div class="form-group">
                                    <label id="val_seu_nome" class="validar-campos"></label>
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" placeholder="Seu e-mail" id="seu_email" name="seu_email"/>
                                </div>

                                <div class="form-group">
                                    <label id="val_seu_email" class="validar-campos"></label>
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" placeholder="Sua senha" id="sua_senha" name="sua_senha"/>
                                </div>

                                <div class="form-group">
                                    <label id="val_sua_senha" class="validar-campos"></label>
                                </div>

                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control" placeholder="Repita sua senha" id="rsenha" name="rsenha"/>
                                </div>

                                <div class="form-group">
                                    <label id="val_rsenha" class="validar-campos"></label>
                                </div>

                                <button onclick="return ValidarTela123(1)" class="btn btn-success "name="btnSalvar">Finalizar cadastro</button>
                                <hr />
                                Já tem cadastro?  <a href="login.php" >Clique aqui</a>
                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </body>
</html>
