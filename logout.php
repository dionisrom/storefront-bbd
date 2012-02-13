<?php 
session_start();
//session_destroy();
session_unregister("user");
session_unregister("id_user");
session_unregister("nume");
session_unregister("mesaj_auth");
session_unregister("id");
session_unregister("auth");
session_unregister("tipusr");
session_unregister("merge");
echo "
<script>
	top.location.href='index.php';
</script>
";
?>