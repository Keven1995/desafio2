<?php
// Definir a resposta correta
$resposta_correta = "código";

// Inicializar a variável de mensagem de erro
$mensagem_erro = "";

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se o campo resposta foi enviado e não está vazio
        $resposta_post = trim($_POST["resposta"]);
    if (isset($_POST["resposta"]) && !empty($resposta_post)) {
        // Remover espaços em branco do início e do fim e converter para minúsculas
        $resposta_usuario = strtolower(trim($_POST["resposta"]));
        
        // Verificar se a resposta do usuário é correta
        if ($resposta_usuario == $resposta_correta) {
            // Redirecionar para a próxima página se a resposta estiver correta
            header("Location: proxima_pagina.php");
            exit();
        } else {
            // Mensagem de erro se a resposta estiver incorreta
            $mensagem_erro = "Ops! Resposta incorreta. Tente novamente.";
        }
    } else {
        // Mensagem de erro se o campo resposta estiver vazio
        $mensagem_erro = "Por favor, insira sua resposta.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enigma</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: rgb(64 37 161 / 27%);
            background: url(img.jpeg) no-repeat;
            background-size: cover;
            background-position: top;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 1000%;
            background-color: rgb(0 0 0 / 66%);
            z-index: -1;
        }

        .container {
            max-width: 450px;
            margin: 170px auto;
            padding: 45px;
            border: 2px solid rgba(255,255,255,.2);
            border-radius: 30px;
            background-color: rgb(199 183 244 / 27%);
            text-align: center; /* Centraliza todo o conteúdo */
            color: #ffff;
            
        }

        .centralizado {
            text-align: center;
            color: #ffff;
        }

        .alert {
            background-color: rgba(255, 0, 0, 0.5);
            color: #ffff;
        }

        .btn {
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.55);
        }

        </style>
</head>
<body>
    <div class="container">
        <h2 class="h1">Se um IP você quer ver, o enigma deve responder:</h2>
        <p class="centralizado">"Eu sou uma sequência de números e letras,
        às vezes pequena, às vezes longa e completa. Em uma tela ou em um papel, você pode me encontrar,
        mas para decifrar-me, você precisa me analisar."</p>
        <p class="centralizado"> O que sou eu?</p>
        <?php if (!empty($mensagem_erro)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $mensagem_erro; ?>
            </div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="resposta" placeholder="Responda aqui..." class="form-control" autocomplete="off" aria-label="Resposta" aria-describedby="respostaHelp">
            <br>
            <button type="submit" class="btn btn-success">Enviar</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>