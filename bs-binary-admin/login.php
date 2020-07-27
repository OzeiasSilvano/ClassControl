<?php
require_once './DAO/UsuarioDAO.php';

if (isset($_POST['btnSalvar'])) {
    $email = $_POST['email_login'];
    $senha = $_POST['senha_login'];
    
    $objdao = new UsuarioDAO();
    
    $ret = $objdao->LogarUsuario($email, $senha);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php
    include_once '_head.php';
    ?>
    <body>
        <div class="container">
            <div class="row text-center ">
                <div class="col-md-12">
                    <br /><br />
                    <?php
                    if (isset($ret)) {
                        ExibirMsg($ret);
                    }
                    ?>
                    <h2>Class Control</h2>

                    <h5>(Faça seu login)</h5>
                    <br />
                </div>
            </div>
            <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>   Entre com seus dados </strong>  
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="login.php">
                                <br />
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                    <input type="text" class="form-control" placeholder="Seu e-mail" id="email_login" name="email_login"/>
                                </div>
                                <div>
                                    <label id="val_email_login" class="validar-campos"></label>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    <input type="password" class="form-control"  placeholder="Sua senha" id="senha_login" name="senha_login"/>
                                </div>
                                <div>
                                    <label id="val_senha_login" class="validar-campos"></label>
                                </div>


                                <button onclick="return ValidarTela(6)" class="btn btn-primary " name="btnSalvar">Acessar</button>
                                <hr />
                                Não tem cadastro? <a href="cadastro.php" >Clique aqui</a> 
                            </form>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </body>
</html>
