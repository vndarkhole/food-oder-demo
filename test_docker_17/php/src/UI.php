<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dang's Store Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
    <?php
  $css_File = file_get_contents("css/style.css"); 
  echo '<style type="text/css">' . $css_File . '</style>'; // All php echo example
  ?>
  <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/a46b7b6629.js" crossorigin="anonymous"></script>
  <style type="text/css">
    table{
        border-collapse: collapse;
        width:100%;
        color:var(--main-color);
        font-family: monospace;
        font-size:20px;
        text-align: center;
      }
    th{
        background-color: var(--main-color);
        color:white;
      }
  </style>
</head>
<body>  
  <div class="content">
    
    <header>
      <p><label for="menu"><span class="fa fa-bars"></span></label><span class="accueil">Dashboard</span></p>

      <div class="search-wrapper">
        <span class="fa fa-search"></span>
        <input type="search" name="" placeholder="research" />
      </div>

      <div class="user-wrapper" id="dropdown">
        <div>
          <h4>Dang</h4>
          <small>zZBOSSZz</small>
        </div>
        
        <img src="Boss.jpg" width="30" height="30" class="logo-admin">
        <div class="dropdown-content">
        </div>
        
      </div>
    </header>
<!------------------------------------------------------------------------------------------------------------------------------>
    <main>
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
    ?>
      <div class="cards">
        <div class="card-single">
           <?php 
             $sql = "SELECT sum(san_pham.giaTien * lich_su_giao_dich.soLuong) AS total FROM san_pham JOIN lich_su_giao_dich 
             ON san_pham.id = lich_su_giao_dich.id_sanPham";
             $res = mysqli_query($conn,$sql);
             $total = mysqli_fetch_assoc($res);
             $total_money = $total['total'];
             ?>
          <div>
            <h2><?php echo $total_money ?> </h2>
            <small>Income</small>
          </div>
          <div>
            <span class="fas fa-coins"></span>
          </div>
        </div>

        <div class="card-single">
            <?php 
            //Mysql Query
            $sql1 ="SELECT * FROM hoa_don";
            //Excute Query
            $res1 = mysqli_query($conn, $sql1);
            //Count Rows
            $count1 = mysqli_num_rows($res1);
            ?>
          <div>
            <h2><?php echo $count1; ?></h2>
            <small>Bill</small>
          </div>
          <div>
            <span class="far fa-handshake"></span>
          </div>
        </div>
        <div class="card-single">

         <?php 
           //Mysql Query
           $sql2 ="SELECT * FROM san_pham";
           //Excute Query
           $res2 = mysqli_query($conn, $sql2);
           //Count Rows
           $count2 = mysqli_num_rows($res2);
         ?>

          <div>
            <h2><?php echo $count2; ?></h2>
            <small>Menu</small>
          </div>
          <div>
            <span class="fas fa-utensils"></span>
          </div>
        </div>
        </div>

<!------------------------------------------------------------------------------------------------------------------------------>

<!------------------------------------------------------------------------------------------------------------------------------>
        <div class="tabContainer">

                  <div class="buttonContainer">
                      <button onclick="showPanel(0)">Menu</button>
                      <button onclick="showPanel(1)">Bill</button>
                      <button onclick="showPanel(2)">History</button>
                      <button onclick="showPanel(3)">Details</button>
                  </div>
                  <div class="tabPanelContainer">
                      <div class="tabPanel">         
                            <div class="tabsub">
                              <table>
                                <tr>
                                  <th>ID Sản Phẩm</th>
                                  <th>Tên</th>
                                  <th>Giá Tiền</th>
                                </tr>
                                <?php
                                 $sql3 = "SELECT id, tenSanPham, giaTien FROM san_pham";
                                 $res3 = $conn-> query($sql3);
                                 if($res3-> num_rows > 0) {
                                   while ($row = $res3-> fetch_assoc()){
                                     echo "<tr><td>".$row["id"]."</td><td>". $row["tenSanPham"]."</td><td>".$row["giaTien"]."</td></tr>";
                                   }
                                 }
                                 else {
                                   echo"0 result";
                                 }
                                ?>
                              </table>

                              </div>             
                        </div>
                        <div class="tabPanel">         
                            <div class="tabsub">
                              <table>
                                <tr>
                                  <th>ID Hoá Đơn</th>
                                  <th>Thời gian xuất hoá đơn</th>
                                </tr>
                                <?php
                                 $sql4= "SELECT id, thoiGianGiaoDich FROM hoa_don";
                                 $res4 = $conn-> query($sql4);
                                 if($res4-> num_rows > 0) {
                                   while ($row = $res4-> fetch_assoc()){
                                     echo "<tr><td>".$row["id"]."</td><td>". $row["thoiGianGiaoDich"]."</td></tr>";
                                   }
                                 }
                                 else {
                                   echo"0 result";
                                 }
                                ?>
                              </table>

                            </div>             
                        </div>
                        <div class="tabPanel">         
                            <div class="tabsub">
                              <table>
                                <tr>
                                  <th>ID Giao Dịch</th>
                                  <th>ID Hoá Đơn</th>
                                  <th>ID Sản Phẩm</th>
                                  <th>Số lượng sản phẩm</th>
                                </tr>
                                <?php
                                 $sql5= "SELECT id, id_hoaDon, id_sanPham, soLuong FROM lich_su_giao_dich";
                                 $res5 = $conn-> query($sql5);
                                 if($res5-> num_rows > 0) {
                                   while ($row = $res5-> fetch_assoc()){
                                     echo "<tr><td>".$row["id"]."</td><td>". $row["id_hoaDon"]."</td><td>".$row["id_sanPham"]."</td><td>".$row["soLuong"]."</td></tr>";
                                   }
                                 }
                                 else {
                                   echo"0 result";
                                 }
                                ?>
                              </table>

                            </div>             
                        </div>
                        <div class="tabPanel">
                            <div class="tabsub"> 
                                  <?php                    
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
                            </div>
                      </div>
                      </div>
                  </div>
            </div>
<!------------------------------------------------------------------------------------------------------------------------------>
    </main>
    <script src="java.js"></script>
  </div>
</body>
</html>