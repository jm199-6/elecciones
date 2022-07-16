<script type="text/javascript">
	chTitle("Admin del Sistema - Consultas");
</script>
<script type="text/javascript">
    <?php
    $sqlCandidatos="select * from candidato";
    $resCandidatos= $conn->query($sqlCandidatos);
    $data = "";
    if ($resCandidatos->num_rows > 0) {
        while($row=$resCandidatos->fetch_assoc()){
            $sqlVotos = "SELECT COUNT(vc.dui_candidato) AS 'cant_votos', c.nombres AS 'nombres', c.apellidos AS `apellidos` FROM voto_candidato vc INNER JOIN candidato c ON (vc.dui_candidato = c.dui) WHERE vc.dui_candidato = '".$row['dui']."' order by cant_votos desc";

            $resVotos = $conn->query($sqlVotos);
            if($resVotos->num_rows > 0){
                $rowVotos = $resVotos->fetch_assoc();
								$dataArray[] = ["y" => $rowVotos['nombres'].' '.$rowVotos['apellidos'], "a" => $rowVotos['cant_votos']];
            }
        }
				$longitud = count($dataArray);
			    for ($i = 0; $i < $longitud; $i++) {
			        for ($j = 0; $j < $longitud - 1; $j++) {
			            if ($dataArray[$j]["a"] < $dataArray[$j + 1]["a"]) {
			                $temporal = $dataArray[$j];
			                $dataArray[$j] = $dataArray[$j + 1];
			                $dataArray[$j + 1] = $temporal;
			            }
			        }
			    }
				//$dataArray = rsort($dataArray);
				$data = json_encode($dataArray);
    }else{
      $data = '{
                  y: "No se encontraron resultados", a: 0, labelColor: "red"
              }';
    }
    //
    ?>
    $(function() {
			Morris.Bar({
					element: 'morris-bar-chart',
					data: <?php echo $data; ?>,
					xkey: 'y',
					ykeys: ['a'],
					labels: ['Votos'],
					hideHover: 'auto',
					grid: true,
					axes: true,
					resize: true,
					barColors: function (row, series, type) {
    if (type === 'bar') {
      var red = Math.ceil(255 * row.y / this.ymax);
      return 'rgb(' + red + ',0,0)';
    }else {
      return '#000';
    }
  }
			});
            /*Morris.Donut({
                element: 'morris-donut-chart',
                data: [<?php echo $data; ?>],
                labelColor: "#186b16",
                colors: ['#E53935', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)'],
                resize: true
            });*/

});
</script>
<div class="col-lg-7 col-md-7 col-sm-7">

    <div class="panel panel-default">

        <!-- /.panel-heading -->
        <div class="panel-body">
            <div id="morris-bar-chart"></div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<div class="col-lg-3 col-md-3 col-sm-5">
	<div class="list-group">
		<?php
		$sqlP = "select id_puesto, nombre_puesto from puesto";

		$resPuestos = $conn->query($sqlP);
		while($row=$resPuestos->fetch_assoc()){
				$dataPuestos[] = $row['nombre_puesto'];
		}
		for ($i=0; $i < count($dataPuestos) ; $i++) {

		 ?>
			<a href="#" class="list-group-item">
				<?php echo $dataPuestos[$i]; ?>
				<span class="pull-right text-muted small">
					<em><?php echo $dataArray[$i]["y"]; ?> </em>
					<span class="badge pull-right" style="margin-left:10px;"><?php echo $dataArray[$i]["a"]; ?></span>
				</span>
			</a>
			<?php
		} ?>
	</div>
</div>
