<?php
session_start();
unset($_SESSION["inicio"]);
session_destroy();
echo "
		<script>
				location.href='../';
		</script>

	";
?>