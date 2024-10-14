<?php

$conn = mysqli_connect("localhost", "root", "", "penyakit_kulit");

// Mengatur zona waktu
date_default_timezone_set('Asia/Jakarta');


// Fungsi untuk mengambil nilai dalam tabel
function query($query)
{
	global $conn;

	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}


// Fungsi untuk tambah data
function tambahPenyakit($data)
{
	global $conn;

	$kd_penyakit = htmlspecialchars($data["kd_penyakit"]);
	$nama_penyakit = htmlspecialchars($data["nama_penyakit"]);

	$query = "INSERT INTO penyakit 
            VALUES 
            ('$kd_penyakit', '$nama_penyakit') 
          ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambahGejala($data)
{
	global $conn;

	$kd_gejala = htmlspecialchars($data["kd_gejala"]);
	$nama_gejala = htmlspecialchars($data["nama_gejala"]);

	$query = "INSERT INTO gejala 
            VALUES 
            ('$kd_gejala', '$nama_gejala') 
          ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambahAturan($data)
{
	global $conn;

	$kd_aturan = generateRuleCode();
	$kd_penyakit = htmlspecialchars($data["kd_penyakit"]);
	$kd_gejala = htmlspecialchars($data["kd_gejala"]);

	$query = "INSERT INTO aturan 
            VALUES 
            ('$kd_aturan', '$kd_penyakit', '$kd_gejala') 
          ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function tambahLaporan($data)
{
	global $conn;

	$kd_laporan = generateReportCode();
	$kd_pengguna = $data['kd_pengguna'];
	$kd_diagnosa = $data['kd_diagnosa'];
	$kd_penyakit = $data['kd_penyakit'];
	$tanggal = date('Y-m-d');
	$hari = date('l');
	$waktu = date('H:i:s');

	$query = "INSERT INTO laporan_hasil_diagnosa 
            VALUES 
            ('$kd_laporan', '$kd_pengguna', '$kd_diagnosa', '$kd_penyakit', '$tanggal', '$hari', '$waktu') 
          ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


// Fungsi untuk ubah data
function ubahPenyakit($data)
{
	global $conn;

	$kd_penyakit = htmlspecialchars($data["kd_penyakit"]);
	$nama_penyakit = htmlspecialchars($data["nama_penyakit"]);

	$query = "UPDATE penyakit SET 
            kd_penyakit = '$kd_penyakit',
            nama_penyakit = '$nama_penyakit'
            WHERE kd_penyakit = '$kd_penyakit'
          ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahGejala($data)
{
	global $conn;

	$kd_gejala = htmlspecialchars($data["kd_gejala"]);
	$nama_gejala = htmlspecialchars($data["nama_gejala"]);

	$query = "UPDATE gejala SET 
            kd_gejala = '$kd_gejala',
            nama_gejala = '$nama_gejala'
            WHERE kd_gejala = '$kd_gejala'
          ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahAturan($data)
{
	global $conn;

	$kd_aturan = htmlspecialchars($data["kd_aturan"]);
	$kd_penyakit = htmlspecialchars($data["kd_penyakit"]);
	$kd_gejala = htmlspecialchars($data["kd_gejala"]);

	$query = "UPDATE aturan SET
						kd_aturan = '$kd_aturan',
            kd_penyakit = '$kd_penyakit',
            kd_gejala = '$kd_gejala'
            WHERE kd_aturan = '$kd_aturan'
          ";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahPengguna($data)
{
	global $conn;

	$kd_pengguna = $data["kd_pengguna"];
	$nama = ucwords(htmlspecialchars($data["nama"]));
	$tempat_lahir = ucwords(htmlspecialchars($data["tempat_lahir"]));
	$tanggal_lahir = $data["tanggal_lahir"];
	$alamat = ucwords(htmlspecialchars($data["alamat"]));
	$jenis_kelamin = $data["jenis_kelamin"];
	$no_telepon = htmlspecialchars($data["no_telepon"]);
	$email = htmlspecialchars($data["email"]);
	$emailLama = htmlspecialchars($data["emailLama"]);
	$username = strtolower(stripslashes($data["username"]));
	$usernameLama = strtolower(stripslashes($data["usernameLama"]));

	$errorMessage = '';
	if ($username !== $usernameLama) {
		$query = "SELECT * FROM pengguna WHERE username='$username'";
		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result) > 0) {
			$username = $usernameLama;
			$errorMessage = "Username sudah digunakan!";
		} else {
			$username = strtolower(stripslashes($data["username"]));
		}
	}

	if ($email !== $emailLama) {
		$query = "SELECT * FROM pengguna WHERE email='$email'";
		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result) > 0) {
			$email = $emailLama;
			$errorMessage = "Email sudah digunakan!";;
		} else {
			$email = strtolower(stripslashes($data["email"]));
		}
	}

	if (!empty($errorMessage)) {
		$_SESSION['errorMessage'] = $errorMessage;
		header("Location: data-user.php?kd_pengguna=" . $data["kd_pengguna"]);
		exit();
	}

	$query = "UPDATE pengguna SET
						nama = '$nama',
						tempat_lahir = '$tempat_lahir',
						tanggal_lahir = '$tanggal_lahir',
						alamat = '$alamat',
						jenis_kelamin = '$jenis_kelamin',
						no_telepon = '$no_telepon',
						email = '$email',
						username = '$username'
						WHERE kd_pengguna = '$kd_pengguna'
						";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


// Fungsi untuk hapus data
function hapusPenyakit($kd_penyakit)
{
	global $conn;

	mysqli_query($conn, "DELETE FROM penyakit WHERE kd_penyakit = '$kd_penyakit'");

	return mysqli_affected_rows($conn);
}

function hapusGejala($kd_gejala)
{
	global $conn;

	mysqli_query($conn, "DELETE FROM gejala WHERE kd_gejala = '$kd_gejala'");

	return mysqli_affected_rows($conn);
}

function hapusAturan($kd_aturan)
{
	global $conn;

	mysqli_query($conn, "DELETE FROM aturan WHERE kd_aturan = '$kd_aturan'");

	return mysqli_affected_rows($conn);
}


// Fungsi untuk membuat cookie pada login
function setLoginCookieWithRemember($kd_pengguna, $username, $level)
{
	$time = time() + (86400 * 2);

	setcookie('kd_pengguna', $kd_pengguna, $time, "/");
	setcookie('username', hash('sha256', $username), $time, "/");
	setcookie('level', $level, $time, "/");
}

function setLoginCookieWithoutRemember($kd_pengguna, $username, $level)
{
	$time = 0;

	setcookie('kd_pengguna', $kd_pengguna, $time, "/");
	setcookie('username', hash('sha256', $username), $time, "/");
	setcookie('level', $level, $time, "/");
}

function removeLoginCookie()
{
	setcookie('kd_pengguna', '', time() - 3600, "/");
	setcookie('username', '', time() - 3600, "/");
	setcookie('level', '', time() - 3600, "/");
}


// Fungsi untuk membuat pengguna baru
function registrasiUser($data)
{
	global $conn;

	$kd_pengguna = generateUserCode();
	$nama = htmlspecialchars($data["nama"]);
	$tempat_lahir = "";
	$tanggal_lahir = "";
	$alamat = "";
	$jenis_kelamin = "";
	$no_telepon = "";
	$email = htmlspecialchars($data["email"]);
	$bergabung_sejak = getJoinDuration($data["bergabung_sejak"]);
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$level = "user";

	/* $password = password_hash($password, PASSWORD_DEFAULT); */

	mysqli_query($conn, "INSERT INTO pengguna VALUES('$kd_pengguna', '$nama', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$jenis_kelamin', '$no_telepon', '$email', '$bergabung_sejak', '$username', '$password', '$level')");

	return mysqli_affected_rows($conn);
}

function isUsernameAvailable($username)
{
	global $conn;

	$username = strtolower(stripslashes($username));

	$result = mysqli_query($conn, "SELECT username FROM pengguna WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)) {
		return true;
	}
}

function isEmailRegistered($email)
{
	global $conn;

	$email = strtolower(stripslashes($email));

	$result = mysqli_query($conn, "SELECT email FROM pengguna WHERE email = '$email'");

	if (mysqli_fetch_assoc($result)) {
		return true;
	}
}

function validatePassword($password)
{
	$minLength = 6;

	if (strlen($password) < $minLength) {
		return true;
	}
}


// Fungsi untuk membuat bergabung sejak
function getJoinDuration($joinDate)
{
	// Get the current date
	$currentDate = date('Y-m-d');

	// Convert the join date and current date to DateTime objects
	$joinDateObj = new DateTime($joinDate);
	$currentDateObj = new DateTime($currentDate);

	// Calculate the interval between the join date and the current date
	$interval = $joinDateObj->diff($currentDateObj);

	// Format the interval
	$years = $interval->y;
	$months = $interval->m;
	$days = $interval->d;

	// Construct the duration string
	$duration = "";
	if ($years > 0) {
		$duration .= $years . " year" . ($years > 1 ? "s" : "") . ", ";
	}
	if ($months > 0) {
		$duration .= $months . " month" . ($months > 1 ? "s" : "") . ", ";
	}
	$duration .= $days . " day" . ($days > 1 ? "s" : "") . " ago";

	return $duration;
}


// Fungsi untuk membuat kode pengguna
function generateUserCode()
{
	$codeLength = 16;
	$characters = '0123456789abcde';
	$code = '';

	for ($i = 0; $i < $codeLength; $i++) {
		$code .= $characters[rand(0, strlen($characters) - 1)];
	}

	return $code;
}


// Fungsi untuk membuat kode aturan
function generateRuleCode()
{
	$codeLength = 4;
	$characters = '123456';
	$code = 'r';

	for ($i = 0; $i < $codeLength; $i++) {
		$code .= $characters[rand(0, strlen($characters) - 1)];
	}

	return $code;
}


// Fungsi untuk membuat kode diagnosa
function generateDiagnoseCode()
{
	$codeLength = 6;
	$characters = '123456';
	$code = 'd';

	for ($i = 0; $i < $codeLength; $i++) {
		$code .= $characters[rand(0, strlen($characters) - 1)];
	}

	return $code;
}


// Fungsi untuk membuat kode laporan
function generateReportCode()
{
	$codeLength = 16;
	$characters = '0123456789abcdefghijklmn';
	$code = 'l';

	for ($i = 0; $i < $codeLength; $i++) {
		$code .= $characters[rand(0, strlen($characters) - 1)];
	}

	return $code;
}


// Fungsi untuk menentukan kelas aktif
function isActiveAdmin($page, $current_page)
{
	if ($page === $current_page) {
		return 'active';
	} else {
		return '';
	}
}

function isActiveUser($page, $current_page)
{
	if ($page === $current_page) {
		return '';
	} else {
		return 'collapsed';
	}
}


// Fungsi isChecked form
function isChecked($value, $selectedOption)
{
	if ($value == $selectedOption) {
		return 'checked';
	} else {
		return '';
	}
}


// Fungsi isSelected form
function isSelected($value, $selectedOption)
{
	if ($value == $selectedOption) {
		return 'Selected';
	} else {
		return '';
	}
}
