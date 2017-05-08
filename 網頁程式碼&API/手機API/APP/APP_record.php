<?php

$record = "localhost";
$username = "nhu1403";
$password = "XWXKM188";
$database = "nhu1403";

mysql_connect($record, $username, $password) or die("<h1>Connection Error : </h1>" . mysql_error());
mysql_select_db($database) or die("<h1>Database Error : </h1>" . mysql_error());

@$operasi = $_GET['operasi'];

switch ($operasi) {
    case "view":
        /* Source code untuk Menampilkan Biodata */

        $query_tampil_biodata = mysql_query("SELECT * FROM record") or die(mysql_error());
        $data_array = array();
        while ($data = mysql_fetch_assoc($query_tampil_biodata)) {
            $data_array[] = $data;
        }
        echo json_encode($data_array);

        //print json_encode($data_array);
        //[{"id":"1","nama":"Jhohannes H Purba","alamat":"Kabanjahe"},{"id":"2","nama":"Berkat Junaidi Banurea","Alamat":"Sidikalang"},{"id":"3","nama":"Totok BluesMan Silalahi","Alamat":"Medan"}]

        break;
    case "insert":
        /* Source code untuk Insert data */
        @$nama = $_GET['nama'];
        @$alamat = $_GET['alamat'];
        $query_insert_data = mysql_query("INSERT INTO record (nama, alamat) VALUES('$nama', '$alamat')");
        if ($query_insert_data) {
            echo "Data Berhasil Disimpan";
        } else {
            echo "Error Inser Biodata " . mysql_error();
        }

        break;
    case "get_biodata_by_id":
        /* Source code untuk Edit data dan mengirim data berdasarkan id yang diminta */
        @$id = $_GET['id'];

        $query_tampil_biodata = mysql_query("SELECT * FROM record WHERE id='$id'") or die(mysql_error());
        $data_array = array();
        $data_array = mysql_fetch_assoc($query_tampil_biodata);
        echo "[" . json_encode($data_array) . "]";


        break;
    case "update":
        /* Source code untuk Update Biodata */
        @$nama = $_GET['nama'];
        @$alamat = $_GET['alamat'];
        @$id = $_GET['id'];
        $query_update_biodata = mysql_query("UPDATE record SET nama='$nama', alamat='$alamat' WHERE id='$id'");
        if ($query_update_biodata) {
            echo "Update Data Berhasil";
        } else {
            echo mysql_error();
        }
        break;
    case "delete":
        /* Source code untuk Delete Biodata */
        @$id = $_GET['id'];
        $query_delete_biodata = mysql_query("DELETE FROM record WHERE id='$id'");
        if ($query_delete_biodata) {
            echo "Delete Data Berhasil";
        } else {
            echo mysql_error();
        }

        break;

    default:
        break;
}
?>