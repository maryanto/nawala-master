/*
Navicat MySQL Data Transfer

Source Server         : Database-Lokal
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_nawala

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-04-02 12:47:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `r_bagian`
-- ----------------------------
DROP TABLE IF EXISTS `r_bagian`;
CREATE TABLE `r_bagian` (
  `ID_BAGIAN` int(5) NOT NULL AUTO_INCREMENT,
  `NM_BAGIAN` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_BAGIAN`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


-- ----------------------------
-- Table structure for `r_bulan`
-- ----------------------------
DROP TABLE IF EXISTS `r_bulan`;
CREATE TABLE `r_bulan` (
  `KD_BULAN` char(2) NOT NULL,
  `NM_BULAN` varchar(15) NOT NULL,
  PRIMARY KEY (`KD_BULAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of r_bulan
-- ----------------------------
INSERT INTO `r_bulan` VALUES ('01', 'Januari');
INSERT INTO `r_bulan` VALUES ('02', 'Februari');
INSERT INTO `r_bulan` VALUES ('03', 'Maret');
INSERT INTO `r_bulan` VALUES ('04', 'April');
INSERT INTO `r_bulan` VALUES ('05', 'Mei');
INSERT INTO `r_bulan` VALUES ('06', 'Juni');
INSERT INTO `r_bulan` VALUES ('07', 'Juli');
INSERT INTO `r_bulan` VALUES ('08', 'Agustus');
INSERT INTO `r_bulan` VALUES ('09', 'September');
INSERT INTO `r_bulan` VALUES ('10', 'Oktober');
INSERT INTO `r_bulan` VALUES ('11', 'November');
INSERT INTO `r_bulan` VALUES ('12', 'Desember');

-- ----------------------------
-- Table structure for `r_jenis_srt_keluar`
-- ----------------------------
DROP TABLE IF EXISTS `r_jenis_srt_keluar`;
CREATE TABLE `r_jenis_srt_keluar` (
  `ID_JENIS_SRT_KELUAR` int(5) NOT NULL AUTO_INCREMENT,
  `NM_JENIS_SRT_KELUAR` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_JENIS_SRT_KELUAR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of r_jenis_srt_keluar
-- ----------------------------

-- ----------------------------
-- Table structure for `r_jenis_srt_masuk`
-- ----------------------------
DROP TABLE IF EXISTS `r_jenis_srt_masuk`;
CREATE TABLE `r_jenis_srt_masuk` (
  `ID_JENIS_SRT_MASUK` int(5) NOT NULL AUTO_INCREMENT,
  `NM_JENIS_SRT_MASUK` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_JENIS_SRT_MASUK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of r_jenis_srt_masuk
-- ----------------------------

-- ----------------------------
-- Table structure for `t_disposisi`
-- ----------------------------
DROP TABLE IF EXISTS `t_disposisi`;
CREATE TABLE `t_disposisi` (
  `ID_DISPOSISI` int(5) NOT NULL AUTO_INCREMENT,
  `ID_SURAT_MASUK` varchar(15) NOT NULL,
  `STATUS` int(1) NOT NULL COMMENT ' 1= biasa; 2=penting; 3 = rahasia',
  `NOMOR_SURAT` varchar(100) DEFAULT NULL,
  `TANGGAL_SELESAI` date DEFAULT NULL,
  `TANGGAL_DISPOSISI` date DEFAULT NULL,
  `PERIHAL` varchar(255) DEFAULT NULL,
  `ASAL` varchar(255) DEFAULT NULL,
  `ID_PENERIMA` varchar(15) DEFAULT '',
  `ID_PEMBERI` varchar(15) DEFAULT '',
  `INSTRUKSI` text DEFAULT NULL,
  `CATATAN` text DEFAULT NULL,
  `IS_READ` int(1) DEFAULT 0 COMMENT '0 = belum ; 1=sudah',
  `USER_ID` varchar(255) DEFAULT '',
  `TANGGAL_PROSES` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_DISPOSISI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_disposisi
-- ----------------------------

-- ----------------------------
-- Table structure for `t_instansi`
-- ----------------------------
DROP TABLE IF EXISTS `t_instansi`;
CREATE TABLE `t_instansi` (
  `ID_INSTANSI` int(5) NOT NULL,
  `NM_INSTANSI` varchar(100) NOT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL,
  `NO_TELP` varchar(15) DEFAULT NULL,
  `WEBSITE` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `USER_ID` varchar(25) NOT NULL,
  `TANGGAL_PROSES` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_INSTANSI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_instansi
-- ----------------------------
INSERT INTO `t_instansi` VALUES ('1', 'SMA Muhammadiyah 1 Yogyakarta', 'Jl. Gotongroyong II Petinggen Karangwaru Tegalrejo Yogyakarta', '0274-563739', 'http://www.smumuhi-yog.sch.id', 'info@smumuhi-yog.sch.id', '6118b2a943acc2.78631959  ', '2023-04-02 12:20:39');

-- ----------------------------
-- Table structure for `t_log_surat_masuk`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_surat_masuk`;
CREATE TABLE `t_log_surat_masuk` (
  `ID_LOG` int(10) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(25) NOT NULL,
  `IP_ADDRESS` varchar(25) DEFAULT NULL,
  `ID_SURAT_MASUK` varchar(15) DEFAULT '',
  `CATATAN` varchar(255) DEFAULT NULL,
  `WAKTU` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_LOG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_log_surat_masuk
-- ----------------------------

-- ----------------------------
-- Table structure for `t_log_surat_keluar`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_surat_keluar`;
CREATE TABLE `t_log_surat_keluar` (
  `ID_LOG` int(10) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(25) NOT NULL,
  `IP_ADDRESS` varchar(25) DEFAULT NULL,
  `ID_SURAT_KELUAR` varchar(15) DEFAULT '',
  `CATATAN` varchar(255) DEFAULT NULL,
  `WAKTU` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_LOG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `t_log_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_log_user`;
CREATE TABLE `t_log_user` (
  `ID_LOG` int(10) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(100) DEFAULT NULL,
  `IP_ADDRESS` varchar(100) DEFAULT NULL,
  `STATUS` varchar(100) DEFAULT NULL,
  `WAKTU` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_LOG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_log_user
-- ----------------------------

-- ----------------------------
-- Table structure for `t_pegawai`
-- ----------------------------
DROP TABLE IF EXISTS `t_pegawai`;
CREATE TABLE `t_pegawai` (
  `ID_PEGAWAI` varchar(25) NOT NULL,
  `NM_PEGAWAI` varchar(100) NOT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `NO_HANDPHONE` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID_PEGAWAI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_pegawai
-- ----------------------------

-- ----------------------------
-- Table structure for `t_pegawai_login`
-- ----------------------------
DROP TABLE IF EXISTS `t_pegawai_login`;
CREATE TABLE `t_pegawai_login` (
  `ID_LOGIN` varchar(25) NOT NULL,
  `ID_PEGAWAI` varchar(25) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ID_BAGIAN` int(5) NOT NULL,
  `AKTIF` int(1) NOT NULL DEFAULT 1 COMMENT '1 = Aktif ; 0 = Tidak Aktif',
  `PIMPINAN` int(1) DEFAULT 0 COMMENT '0 = Bukan Pimpinan ; 1 = Pimpinan',
  `DATE_CREATE` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `LAST_LOGIN` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_LOGIN`,`ID_PEGAWAI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_pegawai_login
-- ----------------------------

-- ----------------------------
-- Table structure for `t_surat_keluar`
-- ----------------------------
DROP TABLE IF EXISTS `t_surat_keluar`;
CREATE TABLE `t_surat_keluar` (
  `ID_SURAT_KELUAR` varchar(15) NOT NULL,
  `ID_JENIS_SRT_KELUAR` int(5) DEFAULT NULL,
  `TGL_DITERIMA` date DEFAULT NULL,
  `NO_AGENDA` char(10) DEFAULT NULL,
  `KODE` varchar(100) DEFAULT NULL,
  `NO_SURAT` varchar(100) DEFAULT NULL,
  `TGL_SURAT` date DEFAULT NULL,
  `ISI_SURAT` text NOT NULL,
  `TUJUAN` varchar(255) NOT NULL DEFAULT '',
  `FILE_SURAT` varchar(255) DEFAULT NULL,
  `FILE_TTD` varchar(255) DEFAULT NULL,
  `STATUS` char(1) DEFAULT '0' COMMENT '0 = Draff ; 1 = Aprove; 2 = Release',
  `TGL_TTD` date DEFAULT NULL,
  `NM_PIMPINAN` varchar(100) DEFAULT '',
  `CATATAN` varchar(255) DEFAULT '',
  `USER_ID` varchar(25) DEFAULT '',
  `TANGGAL_PROSES` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_SURAT_KELUAR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_surat_keluar
-- ----------------------------

-- ----------------------------
-- Table structure for `t_surat_masuk`
-- ----------------------------
DROP TABLE IF EXISTS `t_surat_masuk`;
CREATE TABLE `t_surat_masuk` (
  `ID_SURAT_MASUK` varchar(10) NOT NULL,
  `ID_JENIS_SRT_MASUK` int(5) NOT NULL,
  `KODE` varchar(10) NOT NULL,
  `NO_AGENDA` varchar(25) NOT NULL,
  `NM_PENGIRIM` varchar(100) NOT NULL,
  `NO_SURAT` varchar(50) NOT NULL,
  `TGL_SURAT` date NOT NULL,
  `TGL_DITERIMA` date NOT NULL,
  `ISI_SURAT` text DEFAULT NULL,
  `STATUS_SURAT` int(1) DEFAULT NULL COMMENT '0 = di arsipkan; 1 = diteruskan',
  `FILE_SURAT` varchar(255) DEFAULT NULL,
  `ID_TUJUAN` varchar(100) DEFAULT '',
  `USER_ID` varchar(25) DEFAULT '',
  `TGL_PROSES` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_SURAT_MASUK`,`ID_JENIS_SRT_MASUK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_surat_masuk
-- ----------------------------

-- ----------------------------
-- Table structure for `t_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `USER_ID` varchar(32) NOT NULL,
  `NAME` varchar(32) NOT NULL,
  `EMAIL` varchar(64) NOT NULL,
  `USERNAME` varchar(64) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `FOTO` varchar(32) DEFAULT '',
  `CREATED_AT` timestamp NULL DEFAULT current_timestamp(),
  `LAST_LOGIN` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('6118b2a943acc2.78631959         ', 'Administrator', 'admin@mail.com', 'admin', '$2y$10$pJglaVmEiI5jOegmXxNERuUDa1OiYw54pj5bwv2zMBzxdbLSd1.yi', 'user.jpeg           ', '2021-08-15 06:22:33', '2023-04-02 07:19:40');
