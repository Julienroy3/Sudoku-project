<?php
include("connect.php");
session_start();

require 'header.php';
require 'menu.php';

if (isset($_SESSION['IdUser'])) {
	# code...
	$rep = $bdd->prepare("SELECT DateResolu, TempsResolu, Niveau FROM Preformances WHERE IdUser = :IdUser");
	$rep->bindParam(":IdUser", $_SESSION['IdUser'], PDO::PARAM_INT);
	$rep->execute();
?>


?>
	<div id="tableauPerf">
		<table>
			<caption>Mes Perfs</caption>

			<thead>
				<tr>
					<th>Date</th>
					<th>Temps</th>
					<th>Niveau</th>
				</tr>
			</thead>

			<tbody>
				
<?php
				while ($data = $rep->fetch()) {
					# code...
					echo "<tr>";
					echo "<td>" . $data['DateResolu'] . "</td>";
					echo "<td>" . $data['TempsResolu'] . "</td>";
					echo "<td>" . $data['Niveau'] . "</td>";
					echo "<tr>";

				}
?>

			</tbody>

			<tfoot>
				<tr>
					<th>Date</th>
					<th>Temps</th>
					<th>Niveau</th>
				</tr>
			</tfoot>

		</table>
	</div>

<?php
	
} else {
	# code...
	var_dump($_SESSION['IdUser']);
	die();
}

?>