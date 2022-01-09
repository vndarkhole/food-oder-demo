<?php
$host = 'db_appBanHang';

// Database use name
$user = 'root';

//database user password
$pass = '123';

// database name
$mydatabase = 'appMuaHangDB';
// check the mysql connection status

$conn = new mysqli($host, $user, $pass, $mydatabase);


if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
    return;
}


function calNewHoaDonID()
{
    $link = mysqli_connect("db_appBanHang", "root", "123", "appMuaHangDB");

    $result = mysqli_query($link, "SELECT * FROM hoa_don");
    $num_rows = mysqli_num_rows($result);

    return $num_rows;
}


if (!$conn->connect_error) {
    // App will be posting these values to this server

    $data = json_decode(file_get_contents('php://input'), true);

    $danhsachmonan = $data["danhsachmonan"];

    $time = date_create('now')->format('Y-m-d');
    $sql = "INSERT INTO hoa_don (thoiGianGiaoDich) VALUES ('$time')";
    $result = $conn->query($sql);
    $id_HoaDon = calNewHoaDonID();

    for ($x = 0; $x < 9; $x++) {
        if ($danhsachmonan[$x]["soLuong"] > 0) {
            $soLuong = $danhsachmonan[$x]["soLuong"];
            $id = $danhsachmonan[$x]["id"];
            $sql = "INSERT INTO lich_su_giao_dich (id_hoaDon, id_sanPham, soLuong) VALUES 
            ('$id_HoaDon','$id',$soLuong)";
            $result = $conn->query($sql);
        }
    }
    $conn->close();
    return $danhsachmonan;
}
