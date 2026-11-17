CREATE DATABASE IF NOT EXISTS kuliner_sukabumi CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kuliner_sukabumi;

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS kuliner (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  kategori VARCHAR(50) NOT NULL,
  lokasi VARCHAR(150) NOT NULL,
  deskripsi TEXT,
  harga VARCHAR(50),
  jam_buka VARCHAR(50),
  maps_link VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (username, password) VALUES ('admin', '$2y$10$cnVyXLtjaxY18C7f4iJEfeSqfVpj5bMpgaopZ0yOPdltemqSTRHhW');

INSERT INTO kuliner (nama, kategori, lokasi, deskripsi) VALUES
('Sate Taichan Foodcourt Kantor Pos','Sate','Foodcourt Kantor Pos, Sukabumi','Sate taichan tanpa bumbu kacang, disajikan dengan sambal pedas. Rekomendasi jajan malam di area Kantor Pos.'),
('Mie Acoy','Mie','Sukabumi','Mie rekomendasi warga Sukabumi. Lengkapi alamat dan jam buka lewat halaman admin.'),
('Ayam Bakar Terminal Lama','Ayam & Bebek','Terminal Lama, Sukabumi','Ayam bakar langganan di sekitar Terminal Lama.'),
('Kwetiaw Golkar','Nasi & Kwetiaw','Area Golkar, Sukabumi','Kwetiaw goreng dan kuah yang jadi incaran jajan malam.'),
('Sate Madura Seberang Kopken Perana','Sate','Seberang Kopken Perana, Sukabumi','Sate Madura dengan bumbu kacang khas, dekat Kopken Perana.'),
('Bebek Bumbu Ireng Jalur','Ayam & Bebek','Jalur, Sukabumi','Bebek dengan bumbu hitam khas yang gurih dan pedas.'),
('Mie Ayam Jakarta Nyomplong','Mie','Nyomplong, Sukabumi','Mie ayam gaya Jakarta di kawasan Nyomplong.'),
('Cuankie Amir','Cuankie','Sukabumi','Cuankie hangat dengan kuah gurih, cocok untuk cuaca dingin Sukabumi.'),
('Cuankie Bang Epri','Cuankie','Sukabumi','Cuankie dengan isian lengkap dan sambal pedas.'),
('Pecel Podomoro Brawijaya','Pecel','Podomoro, Jl. Brawijaya, Sukabumi','Pecel dengan bumbu kacang, favorit untuk sarapan.'),
('Pecel Baros','Pecel','Baros, Sukabumi','Pecel di kawasan Baros dengan sayur segar dan bumbu kacang.'),
('Nasi Goreng Latip','Nasi & Kwetiaw','Sukabumi','Nasi goreng gerobakan dengan aroma wajan yang khas.'),
('Pempek Tanjakan Ciaul','Pempek','Tanjakan Ciaul, Sukabumi','Pempek dengan cuko asam manis pedas.');
