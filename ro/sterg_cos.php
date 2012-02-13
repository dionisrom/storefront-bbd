<?
    session_start();
    include("../inc/global.php");
    $sql_sterg = "DELETE FROM cos WHERE id = ".$_REQUEST["idcos"];
    mysql_query($sql_sterg) or die("<script>alert('Eroare la stergere cos! ".mysql_error()."')</script>");
    echo "
    <script>
        alert('Stergerea a fost efectuata cu succes!');
        parent.location.href = 'adm_cosuri.php';
    </script>
    ";
?>