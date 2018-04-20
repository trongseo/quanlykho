<?php
/**
 * Created by PhpStorm.
 * User: sba010
 * Date: 4/11/2018
 * Time: 9:54 AM
 */


if (isset($_REQUEST['idwarehouse'])) {
    $search = addslashes($_GET['search']);
    if (empty($search)) {
        echo "Yeu cau nhap du lieu vao o trong";
    } else {
        // Phan dung vong lap while show du lieu
    }
}
?>
<form action="search.php" method="get">
    Search: <input type="text" name="search" />
                        <input type="submit" name="ok" value="search" />
                    </form>