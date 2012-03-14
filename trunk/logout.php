<?php 
session_start();
unset($_SESSION["user"]);
unset($_SESSION["id_user"]);
unset($_SESSION["nume"]);
unset($_SESSION["mesaj_auth"]);
unset($_SESSION["id"]);
unset($_SESSION["auth"]);
unset($_SESSION["tipusr"]);
unset($_SESSION["merge"]);
echo "
<script>
	top.location.href='index.php';
</script>
";
?>