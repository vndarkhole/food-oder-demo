CREATE DATABASE appMuaHangDB CHARACTER SET utf8;
USE appMuaHangDB;
CREATE TABLE san_pham (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tenSanPham VARCHAR(30) NOT NULL,
giaTien INT UNSIGNED NOT NULL);

CREATE TABLE hoa_don (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
thoiGianGiaoDich DATE
);

CREATE TABLE lich_su_giao_dich (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id_hoaDon INT UNSIGNED not null,
id_sanPham INT UNSIGNED not null,
soLuong INT UNSIGNED Not NULL,
FOREIGN KEY (id_hoaDon) REFERENCES hoa_don (id),
FOREIGN KEY (id_sanPham) REFERENCES san_pham(id)
);

INSERT INTO san_pham (id, tenSanPham, giaTien) VALUES (1, 'banhchocolate',120000);
INSERT INTO san_pham (tenSanPham, giaTien) VALUES ('banhkemtranchau',120000);
INSERT INTO san_pham (tenSanPham, giaTien) VALUES ('banhkepnuong',120000);
INSERT INTO san_pham (tenSanPham, giaTien) VALUES ('banhkemque',120000);
INSERT INTO san_pham (tenSanPham, giaTien) VALUES ('1latbanhkemdau',120000);
INSERT INTO san_pham (tenSanPham, giaTien) VALUES ('bo5banhkemdau',120000);
INSERT INTO san_pham (tenSanPham, giaTien) VALUES ('cafe',120000);
INSERT INTO san_pham (tenSanPham, giaTien) VALUES ('cacaodaxay',120000);
INSERT INTO san_pham (tenSanPham, giaTien) VALUES ('sodaduahau',120000);
INSERT INTO hoa_don(id, thoiGianGiaoDich) VALUES (1,'2012-12-31');
INSERT INTO lich_su_giao_dich (id, id_hoaDon, id_sanPham, soLuong) VALUES (1, 1,2,9);

