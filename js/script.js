
document.getElementById('btnExport').addEventListener('click', function() {
    var table = document.getElementById('treinamentos-tabela');
    var wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
    XLSX.writeFile(wb, "treinamentos.xlsx");
});