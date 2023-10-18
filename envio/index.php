<?php
    //recepção das variáveis para cadastro e a inserção em si
    include '../database.php';
    if (isset($_POST['procedimento']) && $_POST['procedimento']!="0") {
        $id_paciente = $_POST['id-paciente'];
        $id_profissional = $_POST['profissional'];
        $tipo_solicitacao = $_POST['tipo-solicitacao'];
        $id_procedimento = $_POST['procedimento'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $data = date("Y-m-d", strtotime($data));
        foreach ($id_procedimento as $selectedOption){
            $query = "INSERT INTO solicitacao(id_paciente,id_profissional,id_procedimento,data,hora) 
            Values('$id_paciente','$id_profissional','$selectedOption','$data','$hora');";
            $result = $conn->query($query);
        }
        
    }else{
        echo'ERROR';
    }
?>
<!--exibição do envio-->
<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/envio.css">
        <title>Envio</title>
    </head>
    <header>

    </header>
    <body>
        <div class="container">
            <h1>Consulta cadastrada com sucesso!</h1>
            <a class='btn' href='../index.php' role='button'>Retornar à lista de pacientes!</a>
        </div>
    </body>

    <footer>

    </footer>
</html>