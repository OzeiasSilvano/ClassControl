<?php

function ExibirMsg ($ret) {
    
    switch ($ret) {
        case -2:
            echo '<div class="alert alert-danger">
                    Não foi possível excluir o registro pois o mesmo está em uso.
                  </div>';
            
            break;
        
        case -1:
            
            echo '<div class="alert alert-danger">
                    Ocorreu um erro na operação. Tente mais tarde!
                  </div>';
            
            break;
        
        case 0:
            echo '<div class="alert alert-warning">
                    Preencher o(s) campo(s) obrigatório(s).
                  </div>';
            
            break;
        
        case 1:
            echo '<div class="alert alert-success">
                    Ação realizada com sucesso!
                  </div>';
            
            break;
        
        case 2:
            echo '<div class="alert alert-warning">
                    A senha deve ter pelo menos 6 dígitos.
                  </div>';
            
            break;
        
        case 3:
            echo '<div class="alert alert-warning">
                    As senhas devem ser iguais.
                  </div>';
            
            break;
        
        case 4:
            echo '<div class="alert alert-success">
                    Exclusão realizada com sucesso!
                  </div>';
            
            break;
    }
    
}