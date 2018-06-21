<?php
			require("includes/conexion.php");

      $busqueda="select nacionalidad,
			sum(case when genero like '%F%' then 1 else 0 end) as Femenino,
			sum(case when genero like '%M%' then 1 else 0 end) as Masculino,
			count('%M%'+'%F%') as Total
			from graduat3s
			where genero like '%F%' OR genero like '%M%'
			group by nacionalidad
			ORDER BY nacionalidad ASC";

      $resultado = $mysqli->query($busqueda);

        echo '
         <table class="striped centered">
          <thead>
            <tr>
                <th>PAÍS</th>
                <th>FEMENINO</th>
                <th>MASCULINO</th>
                <th>TOTAL</th>
            </tr>
            <tr>
          </thead>
          <tbody>
           ';
        ?><div>

      <?php
      echo '<div class=" ">
            <div class="row">';
      $totalgraduados=0;
      $sumatotalm=0;
      $sumatotalf=0;
      while($f=$resultado->fetch_assoc()){
					$sumaHombre=$f['Masculino'];
					$sumaMujeres=$f['Femenino'];
          $suma=$f['Total'];
          $sumatotalm=$sumatotalm+$f['Masculino'];
          $sumatotalf=$sumatotalf+$f['Femenino'];
          $totalgraduados=$totalgraduados+$f['Femenino']+$f['Masculino'];
    echo '
        <tr>
        <td align="centered" >'.$f['nacionalidad'].'</td>
        <td align="centered">'.$sumaHombre.'</td>
        <td align="centered">'.$sumaMujeres.'</td>
        <td align="centered">'.$suma.'</td>
        </tr>
        ';}
     echo '
        <thead>
        <tr>
          <th align="centered"><strong>TOTAL</strong></th>
          <th align="centered"><strong>'.$sumatotalf.'</strong></th>
          <th align="centered"><strong>'.$sumatotalm.'</strong></th>
          <th align="centered"><strong>'.$totalgraduados.'</strong></th>
        </tr>
          </thead>
  </tr></table></tbody>';
?>
