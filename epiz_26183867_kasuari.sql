-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql101.byetcluster.com
-- Generation Time: Jul 15, 2020 at 08:37 AM
-- Server version: 5.6.21-69.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_26183867_kasuari`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(2) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pass` varchar(50) NOT NULL,
  `pass_hash` varchar(200) NOT NULL,
  `namal` varchar(50) NOT NULL,
  `namap` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nohp` varchar(30) NOT NULL,
  `status` varchar(5) NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `pass`, `pass_hash`, `namal`, `namap`, `alamat`, `nohp`, `status`, `aktif`) VALUES
(1, 'epen', 'epen1234', '$2y$10$OrTZszgQmE/nwmfu2k4xLuB3aluN.rE1zcTvBmXjzhmpArg1xDNg6', 'Stevanus parerungan', 'Epen', 'Jln telkomas lorong 2', '085298314162', 'admin', 1),
(6, 'Aziz', 'Aziz_pass123', '$2y$10$gIgaCyGEXicM8/0J3eoP5egfy.hwurYy1YJ.Y.kxQZB5.tmZ6NA2G', 'Aziz kasuari', 'Aziz', 'Jakarta', '+62 81510288428', 'user', 1),
(5, 'Renzo', 'Renzo_pass123', '$2y$10$8hp/4Hr5oNVDyg6S8.4YYuBYsL7f5ex3yLYRJ3PVzuIrvkdbLN1Fe', 'Renzo casuari', 'Renzo', 'Jln Pattimura timika papua', '+62 852-4351-7823', 'user', 1),
(7, 'Firman', 'Firman_pass123', '$2y$10$BNvq6z7hermAu4V91hix.uP5ZZNo6PV2Gt/YV0ys.sR58diEyx4He', 'Firman kasuari', 'Firman', 'Surabaya', '+62 813-5856-4693', 'user', 1),
(8, 'Deni', 'Deni_pass123', '$2y$10$7qb7RyW0qGj3sodvGPVUG.G3KI6poBSVLJWZp9mhsaQvQlpIh3zaa', 'Arifianto deni', 'Deni', 'Malang', '087879715952', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE `backup` (
  `namefile` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `id` int(1) NOT NULL,
  `waktu` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`namefile`, `tgl`, `id`, `waktu`) VALUES
('Kasuari-20-07-14', '2020-07-14', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` char(14) NOT NULL,
  `tgl` date NOT NULL,
  `kota` varchar(20) NOT NULL,
  `karung` varchar(2) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nohp` varchar(30) NOT NULL,
  `jmlpaket` varchar(15) NOT NULL,
  `berat` varchar(8) NOT NULL,
  `ket` varchar(30) NOT NULL,
  `akun` varchar(20) NOT NULL,
  `userid` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `tgl`, `kota`, `karung`, `nama`, `nohp`, `jmlpaket`, `berat`, `ket`, `akun`, `userid`) VALUES
('2006293kGvz9Ge', '2020-06-28', 'Surabaya', '1', 'Siti', '081235715644', '1 Pcs', '1', '-', 'Epen', 1),
('200629bDKIemT4', '2020-06-28', 'Surabaya', '1', 'Gita Puspita', '081247031003', '2 Kardus', '1', '-', 'Epen', 1),
('200629c3v6WCNq', '2020-06-29', 'Surabaya', '4', 'Hardiyanti TI', '085354496634', '1 Pcs', '-', '-', 'Epen', 1),
('200629eMEUu16f', '2020-06-28', 'Surabaya', '1', 'Ratih K Sari Rozak', '081240041421', '1 Karung', '1', '-', 'Epen', 1),
('200629J95leqrz', '2020-06-29', 'Surabaya', '4', 'Yona Banglino', '082197777821', '1 Kardus', '0,5', '-', 'Epen', 1),
('200629jRcWEfbF', '2020-06-29', 'Surabaya', '4', 'Davita', '-', '1 Pcs', '-', '-', 'Epen', 1),
('200629kRVVaPbJ', '2020-06-28', 'Surabaya', '1', 'H. Rusli', '081240032211', '1 Pack Kayu', '1', '-', 'Epen', 1),
('200629lpd85WW8', '2020-06-28', 'Surabaya', '1', 'Ahmad', '-', '1 Pcs', '1', 'JP1258969572', 'Epen', 1),
('200629pIbO2SJc', '2020-06-28', 'Surabaya', '1', 'Ave', '-', '1 Kardus', '1', '-', 'Epen', 1),
('200629WO8yjfga', '2020-06-29', 'Surabaya', '4', 'Wahyu Ilahi', '081354085786', '1 Kardus', '0,3', '-', 'Epen', 1),
('200629zcNz3UQw', '2020-06-28', 'Surabaya', '1', 'Gesta', '-', '1 Pcs', '1', '-', 'Epen', 1),
('200629zy3MF5LZ', '2020-06-29', 'Surabaya', '4', 'Michiko Tambengi', '082345567770', '1 kardus', '2', '-', 'Epen', 1),
('200630LNJmCEHz', '2020-06-29', 'Surabaya', '1', 'Baco', '-', '-', '-', '-', 'Epen', 1),
('200630Y9HVHBwG', '2020-06-29', 'Surabaya', '1', 'Sabri', '-', '2', '1', '-', 'Epen', 1),
('2007054iRAvgQX', '2020-07-02', 'Makassar', '1', 'Lukers SDG', '099088077066', '2 kardus', '1', 'JP55738273234', 'Epen', 4),
('20070584eE62Yp', '2020-07-02', 'Malang', '4', 'Murdani', '099088077066', '2 kardus', '1', 'JP65738273432', 'Epen', 4),
('2007058QxbONU7', '2020-07-01', 'Jakarta', '3', 'Alif', '099088077066', '2 kardus', '1', 'JP65738273432', 'Epen', 4),
('2007059NnnNEph', '2020-07-02', 'Makassar', '1', 'Mayang Masago', '099088077055', '2 pcs', '-', '-', 'Epen', 4),
('200705BoVSXYcv', '2020-07-01', 'Jakarta', '3', 'Saiful', '088234345456', '1 pcs', '-', '-', 'Epen', 4),
('200705bwhlNhHw', '2020-07-02', 'Malang', '4', 'Nining', '-', '1 pcs', '-', '-', 'Epen', 4),
('200705Dp9OQ1tQ', '2020-07-02', 'Makassar', '1', 'Paud Lale', '-', '3 pcs', '0,5', 'JP65738273433', 'Epen', 4),
('200705fD5qghwS', '2020-07-02', 'Makassar', '1', 'Irianto Salemba', '-', '1 pcs', '-', '-', 'Epen', 4),
('200705JVeqHS2d', '2020-07-01', 'Jakarta', '3', 'Arman', '-', '2 bungkus', '-', '55903050984039', 'Epen', 4),
('200705Nedzg8vf', '2020-07-02', 'Makassar', '1', 'Sabri Tampan', '082144392944', '1 kardus', '-', '-', 'Epen', 4),
('200705nSpKN8aE', '2020-07-02', 'Makassar', '1', 'Wahyu Nac Nackhal', '-', '1 pcs', '-', '-', 'Epen', 4),
('200705oCziA8BJ', '2020-07-01', 'Jakarta', '3', 'Dinda', '-', '1 kardus', '0,2', '-', 'Epen', 4),
('200705oeEm2G2I', '2020-07-02', 'Makassar', '1', 'Aksanita', '-', '-', '2', '-', 'Epen', 4),
('200705pzODLBTx', '2020-07-02', 'Makassar', '1', 'Fita Al Amin', '-', '2 pcs', '-', '-', 'Epen', 4),
('200705QaAv7YS3', '2020-07-02', 'Malang', '4', 'Nasim Setyadi', '-', '2 karung', '5', '-', 'Epen', 4),
('200705s0Yh3Vmt', '2020-07-02', 'Makassar', '1', 'Komets Motherfucker', '-', '2 pcs', '-', '-', 'Epen', 4),
('200705suAIcWKo', '2020-07-02', 'Makassar', '1', 'Ifah Land', '-', '3 pcs', '-', '-', 'Epen', 4),
('200705ySDNWMrV', '2020-07-02', 'Makassar', '1', 'Nacim Pangkep', '-', '2 karung', '5', 'JP65738273432', 'Epen', 4),
('200705Yy23nbRI', '2020-07-02', 'Makassar', '1', 'Harto Gosi', '082345456567', '1 kardus', '-', '-', 'Epen', 4),
('200705zKXUBz3G', '2020-07-02', 'Makassar', '1', 'Amel Buton', '-', '3 pcs', '-', '-', 'Epen', 4),
('200706JlPXsDrU', '2020-07-06', 'Makassar', '1', 'Epen', '', '', '', '', 'Epen', 1),
('200706SDxtT932', '2020-07-06', 'Makassar', '1', '', '', '', '', '', 'Epen', 1),
('200706b6jA2NDQ', '2020-07-06', 'Makassar', '1', '', '', '', '', '', 'Epen', 1),
('200706ayWV6Gv9', '2020-07-06', 'Makassar', '1', '', '', '', '', '', 'Epen', 1),
('200706zP7auZHu', '2020-07-06', 'Makassar', '1', '', '', '', '', '', 'Epen', 1),
('200706teLxbJLE', '2020-07-06', 'Makassar', '1', '', '', '', '', '', 'Epen', 1),
('200706CsJLE9Hv', '2020-07-06', 'Makassar', '1', '', '', '', '', '', 'Epen', 1),
('200706Jr3ZxBHk', '2020-07-06', 'Makassar', '1', '', '', '', '', '', 'Epen', 1),
('200706wWRVFl58', '2020-07-06', 'Makassar', '1', '', '', '', '', '', 'Epen', 1),
('200706ysavFnzt', '2020-07-06', 'Makassar', '1', '', '', '', '', '', 'Epen', 1),
('20071122wUWPPE', '2020-07-11', 'makassar', '1', 'darma timika', '081240503586', '1', '14 kg', 'dilapisi lakban coklat(besar)', 'Epen', 1),
('200711bSt6YfHV', '2020-07-11', 'makassar', '1', 'gita agustina', '081328151343', '2', '3 kg', 'plastik biru', 'Epen', 1),
('200711CrCnWaQt', '2020-07-11', 'makassar', '1', 'hardiyanti', '085256951680', '1', '4 kg', 'dilapisi lakban coklat', 'Epen', 1),
('200711vMtPV22v', '2020-07-11', 'makassar', '1', 'syarifa', '085298764760', '1', '3 kg', 'plastik hitam', 'Epen', 1),
('2007114jELkNd6', '2020-07-11', 'makassar', '1', 'mariante', '-', '1', '3 kg', 'plastik hitam lakban bening', 'Epen', 1),
('200711MUZDdtce', '2020-07-11', 'makassar', '1', 'hernianthy', '082347711154', '1', '3 kg', 'plastik biru', 'Epen', 1),
('200711plsTmXr8', '2020-07-11', 'makassar', '1', 'micha cery bunga', '085242277028', '2', '3 kg', 'plastik putih ', 'Epen', 1),
('200711CvFNkE8k', '2020-07-11', 'makassar', '1', 'marlinda mandia', '081240597666', '3', '4 kg', 'pelastik berwarna', 'Epen', 1),
('200711hHL9ppni', '2020-07-11', 'makassar', '2', 'golstar pasorong', '-', '1', '11 kg', 'karton coklat', 'Epen', 1),
('200711mhG4X3AE', '2020-07-11', 'makassar', '2', 'ricky prasetya', '08114991189', '1', '5 kg', 'karton indomie', 'Epen', 1),
('200711ZAfaaFm0', '2020-07-11', 'makassar', '2', 'lorensia ', '085242443791', '1', '3 kg', 'karton coklat kecil', 'Epen', 1),
('200711ynta0LwB', '2020-07-11', 'makassar', '2', 'irmayanti', '08114992199', '1', '2 kg', 'plastik bening', 'Epen', 1),
('200711u2qbuZr1', '2020-07-11', 'makassar', '2', 'resky', '081240504975', '1', '1 kg', 'kotak kecil coklat', 'Epen', 1),
('200711KerITywV', '2020-07-11', 'makassar', '2', 'joni saba', '081354050619', '1', '5 kg', 'karton coklat', 'Epen', 1),
('200711uN51a0bs', '2020-07-11', 'makassar', '2', 'dari ayu', '08884591504', '1', '1 kg', 'kotak hitam', 'Epen', 1),
('2007119i5y3CsF', '2020-07-11', 'makassar', '2', 'farya shop', '-', '1', '1 kg', 'lakban coklat', 'Epen', 1),
('200711bMECP5ql', '2020-07-11', 'makassar', '3', 'agung', '081298050330', '2', '20 kg', 'plastik hitam', '', 0),
('200711zME9lJsM', '2020-07-11', 'makassar', '3', 'agung', '081298050330', '2', '20 kg', 'plastik hitam', 'Epen', 1),
('200711MrYFC2ly', '2020-07-11', 'makassar', '3', 'santri', '082399625356', '1', '1 kg ', 'plastik pink', 'Epen', 1),
('200711wDUNlitw', '2020-07-11', 'makassar', '3', 'risman', '-', '1', '3 kg', 'kandalpot', 'Epen', 1),
('200711Tk8RcSqD', '2020-07-11', 'makassar', '3', 'fauzi zainal', '081355378678', '1', '1 kg', 'map coklat', 'Epen', 1),
('200711fNatxISp', '2020-07-11', 'makassar', '3', 'sandra timika', '-', '2', '2 kg', 'kotak dan plastik', 'Epen', 1),
('200711QFX4VZSa', '2020-07-11', 'makassar', '3', 'meryla', '085344484901', '1', '1 kg', 'kotak coklat', 'Epen', 1),
('200711li6ImKnD', '2020-07-11', 'makassar', '4', 'feny', '081384331858', '1', '6 kg', 'plastik ungu', 'Epen', 1),
('200711RsCUl4qw', '2020-07-11', 'makassar', '4', 'yori', '082196867899', '2', '6 kg', 'kotak oriflame', 'Epen', 1),
('200711TjIO1TWy', '2020-07-11', 'makassar', '4', 'cherly', '082198053438', '1', '2 kg', 'plastik hitam', 'Epen', 1),
('200711JwEGKQip', '2020-07-11', 'makassar', '4', 'rahayu bongga', '081343683651', '1', '3 kg', 'plastik hijauh', 'Epen', 1),
('200711CGd1uu9s', '2020-07-11', 'makassar', '4', 'sherli leunufna', '082134416929', '2', '2 kg', 'plastik putih', 'Epen', 1),
('200711feK90EIe', '2020-07-11', 'makassar', '4', 'nurhikmah ', '085340035195', '1', '4 kg', 'kertas batik', 'Epen', 1),
('200711g2VWnYrp', '2020-07-11', 'makassar', '4', 'rudy', '-', '1', '1 kg', 'kotak coklat', 'Epen', 1),
('200711ESbZivyH', '2020-07-11', 'makassar', '4', 'feny', '082191666016', '1', '2 kg', 'karton phanter', 'Epen', 1),
('200711jEgsZQ7D', '2020-07-11', 'makassar', '5', 'bunga', '081248458474', '2', '11 kg', 'karton hitam', 'Epen', 1),
('20071141hUxed0', '2020-07-11', 'makassar', '5', 'apotik j.c farma', '08114904009', '1', '6 kg', 'karton coklat', 'Epen', 1),
('200711LcQ3MdEi', '2020-07-11', 'makassar', '5', 'effi', '081240463242', '1', '3 kg', 'plastik hijauh', 'Epen', 1),
('2007115j81Shq1', '2020-07-11', 'makassar', '5', 'rilia', '081240258198', '1', '1 kg', 'plastik merah', 'Epen', 1),
('200711ENePzzfL', '2020-07-11', 'makassar', '5', 'yotam palius', '081344594321', '1', '4 kg ', 'plastik merah', 'Epen', 1),
('2007119YQqFWWO', '2020-07-11', 'makassar', '5', 'kardila', '082244133747', '1', '2 kg', 'kotak panjang coklat', 'Epen', 1),
('200711G342j3vD', '2020-07-11', 'makassar', '5', 'irmawati', '082198069003', '1', '3 kg', 'kotak coklat', 'Epen', 1),
('200711MtExWip8', '2020-07-11', 'makassar', '5', 'andi langit', '081240000843', '1', '8 kg', 'kotak coklat', 'Epen', 1),
('200713YJ8SjMCy', '2020-07-08', 'Jakarta', '2', 'Ednar', '-', '1', '0', '-', 'Aziz', 6),
('200713qzweAS3P', '2020-07-08', 'Jakarta', '2', 'Wahyu', '-', '1', '0', '-', 'Aziz', 6),
('200713cj0yQGa1', '2020-07-08', 'Jakarta', '2', 'Ayub', '081330785232', '1', '0', '-', 'Aziz', 6),
('2007137sBoJc2d', '2020-07-08', 'Jakarta', '2', 'Endang patimang', '082333568435', '2', '0', '-', 'Aziz', 6),
('200713XImay9jh', '2020-07-08', 'Jakarta', '2', 'Fany farah', '082248326553', '1', '0', '-', 'Aziz', 6),
('200713NZpUdhjv', '2020-07-08', 'Jakarta', '2', 'Faisal ', '-', '1', '0', '-', 'Aziz', 6),
('200713DmezMlkV', '2020-07-08', 'Jakarta', '2', 'Iswandi', '08114911151', '2', '0', '-', 'Aziz', 6),
('200713toATRp2p', '2020-07-10', 'Jakarta', 'Ka', 'Efendi', '+62 812-1355-6688', '1 kardus', '0', '-', 'Aziz', 6),
('200714cDdjrH5N', '2020-07-15', 'SURABAYA', '1', 'madical center', '', '', '', '', 'Firman', 7),
('2007147VlEtEPU', '2020-07-15', 'SURABAYA', '1', '', '', '', '', '', 'Firman', 7),
('200714X3tvyNWG', '2020-07-15', 'SURABAYA', '1', '', '', '', '', '', 'Firman', 7),
('200714S82pQYNB', '2020-07-15', 'SURABAYA', '1', '', '', '', '', '', 'Firman', 7),
('200714Y5smtett', '2020-07-15', 'SURABAYA', '1', '', '', '', '', '', 'Firman', 7),
('200714RsZlwEA3', '2020-07-15', 'SURABAYA', '1', '', '', '', '', '', 'Firman', 7),
('200714leBc7WcL', '2020-07-15', 'SURABAYA', '1', '', '', '', '', '', 'Firman', 7),
('200714WogiWSZu', '2020-07-15', 'SURABAYA', '1', '', '', '', '', '', 'Firman', 7),
('200714A6OT7FMI', '2020-07-15', 'SURABAYA', '1', '', '', '', '', '', 'Firman', 7),
('200714VlVuwyNT', '2020-07-15', 'SURABAYA', '1', '', '', '', '', '', 'Firman', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup`
--
ALTER TABLE `backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
