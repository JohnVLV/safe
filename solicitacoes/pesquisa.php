<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
    include("../database.php");
    $q = intval($_GET['q']);
    $s = intval($_GET['s']);
    if($q == 1){
        ?>
        <select class="form-control" name="procedimento[]" id="procedimento">
        <?php
    }else
    if($q == 2){
        ?>
        <select class="form-control" name="procedimento[]" id="procedimento" multiple required>
        <?php
    }
?>
    
            <option value=""></option>
        <?php
        $query = "SELECT procedimentos.id, procedimentos.descricao, profissional.nome FROM procedimentos 
        INNER JOIN profissionalatende ON profissionalatende.procedimento_id = procedimentos.id
        INNER JOIN profissional ON profissionalatende.profissional_id = profissional.id
        WHERE profissionalatende.status = 'ativo' AND profissional.id = $s AND procedimentos.tipo_id = $q";
        $result = $conn->query($query);
        if($result->num_rows> 0){
            while($optionData=$result->fetch_assoc()){
                $option = $optionData['descricao'];
                $option2 = $optionData['id'];
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

</body>
</html>