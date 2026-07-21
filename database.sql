-- =====================================================
-- Database: db_barang
-- Table: barang
-- Inventory Barang - PHP Native CRUD
-- =====================================================

CREATE DATABASE IF NOT EXISTS barang_db
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE barang_db;

-- -----------------------------------------------------
-- Table: barang
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS barang (
  id          INT(11) NOT NULL AUTO_INCREMENT,
  nama_barang VARCHAR(100) NOT NULL,
  kategori    VARCHAR(100) NOT NULL,
  harga       INT(11) NOT NULL DEFAULT 0,
  stok        INT(11) NOT NULL DEFAULT 0,
  created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------
-- Sample Data
-- -----------------------------------------------------
INSERT INTO barang (nama_barang, kategori, harga, stok) VALUES
('Laptop Asus ROG',     'Elektronik', 15000000, 5),
('Mouse Logitech G502', 'Aksesoris',   500000,  15),
('Keyboard Mechanical', 'Aksesoris',  750000,  10),
('Monitor LG 24 inch',  'Elektronik', 2500000, 8),
('Flashdisk 32GB',      'Penyimpanan', 120000,  50),
('Headset Gaming',      'Aksesoris',  450000,  12);
