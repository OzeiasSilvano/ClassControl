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
                            <h2>Dashboard</h2>   
                            <h5>Acompanhe os resultados por período. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <div class="form-group">
                        <label>Período</label>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Inicial</label>
                            <input type="date" class="form-control" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Final</label>
                            <input type="date" class="form-control" />
                        </div>
                    </div>

                    <label>Projetado</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon">R$</span>
                        <input disabled class="form-control" placeholder="">
                    </div>

                    <label>Despesas</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon">R$</span>
                        <input disabled class="form-control" placeholder="">
                    </div>

                    <label>Resultado</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon">R$</span>
                        <input disabled class="form-control" placeholder="">
                    </div>


                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
    </body>
</html>
