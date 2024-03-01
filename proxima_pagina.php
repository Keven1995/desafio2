<?php
function getVirtualMachineIPs() {
    // Lista de IPs das máquinas virtuais
    $virtual_machine_ips = array(
        "vmKevenFinal" => "192.168.37.14",
        "vmKevenFinal2" => "192.168.37.15"
    );

    // Retorna apenas os endereços IP das máquinas virtuais
    return array_values($virtual_machine_ips);
}

// Obtém os endereços IP das máquinas virtuais
$ips = getVirtualMachineIPs();

// Escolhe aleatoriamente um endereço IP da lista
$random_index = array_rand($ips);
$random_ip = $ips[$random_index];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP da Máquina Virtual</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgb(63,27,165);
            font-family: Arial, sans-serif;
            color: #ffffff;
        }

        .container {
            text-align: center;
        }

        .endIP {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Endereço IP:</h1>
        <p class="endIP"><?php echo $random_ip; ?></p>
    </div>
</body>
</html>
