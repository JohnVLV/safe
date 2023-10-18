<?php
    include '../database.php';
?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/solicitacao.css">
        <title>Clínica</title>
    </head>
    <header>

    </header>
    <body>
        <div class="container">
            <h1 class="my-3">Realizar solicitação</h1>
            <?php
                if (isset($_GET['id']) && $_GET['id']!="") {
                    $id_paciente = $_GET['id'];
                    $result = mysqli_query($conn,"SELECT nome, dataNasc, CPF FROM `pacientes` WHERE id = '$id_paciente'");
                    $result2 = mysqli_fetch_array($result);
                    $nome_paciente = $result2['nome'];
                    $data_nasc = $result2['dataNasc'];
                    $data_nasc = date("d/m/Y", strtotime($data_nasc));
                    $cpf = $result2['CPF'];
            ?>
                    <div class="container">
                        <form action="../envio/index.php" method="post">
                            <div class="row">
                                <div class="col">
                                    <strong>Nome</strong>
                                </div>
                                <div class="col">
                                    <strong>Data de nascimento</strong>
                                </div>
                                <div class="col">
                                    <strong>CPF</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input class="form-control" type="text" <?php echo "value='$nome_paciente'" ?> disabled>
                                    <input class="form-control" id="id-paciente" name="id-paciente" type="hidden" <?php echo "value='$id_paciente'" ?>>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="text" <?php echo "value='$data_nasc'" ?> disabled>
                                </div>
                                <div class="col">
                                    <input class="form-control" type="text" <?php echo "value='$cpf'" ?> disabled>
                                </div>
                            </div>

                            <div class="row text-center">
                                <p><strong>Atenção! </strong>Os campos com * devem ser preenchidos obrigatóriamente!</p>
                            </div>
                            

                            <div class="row">
                                <div class="col">
                                    <strong>Profissional*</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <select class="form-control" name="profissional" id="profissional" required>
                                        <option value=""></option>
                                        <?php 
                                        $query ="SELECT id, nome FROM `profissional` WHERE status = 'ativo'";
                                        $result = $conn->query($query);
                                        if($result->num_rows> 0){
                                            while($optionData=$result->fetch_assoc()){
                                                $option =$optionData['nome'];
                                                $option2 =$optionData['id'];
                                        ?>
                                        <?php
                                        //opção selecionada
                                        if(!empty($nome) && $nome== $option){
                                        ?>
                                        <option value="<?php echo $option2; ?>" selected><?php echo $option; ?> </option>
                                        <?php 
                                            continue;
                                        }?>
                                        <option value="<?php echo $option2; ?>" ><?php echo $option; ?> </option>
                                        <?php
                                            }}
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <strong>Tipo de solicitação*</strong>
                                </div>
                                <div class="col-6">
                                    <strong>Procedimentos*</strong>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <select class="form-control" name="tipo-solicitacao" id="tipo-solicitacao" required>
                                        <option value=""></option>
                                        <?php 
                                        $query ="SELECT id, descricao FROM `tiposolicitacao` WHERE status = 'ativo'";
                                        $result = $conn->query($query);
                                        if($result->num_rows> 0){
                                            while($optionData=$result->fetch_assoc()){
                                                $option =$optionData['descricao'];
                                                $option2 =$optionData['id'];
                                        ?>
                                        <?php
                                        //opção selecionada
                                        if(!empty($nome) && $nome== $option){
                                        ?>
                                        <option value="<?php echo $option2; ?>" selected><?php echo $option; ?> </option>
                                        <?php 
                                            continue;
                                        }?>
                                        <option value="<?php echo $option2; ?>" ><?php echo $option; ?> </option>
                                        <?php
                                            }}
                                        ?>
                                    </select>
                                </div>
                                <div class="col-6" id="div-procedimento">
                                    <select class="form-control" name="procedimento[]" id="procedimento" required>
                                        <option value=""></option>
                                        <?php 
                                        $query ="SELECT id, descricao FROM `procedimentos` WHERE status = 'ativo'";
                                        $result = $conn->query($query);
                                        if($result->num_rows> 0){
                                            while($optionData=$result->fetch_assoc()){
                                                $option =$optionData['descricao'];
                                                $option2 =$optionData['id'];
                                        ?>
                                        <?php
                                        //opção selecionada
                                        if(!empty($nome) && $nome== $option){
                                        ?>
                                        <option value="<?php echo $option2; ?>" selected><?php echo $option; ?> </option>
                                        <?php 
                                            continue;
                                        }?>
                                        <option value="<?php echo $option2; ?>" ><?php echo $option; ?> </option>
                                        <?php
                                            }}
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <strong>Data*</strong>
                                </div>
                                <div class="col">
                                    <strong>Hora*</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input class="form-control" name="data" type="date" id="data" required>
                                </div>
                                <div class="col">
                                    <input class="form-control" name="hora" type="time" id="hora" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button id="enviar" type="submit" class="btn">Salvar</button>
                            </div>
                        </form>
                    </div>

            <?php
                } else {
                    
                }
            ?>


        </div>
        <script src="../js/solicitacao.js" crossorigin="anonymous"></script>
    </body>
    </html>