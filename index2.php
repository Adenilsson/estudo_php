<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $cor =0;
     for ($r=1; $r <= 255; $r+=3) {
        if($r<=9){
            $r ="0".$r;
        }
        for ($g=1; $g<= 255 ; $g+=5) { 
            if($g<=9){
                $g ="0".$g;
            }
           for ($b=1; $b <= 255; $b+=10) { 
            if($b<=9){
                $b = "0".$b;
            }
            $cor ="rgb(".$r.",".$g.",".$b.")";
            echo "<input  style='background-color:$cor; type=submt; height:20px; width:120px;'  value=$cor>";
           }
        }
        
        }
            
    ?>
   <input type="text" styly="backgrund-color: 
</body>
</html>