<?php
//These are the defined authentication environment in the db service

// The MySQL service named in the docker-compose.yml.
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
function caltotalHoaDon()
{
    $link = mysqli_connect("db_appBanHang", "root", "123", "appMuaHangDB");

    $result = mysqli_query($link, "SELECT * FROM hoa_don");
    $num_rows = mysqli_num_rows($result);

    return $num_rows;
}

if (!$conn->connect_error){
    $totalHoaDon = caltotalHoaDon();
    echo "BAO CAO HOA DON CHI TIET <br>";
    for ($x = 1; $x <= $totalHoaDon; $x++){
        echo "Hoa don: ". $x . "<br>"; 
        $query = "SELECT * FROM lich_su_giao_dich where id_hoaDon = $x";
        $result = $conn->query($query);
        $tongtien = 0;
        echo "Danh sach san pham: <br>";
        while($row = mysqli_fetch_array($result)){
            $queryTenSanPham = "SELECT tenSanPham FROM san_pham where id = ".$row['id_sanPham'];
            $getName = $conn->query($queryTenSanPham);
            $name = mysqli_fetch_array($getName);
            echo "------".$name['tenSanPham'] ." :  ".$row['soLuong'] . "<br>";
            $queryGiaSanPham = "SELECT giaTien FROM san_pham where id = ".$row['id_sanPham'];
            $getTien = $conn->query($queryGiaSanPham);
            $tien = mysqli_fetch_array($getTien);
            $tongtien = $tongtien + $tien['giaTien'] * $row['soLuong'];
    }
    echo "Tong tien: $tongtien  VND <br>";
    echo "----------------------------------------------- <br>";

}
echo "</table>"; 

}

?>
