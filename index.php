<?php
    include 'database.php';
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
        <link rel="stylesheet" href="css/paciente.css">
        <title>Clínica</title>
    </head>
    <header>

    </header>
    <body>
        <div class="container">
            <h1 class="my-3">Lista de pacientes</h1>

            <form action="" method="GET" class="mb-3">
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="pesquisar" id="pesquisar" placeholder="Pesquisar" class="form-control">
                    </div>
                    <div class="col-2">
                        <button id="enviar" type="submit" class="btn">Procurar</button>
                    </div>
                </div>
            </form>
                
            <table class="table table-striped table-borderless shadow my-5 text-center">
                <thead>
                    <tr id="header">
                        <th>Nome</th>
                        <th>Data de nascimento</th>
                        <th>CPF</th>
                        <th>Solicitação</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                        $page_no = $_GET['page_no'];
                    } else {
                        $page_no = 1;
                    }
                
                    $total_pacientes_pagina = 10;
                    $deslocamento = ($page_no-1) * $total_pacientes_pagina;
                    $pagina_anterior = $page_no - 1;
                    $proxima_pagina = $page_no + 1;
                    $adjacentes = "2"; 
                    
                    if (isset($_GET['pesquisar']) && $_GET['pesquisar']!="") {
                        $pesquisar = $_GET['pesquisar'];
                        $resultado_contagem = mysqli_query($conn,"SELECT COUNT(*) AS registros_totais FROM `pacientes` WHERE (nome LIKE '%$pesquisar%' OR CPF LIKE '%$pesquisar%') AND status = 'ativo'");
                    }else{
                        $resultado_contagem = mysqli_query($conn,"SELECT COUNT(*) AS registros_totais FROM `pacientes` WHERE status = 'ativo'");
                    }

                    $registros_totais = mysqli_fetch_array($resultado_contagem);
                    $registros_totais = $registros_totais['registros_totais'];
                    $num_total_paginas = ceil($registros_totais / $total_pacientes_pagina);
                    $penultimo = $num_total_paginas - 1; // total de páginas -1

                    
                    if (isset($_GET['pesquisar']) && $_GET['pesquisar']!="") {
                        $result = mysqli_query($conn,"SELECT * FROM `pacientes` WHERE (nome LIKE '%$pesquisar%' OR CPF LIKE '%$pesquisar%') AND status = 'ativo' LIMIT $deslocamento, $total_pacientes_pagina");
                    }else{
                        $result = mysqli_query($conn,"SELECT * FROM `pacientes` WHERE status = 'ativo' LIMIT $deslocamento, $total_pacientes_pagina");
                    }
                    
                    while($row = mysqli_fetch_array($result)){
                        $data_nasc = date("d/m/Y", strtotime($row['dataNasc']));
                        echo "
                            <tr>
                                <td>".$row['nome']."</td>
                                <td>".$data_nasc."</td>
                                <td>".$row['CPF']."</td>
                                <td><a class='btn' href='solicitacoes/index.php?id=".$row['id']."' role='button'>Clique aqui!</a></td>
                            </tr>
                            ";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
            

            <ul class="pagination justify-content-center">
        
            <li <?php if($page_no <= 1){ echo "class='disabled page-item'"; } else { echo "class='page-item'";}?>>
                <a <?php if($page_no > 1){ echo "class='page-link' href='?page_no=$pagina_anterior'"; } else { echo "class='page-link'";}?>>Anterior</a>
            </li>
        
            <?php 
                if ($num_total_paginas <= 10){  	 
                    for ($counter = 1; $counter <= $num_total_paginas; $counter++){
                        if ($counter == $page_no) {
                            echo "<li class='active page-item'><a class='page-link'>$counter</a></li>";	
                        }else{
                            echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                }
                elseif($num_total_paginas > 10){
                    
                    if($page_no <= 4) {			
                        for ($counter = 1; $counter < 8; $counter++){		 
                            if ($counter == $page_no) {
                                echo "<li class='active'><a class='page-link'>$counter</a></li>";	
                            }else{
                                echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                        echo "<li><a class='page-link'>...</a></li>";
                        echo "<li><a class='page-link' href='?page_no=$penultimo'>$penultimo</a></li>";
                        echo "<li><a class='page-link' href='?page_no=$num_total_paginas'>$num_total_paginas</a></li>";
                    }
                    elseif($page_no > 4 && $page_no < $num_total_paginas - 4) {		 
                        echo "<li><a class='page-link' href='?page_no=1'>1</a></li>";
                        echo "<li><a class='page-link' href='?page_no=2'>2</a></li>";
                        echo "<li><a class='page-link'>...</a></li>";
                        for ($counter = $page_no - $adjacentes; $counter <= $page_no + $adjacentes; $counter++) {			
                            if ($counter == $page_no) {
                                echo "<li class='active'><a class='page-link'>$counter</a></li>";	
                            }else{
                                echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }                  
                        }
                        echo "<li><a class='page-link'>...</a></li>";
                        echo "<li><a class='page-link' href='?page_no=$penultimo'>$penultimo</a></li>";
                        echo "<li><a class='page-link' href='?page_no=$num_total_paginas'>$num_total_paginas</a></li>";      
                    }
                    else{
                        echo "<li><a class='page-link' href='?page_no=1'>1</a></li>";
                        echo "<li><a class='page-link' href='?page_no=2'>2</a></li>";
                        echo "<li><a class='page-link'>...</a></li>";

                        for ($counter = $num_total_paginas - 6; $counter <= $num_total_paginas; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='active'><a class='page-link'>$counter</a></li>";	
                            }else{
                                echo "<li><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                            }                   
                        }
                    }
                }
            ?>
        
            <li <?php if($page_no >= $num_total_paginas){ echo "class='disabled' 'page-item'"; } else { echo "class='page-item'";} ?>>
                <a <?php if($page_no < $num_total_paginas) { echo  "class='page-link' href='?page_no=$proxima_pagina'"; } else { echo "class='page-link'";}?>>Próximo</a>
            </li>
            <?php if($page_no < $num_total_paginas){
                echo "<li><a class='page-link' href='?page_no=$num_total_paginas'>Último &rsaquo;&rsaquo;</a></li>";
            } ?>

            </ul>
        </div>
    </body>
    </html>