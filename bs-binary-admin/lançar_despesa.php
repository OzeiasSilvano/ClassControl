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
                            <h2>Lançar Despesas</h2>   
                            <h5>Registre seus custos fixos e variáveis. </h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Ex: Conta de Água" id="nome_despesa"/>
                        <label id="val_nome_despesa" class="validar-campos"></label>
                    </div>
                    
                    <label>Valor</label>
                    <div class="form-group input-group">
                        <span class="input-group-addon">R$</span>
                        <input type="text" class="form-control" placeholder="Digite o valor da despesa." id="valor_despesa"/>
                    </div>
                    <div class="form-group">
                        <label id="val_valor_despesa" class="validar-campos"></label>
                    </div>

                    <label>Categoria</label>
                    <div class="form-group" class="col-md-12">
                        <div class="col-md-6">
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked />Aluguel/Condomínio
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"/>Água/Luz
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3"/>Internet/Telefone
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios4" value="option4"/>Consumível Aula (Papel/Toner/Impressão...)
                            </label>
                        </div>
                    </div>
                        <div class="col-md-6">
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios5" value="option5"/>Consumível Espaço (Café/Copos/Papel Higiênico...)
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios6" value="option6"/>Transporte/Combustível
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios7" value="option7"/>Salários
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="optionsRadios" id="optionsRadios8" value="option8"/>Outros
                            </label>
                        </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Data</label>
                        <input class="form-control" type="date" />
                    </div>

                    <div class="form-group">
                        <label>Observação</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <button onclick="return ValidarTela(5)" class="btn btn-success">Salvar</button>

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
    </body>
</html>

