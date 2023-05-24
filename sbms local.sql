-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Mar 2023 pada 06.55
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sbms`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `abouts`
--

INSERT INTO `abouts` (`id`, `nama`, `link`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, '<h1>Keamanan Lemah</h1>', 'https://iotlab-uns.com/smart-bms/public', '<h1>Keamanan Lemah</h1>', '2022-11-15 14:23:59', '2022-12-08 06:18:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `api_data`
--

CREATE TABLE `api_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kwh` int(11) NOT NULL,
  `power` int(11) NOT NULL,
  `voltage` int(11) NOT NULL,
  `current` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `api_data`
--

INSERT INTO `api_data` (`id`, `kwh`, `power`, `voltage`, `current`, `created_at`, `updated_at`) VALUES
(1, 0, 8, 9, 4, '2022-10-06 00:46:08', '2022-10-06 00:46:08'),
(2, 0, 2, 1, 2, '2022-10-06 00:57:37', '2022-10-06 00:57:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cameras`
--

CREATE TABLE `cameras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dashboard_settings`
--

CREATE TABLE `dashboard_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dashboard_settings`
--

INSERT INTO `dashboard_settings` (`id`, `nama`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'energy_current_status', 'Energy Current', 1, '2022-11-22 12:29:54', '2022-11-22 12:29:54'),
(2, 'electricity_price', 'Electricity Price', 0, '2022-11-22 12:29:54', '2022-12-07 02:12:05'),
(3, 'fire_alarm_status', 'Fire Alarm', 1, '2022-11-22 12:29:54', '2022-11-22 12:29:54'),
(4, 'temp_status', 'Temperature', 1, '2022-11-22 12:29:54', '2022-11-22 12:29:54'),
(5, 'humid_status', 'Humidity', 1, '2022-11-22 12:29:54', '2022-11-22 12:29:54'),
(6, 'energy_usage_status', 'Energy Usage', 1, '2022-11-22 12:29:54', '2022-11-22 12:29:54'),
(7, 'month_cost_status', 'This Month Cost', 1, '2022-11-22 12:29:54', '2022-11-22 12:29:54'),
(8, 'previous_cost_status', 'Previous Month Cost', 1, '2022-11-22 12:29:54', '2022-11-22 13:11:05'),
(9, 'camera_status', 'Camera', 1, '2022-11-22 12:29:54', '2022-11-22 12:29:54'),
(10, 'device_status', 'Energy Device Status', 1, '2022-11-22 12:29:54', '2022-11-22 13:11:07'),
(11, 'voltage', 'Voltage', 1, '2022-11-22 12:29:54', '2022-11-22 13:11:10'),
(12, 'current', 'Current', 0, '2022-11-22 12:29:54', '2022-11-22 13:11:51'),
(13, 'frequency', 'Frequency', 1, '2022-11-22 12:29:54', '2022-11-22 13:11:16'),
(14, 'active_power', 'Active Power', 0, '2022-11-22 12:29:54', '2022-11-22 13:11:47'),
(15, 'reactive_power', 'Reactive Power', 1, '2022-11-22 12:29:54', '2022-11-22 13:11:21'),
(16, 'apparent_power', 'Apparent Power', 1, '2022-11-22 12:29:54', '2022-11-22 13:11:25'),
(17, 'dimmer_status', 'Light Dimmer Status', 0, '2022-11-22 12:29:54', '2022-11-22 13:12:08'),
(18, 'light_status', 'Light Status', 1, '2022-11-22 12:29:54', '2022-11-22 13:11:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dht_extras`
--

CREATE TABLE `dht_extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dht_extras`
--

INSERT INTO `dht_extras` (`id`, `id_nama`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(14, 'DHT1', 'Sensor Suhu dan Kelembaban Tambahan', 0, '2022-12-08 06:18:34', '2022-12-08 06:18:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dht_extra_data`
--

CREATE TABLE `dht_extra_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dht` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temperature` double(8,2) NOT NULL,
  `humidity` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dht_extra_data`
--

INSERT INTO `dht_extra_data` (`id`, `dht`, `temperature`, `humidity`, `created_at`, `updated_at`) VALUES
(9, 'DHT1', 2.00, 30.00, '2022-11-11 02:22:16', '2022-11-11 02:22:16'),
(10, 'DHT2', 2.00, 30.00, '2022-11-11 02:22:22', '2022-11-11 02:22:22'),
(11, 'DHT3', 2.00, 30.00, '2022-11-11 02:22:26', '2022-11-11 02:22:26'),
(12, 'DHT4', 2.00, 30.00, '2022-11-11 02:22:29', '2022-11-11 02:22:29'),
(13, 'DHT5', 2.00, 30.00, '2022-11-11 02:22:33', '2022-11-11 02:22:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dht_sensors`
--

CREATE TABLE `dht_sensors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `temperature` float NOT NULL,
  `humidity` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dht_sensors`
--

INSERT INTO `dht_sensors` (`id`, `temperature`, `humidity`, `created_at`, `updated_at`) VALUES
(1, 2, 30, '2023-01-12 06:18:32', '2022-11-15 06:18:32'),
(2, 20, 30, '2022-11-15 06:18:36', '2022-11-15 06:18:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `doorlock_accesses`
--

CREATE TABLE `doorlock_accesses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` int(127) NOT NULL,
  `level_akses` int(127) NOT NULL,
  `is_aktif` int(127) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `doorlock_accesses`
--

INSERT INTO `doorlock_accesses` (`id`, `nama`, `token`, `level_akses`, `is_aktif`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 123456, 3, 1, NULL, NULL),
(2, 'akses pertama saya', 823999, 1, 1, '2023-01-31 05:51:27', '2023-02-07 03:39:05'),
(4, 'coba tambah mandiri', 650873, 1, 0, '2023-02-07 03:36:44', '2023-02-07 03:36:44'),
(5, 'tambah mandiri kedua', 396753, 1, 0, '2023-02-07 03:38:00', '2023-02-07 03:38:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `doorlock_histories`
--

CREATE TABLE `doorlock_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ruang` int(127) NOT NULL,
  `ruang` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `doorlock_histories`
--

INSERT INTO `doorlock_histories` (`id`, `id_ruang`, `ruang`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'lab iot', 'Superadmin', '123456', '2023-02-06 06:52:30', '2023-02-06 06:52:30'),
(2, 1, 'Lab Internet of Things', 'akses pertama saya', '823999', '2023-02-06 06:59:24', '2023-02-06 06:59:24'),
(3, 1, 'Lab Internet of Things', 'Superadmin', '123456', '2023-02-06 07:15:23', '2023-02-06 07:15:23'),
(4, 1, 'Lab Internet of Things', 'Superadmin', '123456', '2023-02-06 07:16:14', '2023-02-06 07:16:14'),
(5, 1, 'Lab Internet of Things', 'Superadmin', '123456', '2023-02-07 04:57:59', '2023-02-07 04:57:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `doorlock_states`
--

CREATE TABLE `doorlock_states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ruang` int(127) NOT NULL,
  `ruang` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(127) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `doorlock_states`
--

INSERT INTO `doorlock_states` (`id`, `id_ruang`, `ruang`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lab Internet of Things', 0, '2023-02-06 04:00:58', '2023-02-07 04:57:59'),
(3, 3851, 'ruang tambahan yan gtelah', 0, '2023-02-07 04:26:07', '2023-02-07 04:34:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `energies`
--

CREATE TABLE `energies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kwh` int(11) NOT NULL,
  `frekuensi` float NOT NULL,
  `arus` float NOT NULL,
  `tegangan` float NOT NULL,
  `active_power` float NOT NULL,
  `reactive_power` float NOT NULL,
  `apparent_power` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `energies`
--

INSERT INTO `energies` (`id`, `id_kwh`, `frekuensi`, `arus`, `tegangan`, `active_power`, `reactive_power`, `apparent_power`, `created_at`, `updated_at`) VALUES
(1, 1, 50, 0.9, 220, 1.99, 0.1, 9, '2023-01-11 20:34:46', '2022-11-15 06:21:52'),
(6, 1, 50, 0.9, 220, 500, 0.1, 9, '2022-11-17 00:58:29', '2022-11-17 00:58:29'),
(7, 2, 50, 0.9, 220, 2000, 0.1, 9, '2022-11-17 00:58:39', '2022-11-17 00:58:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `energy_costs`
--

CREATE TABLE `energy_costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `harga` double(8,2) NOT NULL,
  `pokok` int(11) NOT NULL,
  `delay` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `energy_costs`
--

INSERT INTO `energy_costs` (`id`, `harga`, `pokok`, `delay`, `created_at`, `updated_at`) VALUES
(1, 12.00, 1440, 30, '2022-10-14 06:54:47', '2022-11-11 07:55:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `energy_outlets`
--

CREATE TABLE `energy_outlets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `energy_outlets`
--

INSERT INTO `energy_outlets` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'node 1', 1, '2022-10-14 12:48:51', '2022-12-24 07:01:04'),
(2, 'node 2', 1, '2022-10-14 12:48:51', '2022-12-24 07:01:04'),
(3, 'node 3', 1, '2022-10-14 12:48:51', '2022-12-24 07:01:04'),
(4, 'node 4', 1, '2022-10-14 12:48:51', '2022-12-24 07:01:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `energy_outlet_masters`
--

CREATE TABLE `energy_outlet_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `energy_outlet_masters`
--

INSERT INTO `energy_outlet_masters` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'master', 1, '2022-10-14 12:48:16', '2022-12-24 07:01:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `energy_panels`
--

CREATE TABLE `energy_panels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `energy_panels`
--

INSERT INTO `energy_panels` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AC', 1, '2022-10-14 12:49:03', '2022-12-24 07:01:04'),
(5, 'Outlet Tambahan', 1, '2022-12-08 06:19:10', '2022-12-24 07:01:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `energy_panel_masters`
--

CREATE TABLE `energy_panel_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `energy_panel_masters`
--

INSERT INTO `energy_panel_masters` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'master', 1, '2022-10-14 12:48:58', '2022-12-24 07:01:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fire_alarms`
--

CREATE TABLE `fire_alarms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `fire_alarms`
--

INSERT INTO `fire_alarms` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'FireAlarm', 1, '2022-10-01 03:26:35', '2022-10-18 07:15:25'),
(4, 'Sensor Kebakaran Tambahan', 0, '2022-12-08 06:55:18', '2022-12-08 06:55:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `integrated_systems`
--

CREATE TABLE `integrated_systems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `integrated_systems`
--

INSERT INTO `integrated_systems` (`id`, `nama`, `link`, `deskripsi`, `created_at`, `updated_at`) VALUES
(4, 'Smart Building', 'http://si.ft.uns.ac.id/smartbuilding', 'Building Energy Management Systems (BEMS) are integrated and computerised systems for monitoring and controlling energy-related on the building such as lighting, power systems, air conditioning system, and so on. Real time remote monitoring and controlling as two key pillars to achieve the energy efficiency goals. We use several types of IoT communication protocols such as LoRa and WiFi. BEMS is one of the excellent researches in the field of IoT developed by the Electrical Engineering Study Program, Faculty of Engineering, Universitas Sebelas Maret.', '2022-11-15 06:25:58', '2022-11-15 06:25:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontrols`
--

CREATE TABLE `kontrols` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kontrols`
--

INSERT INTO `kontrols` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2022-10-11 02:07:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lights`
--

CREATE TABLE `lights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lights`
--

INSERT INTO `lights` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lampu Utama', 1, '2022-10-02 23:00:17', '2022-12-08 06:40:51'),
(4, 'Lampu Tambahan', 1, '2022-10-02 23:00:17', '2022-12-16 06:04:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `light_dimmers`
--

CREATE TABLE `light_dimmers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `light_dimmers`
--

INSERT INTO `light_dimmers` (`id`, `nama`, `status`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 'Dimmer', 1, 0, '2022-10-02 23:58:21', '2022-11-08 10:21:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `light_masters`
--

CREATE TABLE `light_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `light_masters`
--

INSERT INTO `light_masters` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-10-02 23:05:37', '2022-10-20 03:38:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2014_10_12_000000_create_users_table', 1),
(14, '2014_10_12_100000_create_password_resets_table', 1),
(15, '2019_08_19_000000_create_failed_jobs_table', 1),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(17, '2022_09_15_020631_create_dht_sensors_table', 1),
(18, '2022_09_22_060926_create_kontrols_table', 1),
(19, '2022_09_26_071737_create_fire_alarms_table', 1),
(20, '2022_09_28_043946_create_level_users_table', 1),
(21, '2022_10_02_112459_create_light_controls_table', 2),
(22, '2022_10_03_055254_create_lights_table', 3),
(23, '2022_10_03_060240_create_light_masters_table', 4),
(24, '2022_10_03_065248_create_light_dimmers_table', 5),
(25, '2022_10_05_033134_create_api_data_table', 6),
(26, '2022_10_12_134021_create_energies_table', 7),
(27, '2022_10_14_134325_create_energy_costs_table', 8),
(28, '2022_10_14_191614_create_energy_panel_masters_table', 9),
(29, '2022_10_14_191626_create_energy_panels_table', 9),
(30, '2022_10_14_191641_create_energy_outlet_masters_table', 9),
(31, '2022_10_14_191811_create_energy_outlets_table', 9),
(32, '2022_10_19_105329_create_cameras_table', 10),
(33, '2022_10_26_105117_create_pinpoints_table', 11),
(34, '2022_11_10_123349_create_dht_extras_table', 12),
(35, '2022_11_10_125820_create_dht_extra_data_table', 13),
(36, '2022_11_11_132129_create_integrated_systems_table', 14),
(37, '2022_11_15_173533_create_pinpoint_maps_table', 15),
(38, '2022_11_15_210023_create_abouts_table', 16),
(39, '2022_11_22_181539_create_dashboard_settings_table', 17),
(40, '2023_01_26_091945_create_doorlock_states_table', 18),
(41, '2023_01_26_092242_create_doorlock_accesses_table', 18),
(42, '2023_01_26_092304_create_doorlock_histories_table', 18),
(43, '2023_02_09_120208_create_plc_sipils_table', 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinpoints`
--

CREATE TABLE `pinpoints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `xpos` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ypos` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pinpoints`
--

INSERT INTO `pinpoints` (`id`, `id_nama`, `nama`, `xpos`, `ypos`, `created_at`, `updated_at`) VALUES
(4, 'dimmer', 'dimmer', '400px', '173px', NULL, '2022-11-16 06:47:25'),
(5, 'fire', 'fire alarm', '406px', '255px', NULL, '2022-11-16 06:47:30'),
(6, 'panel', 'panel', '700px', '385px', NULL, '2022-11-16 06:47:11'),
(7, 'camera', 'cctv', '700px', '0px', NULL, '2022-11-16 06:46:45'),
(8, 'dht', 'dht', '700px', '300px', NULL, '2022-11-16 06:46:22'),
(15, 'lampu', 'Lampu Utama1', '400px', '50px', '2022-11-16 06:47:49', '2022-11-16 06:48:22'),
(16, 'lampu', 'Lampu Utama2', '400px', '365px', '2022-11-16 06:48:35', '2022-11-16 06:48:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinpoint_maps`
--

CREATE TABLE `pinpoint_maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `map` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pinpoint_maps`
--

INSERT INTO `pinpoint_maps` (`id`, `map`, `created_at`, `updated_at`) VALUES
(2, '1668517775_800-800.jpg', '2022-11-15 13:09:35', '2022-11-15 13:09:35'),
(3, '1674049784_Desain tanpa judul (1).png', '2023-01-18 13:49:44', '2023-01-18 13:49:44'),
(4, '1674050172_1668517775_800-800.jpg', '2023-01-18 13:56:12', '2023-01-18 13:56:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `plc_sipils`
--

CREATE TABLE `plc_sipils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `distance` double NOT NULL,
  `forces` double NOT NULL,
  `gayatarik` double NOT NULL,
  `gayatekan` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `plc_sipils`
--

INSERT INTO `plc_sipils` (`id`, `distance`, `forces`, `gayatarik`, `gayatekan`, `created_at`, `updated_at`) VALUES
(1, 5, 10, 15, 20, '2023-02-13 04:49:59', '2023-02-13 04:49:59'),
(2, 5, 10, 15, 20, '2023-02-13 04:50:10', '2023-02-13 04:50:10'),
(3, 10, 0, 25, 15, '2023-02-13 04:51:29', '2023-02-13 04:51:29'),
(4, 15, 0, 0, 15, '2023-02-13 04:52:35', '2023-02-13 04:52:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Akun Admin', 'admin', 'admin@example.com', NULL, '$2y$10$bHbr8zvo853XXEwNoaN.3e4geRFYzVRyieQtteKGF/d9SZOFiOOXe', 'Admin', NULL, '2022-10-09 21:51:00', '2022-10-09 21:51:00'),
(6, 'Akun User', 'user', 'user@example.com', NULL, '$2y$10$XdYSRm42NYD9DcajVQQ6sOPEV0CDlCiFcMqMoTT.RM1AdiiJwUQzu', 'User', NULL, '2022-10-09 21:51:00', '2022-11-11 07:17:11'),
(7, 'Akun Developer', 'developer', 'developer@gmail.com', NULL, '$2y$10$XnubgdIYj6K27LhlOyP2heMGMTZenqX9uwZSXdVW5yOcBUzpsBjvm', 'Developer', NULL, '2022-10-09 21:51:00', '2022-10-25 04:48:44'),
(16, 'contoh12', 'contoh_developer12', 'contoh_developer@gmail.com', NULL, '$2y$10$G0UzNU0o/tou1pX5kWd2juFX1c4OLthdIKw9SLyORsUVchI4jNivy', 'Developer', NULL, '2022-10-18 12:29:29', '2022-10-18 12:30:01'),
(18, 'Guest', 'guest', 'guest@guest.com', NULL, '$2y$10$zZE69K0CiRJ7ImTi/DHmauCf6600.w/p.3Usv8bt42rGWfFSWwZHm', 'User', NULL, '2022-10-20 05:34:40', '2022-10-20 05:34:40');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `api_data`
--
ALTER TABLE `api_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cameras`
--
ALTER TABLE `cameras`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dashboard_settings`
--
ALTER TABLE `dashboard_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dht_extras`
--
ALTER TABLE `dht_extras`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dht_extra_data`
--
ALTER TABLE `dht_extra_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dht_sensors`
--
ALTER TABLE `dht_sensors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `doorlock_accesses`
--
ALTER TABLE `doorlock_accesses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `doorlock_histories`
--
ALTER TABLE `doorlock_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `doorlock_states`
--
ALTER TABLE `doorlock_states`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `energies`
--
ALTER TABLE `energies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `energy_costs`
--
ALTER TABLE `energy_costs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `energy_outlets`
--
ALTER TABLE `energy_outlets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `energy_outlet_masters`
--
ALTER TABLE `energy_outlet_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `energy_panels`
--
ALTER TABLE `energy_panels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `energy_panel_masters`
--
ALTER TABLE `energy_panel_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `fire_alarms`
--
ALTER TABLE `fire_alarms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `integrated_systems`
--
ALTER TABLE `integrated_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kontrols`
--
ALTER TABLE `kontrols`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lights`
--
ALTER TABLE `lights`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `light_dimmers`
--
ALTER TABLE `light_dimmers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `light_masters`
--
ALTER TABLE `light_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pinpoints`
--
ALTER TABLE `pinpoints`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pinpoint_maps`
--
ALTER TABLE `pinpoint_maps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `plc_sipils`
--
ALTER TABLE `plc_sipils`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `api_data`
--
ALTER TABLE `api_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `cameras`
--
ALTER TABLE `cameras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `dashboard_settings`
--
ALTER TABLE `dashboard_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `dht_extras`
--
ALTER TABLE `dht_extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `dht_extra_data`
--
ALTER TABLE `dht_extra_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `dht_sensors`
--
ALTER TABLE `dht_sensors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `doorlock_accesses`
--
ALTER TABLE `doorlock_accesses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `doorlock_histories`
--
ALTER TABLE `doorlock_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `doorlock_states`
--
ALTER TABLE `doorlock_states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `energies`
--
ALTER TABLE `energies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `energy_costs`
--
ALTER TABLE `energy_costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `energy_outlets`
--
ALTER TABLE `energy_outlets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `energy_outlet_masters`
--
ALTER TABLE `energy_outlet_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `energy_panels`
--
ALTER TABLE `energy_panels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `energy_panel_masters`
--
ALTER TABLE `energy_panel_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fire_alarms`
--
ALTER TABLE `fire_alarms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `integrated_systems`
--
ALTER TABLE `integrated_systems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kontrols`
--
ALTER TABLE `kontrols`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `lights`
--
ALTER TABLE `lights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `light_dimmers`
--
ALTER TABLE `light_dimmers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `light_masters`
--
ALTER TABLE `light_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pinpoints`
--
ALTER TABLE `pinpoints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pinpoint_maps`
--
ALTER TABLE `pinpoint_maps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `plc_sipils`
--
ALTER TABLE `plc_sipils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
