<?php

    $errNome = false;
    $errEmail = false;
    $errMensagem = false;
    $success = false;
    $nome = false;
    $email = false;
    $telefone = false;
    $mensagem = false;

    $assunto = "Email de contato do LiveCapital";

    if((isset($_POST)) && (isset($_POST['nome'])))
    {
        $destinatario = 'gusmorada@gmail.com';

        if((isset($_POST['nome'])) && ($_POST['nome'] != ""))
            $nome = $_POST['nome'];
        else
            $errNome = "O campo nome é obrigatório";

        if((isset($_POST['email'])) && ($_POST['email'] != ""))
            $email = $_POST['email'];
        else
            $errEmail = "O campo email é obrigatório";

        if(isset($_POST['telefone']))
            $telefone = $_POST['telefone'];

        if((isset($_POST['mensagem'])) && ($_POST['mensagem'] != ""))
            $mensagem = $_POST['mensagem'];
        else
            $errMensagem = "O campo mensagem é obrigatório";

        if((!$errNome) && (!$errEmail) && (!$errMensagem))
        {
            $novaMensagem = $mensagem;

            if($telefone)
                $novaMensagem .= "\r\n Telefone:".$telefone;

            // compose headers
            $headers = 'From: '.$nome.'<'.$email.'>' . "\r\n" .
                         'X-Mailer: PHP/' . phpversion();

            if(mail($destinatario, $assunto, $novaMensagem, $headers))
                $success = "Seu email foi enviado com sucesso";
            else
                $success = "Ocorreu um erro no envio da mensagem, tente novamente mais tarde";
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    </head>
    <body>
        <h2>Contato</h2>
        <span><?php if($success) echo $success; ?></span>
        <form action="contato.php" method="post">
            <fieldset>
                <div>
                    <span class="erro"><?php if($errNome) echo $errNome; ?></span>
                    <label for="name">Nome:</label>
                    <input name="nome" type="text" <?php if($nome) echo 'value="'.$nome.'"' ?> placeholder="Escreva seu nome" required autofocus />
                </div>
                <div>
                    <span class="erro"><?php if($errEmail) echo $errEmail; ?></span>
                    <label for="email">Email:</label>
                    <input name="email" type="email" <?php if($email) echo 'value="'.$email.'"' ?> placeholder="Escreva seu endereço de email" required />
                </div>
                <div>
                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone"<?php if($telefone) echo 'value="'.$telefone.'"' ?> placeholder="Escreva o seu telefone"/>
                </div>
                <div>
                    <span class="erro"><?php if($errMensagem) echo $errMensagem; ?></span>
                    <label for="mensagem">Mensagem:</label>
                    <textarea name="mensagem" placeholder="Escreva sua dúvida ou sugestão" required ><?php if($mensagem) echo $mensagem ?></textarea>
                </div>
                <input type="submit" value="Enviar Email" />
            </fieldset>
        </form>
    </body>
</html>
