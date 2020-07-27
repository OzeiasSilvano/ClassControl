function ValidarTela(numero_tela) {
    
    var ret = true;
    
    switch(numero_tela) {
        case 1://tela cadastro
            
            if ($("#seu_nome").val().trim() === '') {
                $("#val_seu_nome").show().html("Preencher o campo nome");
                ret = false;
            } else {
                $("#val_seu_nome").hide();
            }
            
            if ($("#seu_email").val().trim() === '') {
                $("#val_seu_email").show().html("Preencher o campo E-mail");
                ret = false;
            } else {
                $("#val_seu_email").hide();
            }
            
            break;
            
        case 2://tela editar aluno
            
            if ($("#alt_nome").val().trim() === '') {
                $("#val_alt_nome").show().html("Preencher o campo nome");
                ret = false;
            } else {
                $("#val_alt_nome").hide();
            }
            
            if ($("#alt_sobrenome").val().trim() === '') {
                $("#val_alt_sobrenome").show().html("Preencher o campo sobrenome");
                ret = false;
            } else {
                $("#val_alt_sobrenome").hide();
            }
            
            if ($("#alt_tel").val().trim() === '') {
                $("#val_alt_tel").show().html("Preencher o campo telefone");
                ret = false;
            } else {
                $("#val_alt_tel").hide();
            }
            
            if ($("#alt_email").val().trim() === '') {
                $("#val_alt_email").show().html("Preencher o campo e-mail");
                ret = false;
            } else {
                $("#val_alt_email").hide();
            }
            
            if ($("#alt_mensalidade").val().trim() === '') {
                $("#val_alt_mensalidade").show().html("Preencher o campo mensalidade");
                ret = false;
            } else {
                $("#val_alt_mensalidade").hide();
            }
            
            break;
            
        case 3://tela editar grupo
            
            if ($("#nome_grupo").val().trim() === '') {
                $("#val_nome_grupo").show().html("Preencher o campo nome");
                ret = false;
            } else {
                $("#val_nome_grupo").hide();
            }
            
            break;
            
        case 4://tela editar professor
            
            if ($("#alt_prof").val().trim() === '') {
                $("#val_alt_prof").show().html("Preencher o campo nome");
                ret = false;
            } else {
                $("#val_alt_prof").hide();
            }
            
            if ($("#alt_sobreprof").val().trim() === '') {
                $("#val_alt_sobreprof").show().html("Preencher o campo sobrenome");
                ret = false;
            } else {
                $("#val_alt_sobreprof").hide();
            }
            
            if ($("#alt_telprof").val().trim() === '') {
                $("#val_alt_telprof").show().html("Preencher o campo telefone");
                ret = false;
            } else {
                $("#val_alt_telprof").hide();
            }
            
            if ($("#alt_emailprof").val().trim() === '') {
                $("#val_alt_emailprof").show().html("Preencher o campo e-mail");
                ret = false;
            } else {
                $("#val_alt_emailprof").hide();
            }
            
            break;
            
        case 5://tela lançar despesas
            
            if ($("#nome_despesa").val().trim() === '') {
                $("#val_nome_despesa").show().html("Preencher o campo nome");
                ret = false;
            } else {
                $("#val_nome_despesa").hide();
            }
            
            if ($("#valor_despesa").val().trim() === '') {
                $("#val_valor_despesa").show().html("Preenhcer o campo valor");
                ret = false;
            } else {
                $("#val_valor_despesa").hide();
            }
            
            break;
            
        case 6://tela login
            
            if ($("#email_login").val().trim() === '') {
                $("val_email_login").show().html("Preencher o campo e-mail");
                ret = false;
            } else {
                $("#val_email_login").hide();
            }
            
            if ($("#senha_login").val().trim() === '') {
                $("#val_senha_login").show().html("Preencher o campo senha");
                ret = false;
            } else {
                $("#val_senha_login").hide();
            }
            
            break;
            
        case 7://tela novo aluno
            
            if ($("#nome_aluno").val().trim() === '') {
                $("#val_nome_aluno").show().html("Preencher o campo nome");
                ret = false;
            } else {
                $("#val_nome_aluno").hide();
            }
            
            if ($("#sobrenome_aluno").val().trim() === '') {
                $("#val_sobrenome_aluno").show().html("Preencher o campo sobrenome");
                ret = false;
            } else {
                $("#val_sobrenome_aluno").hide();
            }
            
            if ($("#tel_aluno").val().trim() === '') {
                $("#val_tel_aluno").show().html("Preencher o campo telefone");
                ret = false;
            } else {
                $("#val_tel_aluno").hide();
            }
            
            if ($("#email_aluno").val().trim() === '') {
                $("#val_email_aluno").show().html("Preencher o campo e-mail")
                ret = false;
            } else {
                $("#val_email_aluno").hide();
            }
            
            if ($("#mensalidade").val().trim() === '') {
                $("#val_mensalidade").show().html("Preencher o campo mensalidade");
                ret = false;
            } else {
                $("#val_mensalidade").hide();
            }
            
            break;
            
        case 8://tela novo professor
            
            if ($("#nome_prof").val().trim() === '') {
                $("#val_nome_prof").show().html("Preencher o campo nome");
                ret = false;
            } else {
                $("#val_nome_prof").hide();
            }
            
            if ($("#sobrenome_prof").val().trim() === '') {
                $("#val_sobrenome_prof").show().html("Preenhcer o campo sobrenome");
                ret = false;
            } else {
                $("#val_sobrenome_prof").hide();
            }
            
            if ($("#tel_prof").val().trim() === '') {
                $("#val_tel_prof").show().html("Preenhcer o campo telefone");
                ret = false;
            } else {
                $("#val_tel_prof").hide();
            }
            
            if ($("#email_prof").val().trim() === '') {
                $("#val_email_prof").show().html("Preencher o campo e-mail");
                ret = false;
            } else {
                $("#val_email_prof").hide();
            }
            
            break;
            
        case 9: //tela novo grupo
            
            if($("#nome").val().trim() === '') {
                $("#val_nome").show().html("Preencher o nome do grupo");
                ret = false;
            } else {
                $("#val_nome").hide();
            }
            
            if ($("#local").val().trim() === '') {
                $("#val_local").show().html("Selecione o local");
                ret = false;
            } else {
                $("#val_local").hide();
            }
            
            if ($("#professor").val().trim() === '') {
                $("#val_professor").show().html("Selecione o professor");
                ret = false;
            } else {
                $("#val_professor").hide();
            }
    }
    
    
    
    return ret;
    
}