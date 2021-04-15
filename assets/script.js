$(document).ready(function(){
    $('.nav-link').click(function(){
        $(this).parents(".nav").find('.active').removeClass('active');
        $(this).addClass('active');
    })
    $('.del').click(function(){
        return confirm("Deseja apagar o registo?");  
    });
    $('#editar').click(function(){
        $(':input').attr("readonly",false);
    });

    var emailCheck = true;
    var userCheck = true;
    $('*[type="email"]').change(function (event){
        var emailUserForm = $('.formRegisto *[name="email"]').val();

        $.post('../actions.php?act=existeEmail2', {emailUser:emailUserForm})

            .done(function (resp){

                resposta = JSON.parse(resp);
                if(resposta.msg)
                {
                    if($('.emailExiste').hasClass("text-success"))
                        $('.emailExiste').removeClass("text-success");
                    $('.emailExiste').addClass("text-danger");
                    $('.emailExiste').text("Inválido!");
                    emailCheck = false;
                }else{
                    if($('.emailExiste').hasClass("text-danger"))
                        $('.emailExiste').removeClass("text-danger");
                    $('.emailExiste').addClass("text-success");
                    $('.emailExiste').text("Válido!");
                    emailCheck=true;
                }
                valida();

            })

            .fail(function(){

                alert("Erro na ligação");

            });
    });

    var usernameA = $('.formRegisto *[name="username"]').val();
    console.log(usernameA);
    $('#username').change(function (event){
        var usernameUserForm = $('.formRegisto *[name="username"]').val();

        if(usernameA != usernameUserForm){
            $.post('../actions.php?act=existeUsername', {username:usernameUserForm})

            .done(function (resp){

                resposta = JSON.parse(resp);
                if(resposta.msg)
                {
                    if($('.usernameExiste').hasClass("text-success"))
                        $('.usernameExiste').removeClass("text-success");
                    $('.usernameExiste').addClass("text-danger");
                    $('.usernameExiste').text("Inválido!");
                    userCheck = false;
                }else{
                    if($('.usernameExiste').hasClass("text-danger"))
                        $('.usernameExiste').removeClass("text-danger");
                    $('.usernameExiste').addClass("text-success");
                    $('.usernameExiste').text("Válido!");
                    userCheck=true;
                }
                    
                valida();
            })

            .fail(function(){

                alert("Erro na ligação");

            });
        }else{
            if($('.usernameExiste').hasClass("text-success"))
                        $('.usernameExiste').removeClass("text-success");
            if($('.usernameExiste').hasClass("text-danger"))
                        $('.usernameExiste').removeClass("text-danger");
            $('.usernameExiste').text("");              
            userCheck = true;          

        }
        
           
    });

    $('.msg').keyup(function(){
        var msg = $('.msg').val();
        if(msg != "")
            $('#sendComment').attr('disabled',false)
        else
            $('#sendComment').attr('disabled',true)

    })

    $('#sendComment').click(function(){
        var msg = $('.msg').val();
        var idbanda = $('#idbanda').val();

        $.post('../actions.php?act=enviaMensagem', {msg:msg,idbanda:idbanda})
        .done(function(resp){
            if(resp == "S"){
                location.reload();
            }
        })
        .fail(function(){
            alert("Erro na ligação");
        })
    });
    var nomeatual = $('.formRegisto *[name="nome"]').val();
    $('.nomeBanda').change(function(){
        if(nomeatual !=$('.formRegisto *[name="nome"]').val()){
            if($('.nomeBanda').val()== ""){
                $('[type="submit"]').attr("disabled",true);
            }else{
                var nome = $('.formRegisto *[name="nome"]').val();
                $.post('../actions.php?act=existeBanda', {nome:nome})
                .done(function(resp){
                    resposta = JSON.parse(resp);
                    if(resposta.msg)
                    {
                        if($('.bandaExiste').hasClass("text-success"))
                            $('.bandaExiste').removeClass("text-success");
                        $('.bandaExiste').addClass("text-danger");
                        $('.bandaExiste').text("Inválido!");
                        $('[type="submit"]').attr("disabled",true);
                    }else{
                        if($('.bandaExiste').hasClass("text-danger"))
                            $('.bandaExiste').removeClass("text-danger");
                        $('.bandaExiste').addClass("text-success");
                        $('.bandaExiste').text("Válido!");
                        $('[type="submit"]').attr("disabled",false);
                    }
    
                })
                .fail(function(){
    
                    alert("Erro na ligação");
    
                });
            }
        }else{
            if($('.bandaExiste').hasClass("text-danger"))
                $('.bandaExiste').removeClass("text-danger");
            if($('.bandaExiste').hasClass("text-success"))
                 $('.bandaExiste').removeClass("text-success"); 
             $('.bandaExiste').text("");                    

        }
    })
    var generoatual = $('#genero').val();
    $('#genero').change(function(){
        if(generoatual != $('#genero').val() )
            $('[type="submit"]').attr("disabled",false)    

    })
    $('#foto').change(function(){
        if($('#foto').val() != ""){
            $('[type="submit"]').attr("disabled",false)
        }
    })

    function valida(){

        if(userCheck == true && emailCheck == true)
        {
            $('[type="submit"]').attr("disabled",false);
        }else{
            $('[type="submit"]').attr("disabled",true);
        }
    }

})