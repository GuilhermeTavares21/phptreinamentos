<?php
require 'db.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$data_inicial = isset($_GET['data_inicial']) ? $_GET['data_inicial'] : '';
$data_final = isset($_GET['data_final']) ? $_GET['data_final'] : '';
$sql = 'SELECT * FROM treinamentos WHERE 1=1';
$params = [];

if ($search) {
    $sql .= ' AND (nome_treinamento LIKE ? OR entidade LIKE ? OR tecnico LIKE ?)';
    $params[] = '%' . $search . '%';
    $params[] = '%' . $search . '%';
    $params[] = '%' . $search . '%';
}

if ($data_inicial) {
    $sql .= ' AND data_inicial >= ?';
    $params[] = $data_inicial;
}

if ($data_final) {
    $sql .= ' AND data_final <= ?';
    $params[] = $data_final;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$treinamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Treinamentos');

// Set column headers
$headers = ['ID', 'Nome do Treinamento', 'Responsável', 'Entidade', 'Horas', 'Data Inicial', 'Data Final'];
$sheet->fromArray($headers, NULL, 'A1');

// Populate spreadsheet with data
$sheet->fromArray($treinamentos, NULL, 'A2');

// Output the spreadsheet
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="treinamentos.xlsx"');
header('Cache-Control: max-age=0');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
