-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 05:15 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ternak`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_akun`
--

CREATE TABLE `tb_akun` (
  `id_akun` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_akun`
--

INSERT INTO `tb_akun` (`id_akun`, `user`, `pass`, `nama`, `alamat`, `foto`) VALUES
(1, 'arya@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Kayuza Kirito', 'Pandalarang', '../Users/arya@gmail.com/Profil/kirito.jpeg'),
(6, 'a@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Kirito', 'Jatingaleh Semarang', '../Users/a@gmail.com/Profil/data-arranging-f (2).png'),
(7, 'sarah@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Sarah Tania', 'Ungaran', '../Users/sarah@gmail.com/Profil/data.jpeg'),
(8, 'kami@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Kami', 'Payakumbuah', '../Users/kami@gmail.com/Profil/pngtree-cute-anime-girl-praying-at-moon-vector-png-image_12226300.png'),
(9, 'kita@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Kita', 'Probolinggo', '../Users/kita@gmail.com/Profil/desktop-wallpaper-duolingo-redesigned-its-owl-to-guilt-duolingo-meme.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_beli`
--

CREATE TABLE `tb_beli` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(25) NOT NULL,
  `total` int(255) NOT NULL,
  `user_penjual` varchar(255) NOT NULL,
  `user_pembeli` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_beli`
--

INSERT INTO `tb_beli` (`id`, `nama_barang`, `jumlah`, `total`, `user_penjual`, `user_pembeli`, `alamat`, `bukti_bayar`) VALUES
(20, 'Obat Kutu', 23, 0, 'a@gmail.com', 'arya@gmail.com', 'Pandalarang', '../Users/arya@gmail.com/Pembelian/rembo.jpg'),
(21, 'Obat Kutu', 1, 0, 'a@gmail.com', 'arya@gmail.com', 'Pandalarang', '../Users/arya@gmail.com/Pembelian/kelas.png'),
(22, 'Obat Kutu', 2, 0, 'a@gmail.com', 'arya@gmail.com', 'Pandalarang', '../Users/arya@gmail.com/Pembelian/rembo.jpg'),
(23, 'Obat Kutu', 10, 0, 'a@gmail.com', 'arya@gmail.com', 'Pandalarang', '../Users/arya@gmail.com/Pembelian/rembo.jpg'),
(24, 'Obat Kutu', 3, 0, 'a@gmail.com', 'arya@gmail.com', 'Pandalarang', '../Users/arya@gmail.com/Pembelian/organisasi.png'),
(25, 'Obat Kutu', 5, 0, 'a@gmail.com', 'arya@gmail.com', 'Pandalarang', '../Users/arya@gmail.com/Pembelian/perform.png'),
(26, 'Obat Kutu', 10, 100000, 'a@gmail.com', 'arya@gmail.com', 'Pandalarang', '../Users/arya@gmail.com/Pembelian/nonakademik.png'),
(27, 'Whiskas 80Gr', 22, 151800, 'arya@gmail.com', 'a@gmail.com', 'Jatingaleh Semarang', '../Users/a@gmail.com/Pembelian/bukti.jpeg'),
(28, 'Whiskas 80Gr', 8, 55200, 'arya@gmail.com', 'kita@gmail.com', 'Probolinggo', '../Users/kita@gmail.com/Pembelian/bukti.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_info`
--

CREATE TABLE `tb_info` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_info`
--

INSERT INTO `tb_info` (`id`, `user`, `judul`, `deskripsi`, `foto`) VALUES
(1, 'a@gmail.com', 'Cara Merawat Bulu Domba', '<p data-sourcepos=\"1:1-1:50\">Berikut merupakan cara merawat bulu domba ternak agar lebat:</p>\r\n<p data-sourcepos=\"3:1-3:10\"><strong>Pakan:</strong></p>\r\n<ul data-sourcepos=\"5:1-8:0\">\r\n<li data-sourcepos=\"5:1-5:101\">Berikan pakan yang kaya protein dan vitamin, seperti rumput segar, kacang-kacangan, dan konsentrat.</li>\r\n<li data-sourcepos=\"6:1-6:67\">Pastikan domba memiliki akses ke air minum yang bersih dan segar.</li>\r\n<li data-sourcepos=\"7:1-8:0\">Hindari memberi pakan yang mengandung jamur atau racun.</li>\r\n</ul>\r\n<p data-sourcepos=\"9:1-9:12\"><strong>Kandang:</strong></p>\r\n<ul data-sourcepos=\"11:1-14:0\">\r\n<li data-sourcepos=\"11:1-11:45\">Jaga kandang domba tetap bersih dan kering.</li>\r\n<li data-sourcepos=\"12:1-12:57\">Berikan ventilasi yang cukup agar kandang tidak lembab.</li>\r\n<li data-sourcepos=\"13:1-14:0\">Lakukan penjemuran kandang secara berkala.</li>\r\n</ul>\r\n<p data-sourcepos=\"15:1-15:19\"><strong>Perawatan Bulu:</strong></p>\r\n<ul data-sourcepos=\"17:1-21:0\">\r\n<li data-sourcepos=\"17:1-17:72\">Sisir bulu domba secara rutin untuk menghilangkan kotoran dan parasit.</li>\r\n<li data-sourcepos=\"18:1-18:74\">Lakukan pencukuran bulu domba secara berkala, idealnya dua kali setahun.</li>\r\n<li data-sourcepos=\"19:1-19:53\">Gunakan shampo khusus domba untuk memandikan domba.</li>\r\n<li data-sourcepos=\"20:1-21:0\">Berikan vitamin dan mineral tambahan untuk menjaga kesehatan bulu domba.</li>\r\n</ul>\r\n<p data-sourcepos=\"22:1-22:15\"><strong>Pengobatan:</strong></p>\r\n<ul data-sourcepos=\"24:1-26:0\">\r\n<li data-sourcepos=\"24:1-24:64\">Segera obati jika domba terserang penyakit kulit atau parasit.</li>\r\n<li data-sourcepos=\"25:1-26:0\">Konsultasikan dengan dokter hewan untuk mendapatkan pengobatan yang tepat.</li>\r\n</ul>', '../Users/a@gmail.com/Informasi/domba.jpeg'),
(2, 'a@gmail.com', 'Tips and Trick Suara Merdu Burung Kutilang', '<p><strong>Cara Agar Burung Kutilang Bersuara Merdu:</strong></p>\r\n<ol data-sourcepos=\"5:1-5:31\">\r\n<li data-sourcepos=\"5:1-5:31\">\r\n<p data-sourcepos=\"5:4-5:31\"><strong>Pemeliharaan Sejak Bayi:</strong></p>\r\n<ul data-sourcepos=\"6:5-8:0\">\r\n<li data-sourcepos=\"6:5-6:63\">Pelihara sejak menetas,&nbsp;agar tidak meniru suara induknya.</li>\r\n<li data-sourcepos=\"7:5-8:0\">Latih dengan suara kicauan burung juara.</li>\r\n</ul>\r\n</li>\r\n<li data-sourcepos=\"9:1-11:31\">\r\n<p data-sourcepos=\"9:4-9:39\"><strong>Mendengarkan Suara Burung Juara:</strong></p>\r\n<ul data-sourcepos=\"10:5-11:31\">\r\n<li data-sourcepos=\"10:5-10:61\">Putarkan rekaman suara burung juara melalui smartphone.</li>\r\n<li data-sourcepos=\"11:5-11:31\">Lakukan di pagi atau sore hari saat burung aktif berkicau.</li>\r\n</ul>\r\n</li>\r\n<li data-sourcepos=\"13:1-14:40\">\r\n<p data-sourcepos=\"13:4-13:37\"><strong>Mengasingkan dari Burung Liar:</strong></p>\r\n<ul data-sourcepos=\"14:5-14:40\">\r\n<li data-sourcepos=\"14:5-14:40\">Cegah meniru suara burung kutilang liar.</li>\r\n<li data-sourcepos=\"15:5-16:0\">Berikan contoh kicauan burung juara.</li>\r\n</ul>\r\n</li>\r\n<li data-sourcepos=\"17:1-20:0\">\r\n<p data-sourcepos=\"17:4-17:33\"><strong>Rutin Mengganti Air Minum:</strong></p>\r\n<ul data-sourcepos=\"18:5-20:0\">\r\n<li data-sourcepos=\"18:5-18:55\">Menjaga kesehatan pencernaan dan peredaran darah.</li>\r\n<li data-sourcepos=\"19:5-20:0\">Membuat kicauan lebih lantang.</li>\r\n</ul>\r\n</li>\r\n<li data-sourcepos=\"21:1-24:0\">\r\n<p data-sourcepos=\"21:4-21:45\"><strong>Menggantungkan Sangkar di Teras Rumah:</strong></p>\r\n<ul data-sourcepos=\"22:5-24:0\">\r\n<li data-sourcepos=\"22:5-22:47\">Memberikan suasana nyaman untuk berkicau.</li>\r\n<li data-sourcepos=\"23:5-24:0\">Mendengarkan kicauan burung lain untuk meniru.</li>\r\n</ul>\r\n</li>\r\n</ol>', '../Users/a@gmail.com/Informasi/burung.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jual`
--

CREATE TABLE `tb_jual` (
  `id` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `stok` int(255) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jual`
--

INSERT INTO `tb_jual` (`id`, `user`, `nama_barang`, `harga`, `stok`, `keterangan`, `foto`) VALUES
(1, 'arya@gmail.com', 'Whiskas 80Gr', 6900, 70, '<p><strong>Makanan Kucing Basah Adult Mackerel &amp; Salmon Pouch</strong></p>\r\n<ul class=\"no-margin-bottom tw-list-disc\">\r\n<li>Mengandung nutrisi dan vitamin seimbang</li>\r\n<li>Makanan untuk kucing&nbsp;berusia 1 tahun ke atas</li>\r\n<li>Tekstur lembut yang mudah dicerna oleh kucing</li>\r\n<li>Lengkap dengan vitamin A dan taurin untuk penglihatan sehat</li>\r\n<li>Terbuat dari bahan-bahan pilihan berkualitas, termasuk ikan kembung dan salmon</li>\r\n<li>Diperkaya dengan omega 3 &amp; 6, lemak dan seng untuk mantel yang sehat dan berkilau</li>\r\n<li>Mengandung antioksidan (vitamin E dan selenium) untuk sistem kekebalan tubuh yang sehat</li>\r\n<li>Diisi dengan protein dari ikan asli, termasuk lemak, vitamin dan mineral, sehingga kucing Anda tetap bugar dan bahagia</li>\r\n<li>Rasa :&nbsp; Mackerel and Salmon</li>\r\n<li>Isi : 80 gr</li>\r\n<li>Dimensi produk : 9&nbsp;x 12.5 x 1.5 cm</li>\r\n<li>Isi set: 1 pc</li>\r\n<li>Lebar: 12.5 cm</li>\r\n<li>Panjang: 9 cm</li>\r\n<li>Tekstur: basah</li>\r\n<li>Tinggi: 1.5 cm</li>\r\n<li>Usia: 1 tahun</li>\r\n<li>Varian rasa: makarel</li>\r\n</ul>', '../Users/arya@gmail.com/Jualan/whiskas.jpg'),
(2, 'arya@gmail.com', 'Royal Canin Kitten Persia 10KG', 1775000, 25, '<p><strong>Royal Canin Kitten Persian 32</strong> adalah makanan untuk anak kucing Persia dalam fase pertumbuhan pertama (sampai 4 bulan), Royal Canin mempertahankan bahwa diet kucing harus memperhitungkan semua parameter kehidupan seperti usia, ras, gaya hidup, dan keadaan individual.</p>\r\n<p>&ndash; 10 kilogram<br>&ndash; Untuk kitten kucing persian 1- 4 bulan<br>&ndash; Meningkatkan sistem kekebalan tubuh<br>&ndash; Membantu transisi kucing<br>&ndash; Mudah dicerna<br>&ndash; Tekstur dan formula unik</p>', '../Users/arya@gmail.com/Jualan/RC.jpg'),
(3, 'a@gmail.com', 'Ebod Joss', 16500, 124, '<p data-sourcepos=\"3:1-3:12\"><strong>Manfaat:</strong></p>\r\n<ul data-sourcepos=\"5:1-19:0\">\r\n<li data-sourcepos=\"5:1-5:40\">Menggacorkan semua jenis burung kicau.</li>\r\n<li data-sourcepos=\"6:1-6:34\">Membesarkan volume suara burung.</li>\r\n<li data-sourcepos=\"7:1-7:30\">Meningkatkan stamina burung.</li>\r\n<li data-sourcepos=\"8:1-8:29\">Memperpanjang nafas burung.</li>\r\n<li data-sourcepos=\"9:1-9:27\">Menjaga kesehatan burung.</li>\r\n<li data-sourcepos=\"10:1-10:29\">Membuat burung aktif bunyi.</li>\r\n<li data-sourcepos=\"11:1-11:28\">Membentuk karakter burung.</li>\r\n<li data-sourcepos=\"12:1-12:29\">Memaksimalkan power burung.</li>\r\n<li data-sourcepos=\"13:1-13:28\">Mendongkrak mental burung.</li>\r\n<li data-sourcepos=\"14:1-14:32\">Memulihkan burung macet bunyi.</li>\r\n<li data-sourcepos=\"15:1-15:31\">Memaksimalkan kinerja burung.</li>\r\n<li data-sourcepos=\"16:1-16:14\">Anti stress.</li>\r\n<li data-sourcepos=\"17:1-17:32\">Baik digunakan setelah mabung.</li>\r\n<li data-sourcepos=\"18:1-19:0\">Membuat burung lebih bertenaga.</li>\r\n</ul>\r\n<p data-sourcepos=\"20:1-20:21\"><strong>Aturan Pemakaian:</strong></p>\r\n<ul data-sourcepos=\"22:1-26:0\">\r\n<li data-sourcepos=\"22:1-22:61\">Teteskan 5 tetes ke air minum selama 5 hari berturut-turut.</li>\r\n<li data-sourcepos=\"23:1-23:81\">Untuk burung kurang gacor dan suara kurang power, gunakan 2 hari sebelum lomba.</li>\r\n<li data-sourcepos=\"24:1-24:40\">Beri jarak 1 minggu untuk pengulangan.</li>\r\n<li data-sourcepos=\"25:1-26:0\">Hentikan pemakaian jika burung sudah gacor.</li>\r\n</ul>', '../Users/a@gmail.com/Jualan/ebod.jpg'),
(4, 'a@gmail.com', 'Konsentrat/ Pakan Sapi, Kambing, Domba, Babi 50Kg', 145000, 27, '<p><strong>Pakan sapi</strong> perlu persyaratan khusus dalam asupan pakan sapi potong, untuk menghasilkan tambahan berat badan. Antara lain: Protein kasar, energi, karbohidrat, dan mineral. Sapibagus memproduksi pakan konsentrat dengan kandungan Protein kasar 15 %, bahan utama diproses dengan fermentasi untuk menghasilkan kualitas bagus dan daya cerna yang tinggi.</p>', '../Users/a@gmail.com/Jualan/konsentrat.jpg'),
(5, 'sarah@gmail.com', 'Kandang Ayam Kate', 1500000, 2, '<p>Dibuat dari bambu kokoh, dan material yang dapat menahan guncangan angin maupun hujan</p>', '../Users/sarah@gmail.com/Jualan/kandang.jpg'),
(6, 'sarah@gmail.com', 'Sheep Shearing Clipper', 1725000, 1, '<p data-sourcepos=\"1:1-1:259\"><strong>Pemangkas listrik</strong> ini ditujukan untuk menjaga agar domba, kambing, alpaka, dan ternak lainnya terawat dengan baik. Alat ini dirancang untuk penggunaan yang tahan lama, senyap, dan nyaman, memastikan hewan Anda menerima potongan yang presisi dan tanpa terluka.</p>\r\n<p data-sourcepos=\"3:1-3:134\">Baik Anda baru dalam perawatan ternak atau sudah profesional, Anda dapat dengan mudah menangani pekerjaan pemangkasan dengan alat ini!</p>\r\n<p data-sourcepos=\"5:1-5:12\"><strong>Fitur Utama:</strong></p>\r\n<ul data-sourcepos=\"6:1-12:0\">\r\n<li data-sourcepos=\"6:1-6:160\">Pemangkas Bulu Domba Profesional: bekerja pada anjing besar dan sedang, domba, kuda, dll., dirancang khusus untuk mencukur hewan dengan bulu tebal dan rambut.</li>\r\n<li data-sourcepos=\"7:1-7:98\">Efisiensi Tinggi: pemangkas perawatan 320W tugas berat, dengan kecepatan potong tinggi 2400r/min</li>\r\n<li data-sourcepos=\"8:1-8:148\">Ramah Pengguna dan Aman: Pisau baja tajam mudah memotong bulu tebal tanpa melukai hewan ternak, memberikan cara yang mudah dan aman untuk merawat.</li>\r\n<li data-sourcepos=\"9:1-9:82\">Motor Andal: fitur dengan ketahanan panas tinggi, kebisingan rendah, dan getaran</li>\r\n<li data-sourcepos=\"10:1-10:113\">Dengan Kabel Listrik 5m: memungkinkan fleksibilitas terbaik dan akses luar ruangan saat Anda merawat hewan Anda</li>\r\n<li data-sourcepos=\"11:1-12:0\">Termasuk Aksesoris dan Kotak Pembawa: peralatan pemotong rambut ternak ini dikemas dalam wadah yang mudah dibawa dengan area penyimpanan khusus untuk setiap item, nyaman digunakan dan disimpan</li>\r\n</ul>\r\n<p data-sourcepos=\"13:1-21:77\"><strong>Spesifikasi:</strong> Nama: pemangkas domba elektrik Daya: 320W Tegangan: 220V Kecepatan putar: 2400r/min Panjang pemotongan maksimum: 80mm Berat produk: 1.9270 kg Berat paket: 3.0050 kg Ukuran Paket (P x L x T): 44.00 x 20.00 x 10.00 cm / 17.32 x 7.87 x 3.94 inci</p>\r\n<p data-sourcepos=\"23:1-24:128\"><strong>Isi Paket:</strong> 1 x Pemangkas, 1 x Sikat, 2 x Sikat Karbon, 1 x Obeng, 1 x Kotak, 1 x Oli Pemangkas Khusus, 1 x Panduan Pengguna Bahasa Inggris</p>', '../Users/sarah@gmail.com/Jualan/Shearing.jpg'),
(7, 'kami@gmail.com', 'EM 4', 22200, 176, '<p><strong>EM4 Peternakan</strong> merupakan kultur EM dalam medium cair berwarna coklat kekuning-kuningan yang menguntungkan untuk pertumbuhan dan produksi ternak dengan cirri-ciri berbau asam manis. EM4 Peternakan mampu memperbaiki jasad renik di dalam saluran pencernaan ternak sehingga kesehatan ternak akan meningkat, tidak mudah stress dan bau kotoran akan berkurang. Pemberian EM4 Peternakan pada pakan dan minum ternak akan meningkatkan nafsu makan karena aroma asam manis yang ditimbulkan. EM4 Peternakan tidak mengandung bahan kimia sehingga aman bagi ternak.<br><br><strong>Manfaat EM4 Peternakan Pada Unggas:</strong><br>Menyeimbangkan mikroorganisme yang menguntungkan dalam perut ternak.<br>Memperbaiki dan meningkatkan kesehatan ternak.<br>Meningkatkan mutu daging ternak.<br>Mengurangi tingkat kematian bibit ternak.<br>Memperbaiki kesuburan ternak.<br>Mencegah bau tidak sedap pada kandang ternak<br>Mengurangi stress pada ternak<br>Mencegah bau tidak sedap pada kandang ternak dan kotoran ternak.</p>', '../Users/kami@gmail.com/Jualan/em4.jpg'),
(8, 'kami@gmail.com', 'Anakan Sapi Pegon', 19500000, 3, '<p><strong>SAPI MURAH</strong><br>- Berat 200 kg.an.<br>- Kondisi Syari, Sehat dan Cukup Usia.</p>', '../Users/kami@gmail.com/Jualan/anaksapi.jpg'),
(9, 'kita@gmail.com', 'Mower Manual', 670000, 10, '<p><strong>Mesin Potong Rumput Dorong Manual Mower</strong> 12\" T Hand Mesin Pertanian dan Perkebunan<br><br><strong>Aplikasi :</strong><br>- Tinggal dorong ke bawah sedikit tenaga otomatis blade berputar.<br><br><strong>Features :</strong><br>- Terdapat penampung rumput, dapat muat skala menengah.<br>- Tinggi posisi dapat diatur hingga 21 - 45 mm, tinggal disesuaikan dengan kebutuhan.<br><br><strong>Kelebihan :</strong><br>- Nyaman di gunbakan<br>- Perakitan mudah, terdapat video.<br>- T Hand Handle menggunakan karbon, nyaman di pakai dengan waktu yang lama.<br>- Tidak memerlukan bahan bakar.<br><br><strong>Spesifikasi</strong><br>Ukuran Mata : 12\"<br>Berat : 6.7 kg<br>Material : Besi + Mika + Karbon<br>Warna : Hijau<br>Made in : China</p>', '../Users/kita@gmail.com/Jualan/mower.jpg'),
(10, 'kita@gmail.com', 'Pagar Listrik', 1900000, 1, '<p>Energi pagar bertenaga listrik berdaya tinggi dan murah.<br>Jarak pagar efektif yang panjang, mendukung tegangan input DC12V dan dc220 V, praktis dan bermanfaat.<br>Arus Searah dan arus bolak-balik daya dapat dialihkan untuk digunakan, dapat menggunakan adaptor daya,Baterai, Sistem tenaga surya sebagai catu daya.<br>Dilengkapi dengan tampilan digital, konsumsi daya rendah, Anda dapat melihat data dengan jelas.<br>Host memiliki teknologi perlindungan ganda, keamanan untuk hewan dan tubuh manusia, sementara itu, melindungi mesin.<br>Dilengkapi dengan tombol rotasi penyesuaian kecepatan fase, mudah disesuaikan sesuai dengan kebiasaan hewan.<br>Yang digunakan untuk memperbaiki kebiasaan buruk unggas dan mengusir predator yang tidak diinginkan dari pagar Anda.<br>Cocok untuk pertanian, peternakan unggas, hutan, Penyimpanan ternak, dll.</p>', '../Users/kita@gmail.com/Jualan/pagar.png'),
(11, 'kita@gmail.com', 'Incubator Otomatis', 5600000, 4, '<p>Kami Membantu Para Peternak, Pensiunan, Penghobi burung dan Yang ingin sukses dalam Usaha Menetaskan Berbagai Telur Unggas, Indo Tetas &ndash; Mesin Tetas Yang Paling PAS.</p>', '../Users/kita@gmail.com/Jualan/incu.jpg'),
(12, 'kita@gmail.com', 'Pakan Ternak Kelinci', 95000, 230, '<p><strong>Alfalfa / Timothy Hay dari Gruppo Carli</strong> merupakan pakan ternak berkualitas tinggi yang terbuat dari 100% alfalfa / timothy italia murni (Medicago sativa) pilihan yang dijemur atau dikeringkan dan dibersihkan dari jamur dan spora.<br><br>1. Suplemen protein berbasis serat ideal yang sangat mudah dicerna<br>2. Kandungan selulosanya yang tinggi<br>3. Kandungan protein yang luar biasa dengan tingkat lisin yang tinggi<br>4. Tingkat pati dan gula yang rendah, kandungan kalsium, kalium dan besi yang tinggi.</p>', '../Users/kita@gmail.com/Jualan/pakan.jpg'),
(13, 'kita@gmail.com', 'Tempat Minum Sapi 25Cm', 500000, 12, '<p><strong>Tempat Minum Sapi 25 cm Anjing Kambing Domba Kuda</strong>.<br>Mangkok Full Stainless Steel.<br>System pelampung sehingga mangkok selalu terisi air penuh.<br>Hewan ternak tidak akan dehidrasi.</p>', '../Users/kita@gmail.com/Jualan/minum.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_akun`
--
ALTER TABLE `tb_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tb_beli`
--
ALTER TABLE `tb_beli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_info`
--
ALTER TABLE `tb_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jual`
--
ALTER TABLE `tb_jual`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_akun`
--
ALTER TABLE `tb_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_beli`
--
ALTER TABLE `tb_beli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_info`
--
ALTER TABLE `tb_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jual`
--
ALTER TABLE `tb_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
