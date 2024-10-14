<?php
require '../functions.php';

// include("dbconnect.php");
// $con = mysqli_connect("localhost","dbuser","dbpass","dbname");
// $mysqli = new mysqli( "localhost","dbuser","dbpass","dbname");
$limit = $_POST['length'];
$start = $_POST['start'];
// Ambil parameter pengurutan dari DataTables

// $filterstatus = strip_tags(addslashes(trim($_POST["filterstatus"]))); 

$column_index = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : '0';
$column_dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';

// Nama kolom yang digunakan untuk pengurutan
$columns = array('id', 'id', 'id', 'nama');
$order_by_column = $columns[$column_index];

$querydata = "SELECT * FROM dummy";
$query = mysqli_query($conn, $querydata);

// Hit data awal
$querycount = mysqli_num_rows($query); 
$totalData = $querycount;
$totalFiltered = $totalData;

// Get Data Awal
if(empty($_POST['search']['value'])) {
    $querydata .= " ORDER BY $order_by_column $column_dir ";  
    $querydata .= " LIMIT $limit OFFSET $start ";  
    $query = mysqli_query($conn, $querydata);
}
else {
    $search = $_POST['search']['value'];
    $querydata .= " AND (dummy.nama LIKE '%$search%' OR ) ";
    $querydata .= " ORDER BY $order_by_column $column_dir LIMIT 20";
    $query = mysqli_query($conn, $querydata);
    $totalData = 1;
    $totalFiltered = 1;
}
$data = array();
if(!empty($query)) {
    $no = $start + 1;
    foreach($query as $row) {
        $noo=$no++;

        $nestedData['No'] = $noo;
        $nestedData['Aksi'] = "
            <a href=\"ubah-gejala.php?kd_gejala=" . $row['id'] . "\" class=\"btn btn-success btn-sm\">Ubah</a> |
            <a href=\"hapus-gejala.php?kd_gejala=" . $row['id'] . "\" class=\"btn btn-danger btn-sm\">Hapus</a>
        ";
        $nestedData['ID'] = $row['id'];
        $nestedData['Nama'] = ucwords(strtolower($row['nama']));

        $data[] = $nestedData;
    }
}
$json_data = array(
    "draw"            => intval($_POST['draw']),  
    "recordsTotal"    => intval($totalData),  
    "recordsFiltered" => intval($totalFiltered), 
    "data"            => $data
);
echo json_encode($json_data); 
?>