<?
    session_start();
    include("../inc/global.php");
    $sql_mod = "UPDATE cos SET ";
    $cant = "";
    $id_cos = $_REQUEST["idcos"];
    for ($j=0; $j<($_REQUEST["linii"]-1); $j++)
    {
        $id = "cant_".$id_cos."_".$j;
        $cant .= $_REQUEST[$id].",";
    }
    $id = "cant_".$id_cos."_".$j;
    $cant .= $_REQUEST[$id]."";
    $sql_mod .= "cantitati = '".$cant."' ";
    $sql_mod .= " WHERE id = ".$id_cos;
    @mysql_query($sql_mod) or die("<script>alert('Eroare la salvare modificari! ')</script>");
    echo "
    <script>
        alert(\"Modificarile au fost salvate cu succes!\");
        parent.location.href = 'adm_cosuri.php';
    </script>
    ";
?>