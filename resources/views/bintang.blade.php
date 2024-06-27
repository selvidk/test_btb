<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soal 1</title>
</head>
<body>
    {{-- @php
        for ($a=0; $a < 5; $a++) { 
            for ($b=5; $b > $a; $b--) { 
                echo ' ';
            }

            // for ($c=0; $c < 5 ; $c++) { 
                echo '*';
            // }
            

            // for ($c=0; $c < $ ; $c++) { 
            //     # code...
            // }
            echo '</br>';
        }
    @endphp --}}
    <p>------------------------------------</p>
    @php
        for ($i=0; $i < 5; $i++) { 
            echo '*';

            for ($j=0; $j < $i ; $j++) { 
                echo '*';
            }
            echo '</br>';
        }
    @endphp   
</body>
</html>