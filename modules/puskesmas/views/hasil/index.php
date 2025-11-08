<?php get_header() ?>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0">Hasil</p>
        <div class="right-button ms-auto">
            <button class="btn btn-success" onclick="tableToExcel('myTable', 'Data Hasil')">Download Excel</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="myTable">
            <tr>
                <th width="1%">Rank</th>
                <th>Puskesmas</th>
                <th>Skor</th>
                <th>Label</th>
                <th></th>
            </tr>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?=$result['rank']?></td>
                <td><?=$result['alternative']?></td>
                <td>0.<?=str_replace('.','',number_format($result['score'] * 100, 5))?></td>
                <td><?=$result['label']?></td>
                <td>
                    <a href="<?=routeTo('puskesmas/penilaian/edit', ['id' => $result['id']])?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?=routeTo('puskesmas/penilaian/delete', ['id' => $result['id']])?>" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<script>
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><?xml version="1.0" encoding="UTF-8" standalone="yes"?><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
      if (!table.nodeType) table = document.getElementById(table)
      var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
<?php get_footer() ?>
