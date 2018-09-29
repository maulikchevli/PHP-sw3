<?php
session_start();

$student = $_SESSION['student'];
$courseDetails = $student->getRegistrationDetails( $student->getRollNum());
?>

<h3>Course Registration Details</h3>

<a href="editRegistration.html.php" class="btn">
	Edit
</a>

<table class="table">
	<tr>
		<th scope="row">Elective</th>
		<td><?php echo $courseDetails['elective']; ?></td>
	</tr>

	<tr>
		<th scope="row">Club</th>
		<td><?php echo $courseDetails['club']; ?></td>
	</tr>
</table>

