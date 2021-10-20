<!DOCTYPE html>
<!--
Elabora una aplicación que recoja síntomas de enfermedades (fiebre, dolor de cabeza, garganta, tos etc) 5 al menos. 
La aplicación emitirá un diagnostico y/o una prescripción (Jarabe, Pcr, Ibuprofeno etc). 
Se deberán al menos emitir 6 diagnósticos y/o prescripciones.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                font-family: Georgia, 'Times New Roman', Times, serif;
            }

            p {
                font-weight: bold;
                font-size: 18px;
            }

            div {
                border: 1px solid black;
                width: 50%;
                padding: 2%;
            }

            button {
                background-color: white;
                color: black;
                border: 2px solid #555555;
                border-radius: 10px;
                padding: 1%;
                transition-duration: 0.4s;
                cursor: pointer;
                display: block;
                width: 200px;
                margin: auto;
                font-family : inherit;
                font-size: inherit;
                margin-top: 10px;
            }

            button:hover {
                background-color: #555555;
                color: white;
            }

            input:hover {
                outline: 2px solid rgba(34,139,34, 0.5);
                cursor: pointer;
            }


        </style>
        <title>Aplicación de diagnóstico</title>
    </head>
    <body>
        <?php
        //Formulario:
        
        echo '<form action="index.php" method="post">';
        
        echo '<div>';
        echo '<p>Síntomas del enfermo:</p>';

        echo '<input value="fiebre" type="checkbox" name="fiebre" /> Fiebre +38 </br>';
        echo '<input value="huesos" type="checkbox" name="huesos" /> Dolor de huesos </br>';
        echo '<input value="garganta" type="checkbox" name="garganta" /> Dolor de garganta </br>';
        echo '<input value="cabeza" type="checkbox" name="cabeza" /> Dolor de cabeza </br>';
        echo '<input value="malestar" type="checkbox" name="malestar" /> Malestar general </br>';
        
        echo '<br/><button type="submit" name="submit">Obtener diagnóstico</button>';
        
        echo '</div>';
        echo '</form>';
        
        
        if (count ($_POST) > 0) {

            //Array de sintomas:

            $sintomas = [
                'fiebre',
                'huesos',
                'garganta',
                'cabeza',
                'malestar'
            ];
        
            //Recorrer array de síntomas totales, y comparar con síntomas del paciente, para obtener una clave:
            
            $stringSintomatologia = '';

            foreach($sintomas as $clave){
                
                if(isset($_POST[$clave])){
                    $stringSintomatologia = $stringSintomatologia . 'T';
                } else {
                    $stringSintomatologia = $stringSintomatologia . 'F';
                };
            }
                
            
            //Lista de claves de diagnósticos, y asignación a funciones:
            
            $claveDiagnostico = [
                'TTTTT' => function() {echo '<p>Usted debería hacerse una prueba PCR.</p>';}, 
                'FFFFF' => function() {echo '<p>Usted está bien.</p>';},
                'FFFTT' => function() {echo '<p>Usted necesita tomarse un descanso.</p>';}, 
                'FFFTF' => function() {echo '<p>Usted debería tomarse un ibuprofeno cada 8 horas.</p>';}, 
                'TTFTF' => function() {echo '<p>Probablemente, usted tenga gripe.</p>';},
                'FTFFT' => function() {echo '<p>Puede que esté incubando algo. <br/> Descanse y esté atento a los síntomas durante los siguientes días.</p>';},
                'otros' => function() {echo '<p>No hemos sido capaces de diagnosticarle. <br/> Usted debería consultar con un especialista.</p>';}
            ];
            
            
            //Si la clave de diagnóstico coincide con la sintomatología del usuario, le decimos al usuario cuál es su diagnóstico. Si la clave no está en el array, no conocemos el diagnóstico, y recomendamos al usuario acudir a un especialista.

            if(array_key_exists($stringSintomatologia, $claveDiagnostico)){
                echo $claveDiagnostico[$stringSintomatologia]();
            } else {
                echo $claveDiagnostico['otros']();
            };
                
        }
        
        ?>
    </body>
</html>
