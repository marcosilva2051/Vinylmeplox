
            $(document).ready(function(){
                var emailCheck = false;
                var passCheck = false;
                var userCheck = false;
                var camposCheck = false;

                $('*[type="email"]').change(function (event){
                    var emailUserForm = $('.formRegisto *[name="email"]').val();

                    $.post('../actions.php?act=existeEmail', {emailUser:emailUserForm})

                        .done(function (resp){

                            resposta = JSON.parse(resp);
                            if(resposta.msg)
                            {
                                if($('.emailExiste').hasClass("text-success"))
                                    $('.emailExiste').removeClass("text-success");
                                $('.emailExiste').addClass("text-danger");
                                $('.emailExiste').text("O email inserido já existe!");
                                emailCheck = false;
                            }else{
                                if($('.emailExiste').hasClass("text-danger"))
                                    $('.emailExiste').removeClass("text-danger");
                                $('.emailExiste').addClass("text-success");
                                $('.emailExiste').text("O email inserido válido!");
                                emailCheck=true;
                            }
                                

                        })

                        .fail(function(){

                            alert("Erro na ligação");

                        });
                });
                
                $('#username').change(function(){
                    var username = $('#username').val();
                    $.post('../actions.php?act=existeUsername', {username:username})

                    .done(function (resp){

                        resposta = JSON.parse(resp);
                        if(resposta.msg)
                        {
                            if($('.usernameExiste').hasClass("text-success"))
                                $('.usernameExiste').removeClass("text-success");
                            $('.usernameExiste').addClass("text-danger");
                            $('.usernameExiste').text("O username inserido já existe!");
                            userCheck = false;
                        }else{
                            if($('.usernameExiste').hasClass("text-danger"))
                                $('.usernameExiste').removeClass("text-danger");
                            $('.usernameExiste').addClass("text-success");
                            $('.usernameExiste').text("O username inserido é válido!");
                            userCheck=true;
                        }
                            

                    })

                    .fail(function(){

                        alert("Erro na ligação");

                    });

                });

                $('.password2').change(function(){
                    if($('.password').val() != $('.password2').val())
                    {
                        passCheck = false;
                        if($('.passCheck').hasClass("text-success"))
                                    $('.passCheck').removeClass("text-success");
                        $('.passCheck').addClass("text-danger");
                        $('.passCheck').text("Passwords não coincidem!");
                    }else{
                        passCheck = true;
                        if($('.passCheck').hasClass("text-danger"))
                                    $('.passCheck').removeClass("text-danger");
                        $('.passCheck').addClass("text-success");
                        $('.passCheck').text("Passwords coincidem!");
                    }
                });

                $('.password').change(function(){
                    if($('.password').val() != $('.password2').val())
                    {
                        passCheck = false;
                        if($('.passCheck').hasClass("text-success"))
                                    $('.passCheck').removeClass("text-success");
                        $('.passCheck').addClass("text-danger");
                        $('.passCheck').text("Passwords não coincidem!");
                    }else{
                        passCheck = true;
                        if($('.passCheck').hasClass("text-danger"))
                                    $('.passCheck').removeClass("text-danger");
                        $('.passCheck').addClass("text-success");
                        $('.passCheck').text("Passwords coincidem!");
                    }
                });

                $('.formRegisto').submit(function (event){
                    var password = $('.formRegisto *[name="password"]').val();
                    var rePassword = $('.formRegisto *[name="password2"]').val();
                    var nome = $('.formRegisto *[name="nome"]').val();
                    var email = $('.formRegisto *[name="email"]').val();
                    var username = $('.formRegisto *[name="username"]').val();

                    if(password == '' || rePassword == '' || username == '' || email == '' || nome == ''){

                        $('.alertMsg').text("Todos os campos necessitam de ser preenchidos!");
                        $('.alertMsg').show('slow');
                        camposCheck = false;

                    }else{
                        camposCheck = true;
                    }

                    console.log(passCheck)
                    console.log(emailCheck)
                    console.log(camposCheck)
                    console.log(userCheck)

                    if(userCheck == true && passCheck == true && emailCheck==true && camposCheck == true)
                    {
                        return true;
                    }else{
                        $('.alertMsg').text("Registo bloqueado!");

                        $('.alertMsg').show('slow');
                        return false;
                    }
                });
            });