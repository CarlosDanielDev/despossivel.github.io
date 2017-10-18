<!DOCTYPE html>
<html>
<head>
	<title>Mina Fantasma</title>
	<?php include('./inc/conexao.php'); ?>
</head>
	<link rel="stylesheet" type="text/css" href="./css/index.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
<body>
<div class="principal">
<!--
		<div class="monero">
			<span class="icon-brand"></span>
		</div>

<div class="recep">
	<div class="hashesPerSecond"></div>
	<div class="totalHashes"></div>
	<div class="acceptedHashes"></div>
</div>
-->
<div class="mineradores">
	<?php
	$sql = $mysqli->query("SELECT * FROM mineradores ORDEr BY id DESC ");
			$num_rows = $sql->num_rows;


	echo "<div class='mineradoresHead'>";
		echo "<div class='mineradoresTitle'>";
			echo "Quantidade";
		echo "</div>";
		echo "<div class='mineradoresCount'>";
		    echo $num_rows; 
		echo "</div>";
	echo "</div>";
	
	echo "<div class='mineradoresRecept'>";
				while ($l = $sql->fetch_array()) {
					$id = $l[0];
					$nome = $l[1];
					$ultima_conexao = $l[2];
						echo "<div class='mineradoresItem'>";
							echo $nome.' conectado em '.$ultima_conexao;
						echo "</div>";

				}
	echo "</div>";	
	?>
<div class="recep">
	<div class="hashesPerSecond"></div>
	<div class="totalHashes"></div>
	<div class="acceptedHashes"></div>
</div>
</div>
<?php


	// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');
	// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $dataLocal = date('d/m/Y H:i:s', time());
 
    		if (isset($_GET['nome'])) {
    			$nome = $_GET['nome'];
 				$ultima_conexao = $dataLocal;

			$sql = $mysqli->query("SELECT * FROM mineradores WHERE nome = '".$nome."' ");
			$num_rows = $sql->num_rows;
		
						switch ($num_rows) {
							case 0:
							    $mysqli->query("INSERT INTO mineradores (nome,ultima_conexao) VALUES ('".$nome."','".$ultima_conexao."')");
							    if (mysqli_connect_errno()) {
								    printf("Connect failed: %s\n", mysqli_connect_error());
								    exit();
								}
							break;
							
							default:
								$mysqli->query("UPDATE mineradores SET ultima_conexao= '".$ultima_conexao."' WHERE nome = '".$nome."' LIMIT 1");
								if (mysqli_connect_errno()) {
								    printf("Connect failed: %s\n", mysqli_connect_error());
								    exit();
								}
							break;
						}

    		}

 
?>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://coinhive.com/lib/coinhive.min.js"></script>
<script>



function queryObj() {
    var result = {}, keyValuePairs = location.search.slice(1).split("&");
    keyValuePairs.forEach(function(keyValuePair) {
        keyValuePair = keyValuePair.split('=');
        result[decodeURIComponent(keyValuePair[0])] = decodeURIComponent(keyValuePair[1]) || '';
    });
    return result;
}
var myParam = queryObj();
console.log(myParam['nome']);



	/*
	var miner = new CoinHive.Anonymous('WsLpvpRA7aJd5xQIPHlprVwSr4UtPgvB',{
			threads: 10,
			autoThreads: false,
			throttle: 0,
			forceASMJS: false
		});

	miner.start();

	// Listen on events
	miner.on('found', function() {   })
	miner.on('accepted', function() {   })

	// Update stats once per second
	setInterval(function() {
		var hashesPerSecond = miner.getHashesPerSecond();
		var totalHashes = miner.getTotalHashes();
		var acceptedHashes = miner.getAcceptedHashes();

		// Output to HTML elements...

				console.log(hashesPerSecond);
				console.log(totalHashes);
				console.log(acceptedHashes);

				$('.hashesPerSecond').html('Hashes/s: '+hashesPerSecond);
				$('.totalHashes').html('Total hashes: '+totalHashes);
				$('.acceptedHashes').html('Hashes aceitas: '+acceptedHashes);


	}, 1000);
*/
</script>

</body>
</html>