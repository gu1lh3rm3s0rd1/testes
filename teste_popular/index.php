
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SELECT TCHEBA COM AJAX</title>
</head>
<body>

<form method="post" action="post.php">
    Categoria:
    <br>

    <select name="categoria" id="categoria" required>
        <option value="">SELECIONE UMA TCHEBA</option>
            <?php
                //acessa o banco de dados
                include 'con-techto.php';

                $sql = $conn->query("
                SELECT FIRST 5 NUMERO_PEDIDO 
                FROM AVEC8501 
                WHERE IMPRESSO_NF = 'S' 
                ORDER BY DATA_EMISSAO DESC
                ");
                //WHERE CODIGO_CLIENTE = '$cod' AND IMPRESSO_NF = 'S' 

                $registros = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach($registros as $option) {
                    //$op = $option['funcionario'];
            ?>
                <option value="<?php echo $option['NUMERO_PEDIDO'];?>"><?php echo $option['NUMERO_PEDIDO'];?></option>
            <?php
                }

            ?>
    </select>
    <br><br>

    Subcategoria:
    <br>

    <select name="subcategoria" id="subcategoria" required>
        <option value="">SELECIONE UMA SUBTCHEBA</option>
        
    </select>
    <br><br>

    <!--button type="submit">VAI TCHEBA</button-->
</form>

<script type="text/javascript">

    let selectCategoria = document.getElementById('categoria');

    selectCategoria.onchange = () => {
        let selectSubcategoria = document.getElementById('subcategoria');
        let valor = selectCategoria.value;

        fetch('select_subcategoria.php?categoria=' + valor)
            .then(
                response => {
                    return response.text();
                }
            )
            .then(
                texto => {
                    selectSubcategoria.innerHTML = texto;
                }
            );
    }

</script>
</body>
</html>