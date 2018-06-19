<?php
  require '/home/pavel/phpspreadsheet/vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\IOFactory;

  $inputfileSettlements = '/home/pavel/Desktop/Ekatte/Ekatte_xls/Ek_atte.xls';
  $inputfileMunicipalities = "/home/pavel/Desktop/Ekatte/Ekatte_xls/Ek_obst.xls";
  $inputfileProvinces = "/home/pavel/Desktop/Ekatte/Ekatte_xls/Ek_obl.xls";

  $spreadsheet = IOFactory::load($inputfileProvinces);
  $sheetDataProvices = $spreadsheet->getActiveSheet()->toArray();

  $spreadsheet = IOFactory::load($inputfileMunicipalities);
  $sheetDataMunicipalities = $spreadsheet->getActiveSheet()->toArray();

  $spreadsheet = IOFactory::load($inputfileSettlements);
  $sheetDataSettlements = $spreadsheet->getActiveSheet()->toArray();

  $connect = mysqli_connect("localhost","root","***","ekatte");
  if(!$connect){
    echo "Connection to DB failed!<br>";
    exit(1);
  }
  mysqli_query($connect,"SET NAMES 'UTF8'");

  for ($i = 1; $i < sizeof($sheetDataProvices); $i++) {
    $query = "INSERT INTO provinces(Code,Name) VALUES('" . $sheetDataProvices[$i][0] . "','" . $sheetDataProvices[$i][2] . "')";
      mysqli_query($connect,$query);
  }

  for ($i=1; $i < sizeof($sheetDataMunicipalities) ; $i++) {
    $query = "INSERT INTO municipalities(Code,Name,Province) VALUES('" . $sheetDataMunicipalities[$i][0] . "','" . $sheetDataMunicipalities[$i][2] . "','" . substr($sheetDataMunicipalities[$i][0],0,3) . "')";
    mysqli_query($connect,$query);
  }

  for ($i=2; $i < sizeof($sheetDataSettlements) ; $i++) {
    $query = "INSERT INTO settlements(Ekatte,Name,Type,Municipality) VALUES('" . $sheetDataSettlements[$i][0] . "','" . $sheetDataSettlements[$i][2] . "','" . $sheetDataSettlements[$i][1] . "','" . $sheetDataSettlements[$i][4] . "')";
    mysqli_query($connect,$query);
  }
  mysqli_close($connect);
 ?>
