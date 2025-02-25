<?php
$koneksi =mysqli_connect("localhost","root","SQL2016SJ08","db_she");

if (mysqli_connect_error()){
    echo "koneksi gagal:". mysqli_connect_error();
}
?>