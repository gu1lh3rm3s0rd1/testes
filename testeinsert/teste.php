<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TESTE</title>
</head>
<body>

<form method="POST">
<input type="text" name="nome">
<input type="text" name="email">
<input type="text" name="assunto">
<input type="text" name="mensagem">
<input type="submit">
</form>

<?php

function db_build_insert($table,$array)
{

   $str = "insert into $table ";
   $strn = "(";
   $strv = " VALUES (";
   while(list($name,$value) = each($array)) {

       if(is_bool($value)) {
                $strn .= "$name,";
                $strv .= ($value ? "true":"false") . ",";
                continue;
        };

       if(is_string($value)) {
                $strn .= "$name,";
                $strv .= "'$value',";
                continue;
        }
       if (!is_null($value) and ($value != "")) {
                $strn .= "$name,";
                $strv .= "$value,";
                continue;
       }
   }
   $strn[strlen($strn)-1] = ')';
   $strv[strlen($strv)-1] = ')';
   $str .= $strn . $strv;
   return $str;

}

?>

</body>
</html>