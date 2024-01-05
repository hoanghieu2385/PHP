<?php

// mảng chua thong tin sinh vien
$sinhVien = array(
    array("ten" => "Nguyen Van A", "tuoi" => 20, "diem" => 85),
    array("ten" => "Tran Thi B", "tuoi" => 21, "diem" => 75),
    array("ten" => "Le Van C", "tuoi" => 22, "diem" => 90),
);

// In thong tin cua tung sinh vien
foreach ($sinhVien as $sv) {
    echo "Ten:" . $sv["ten"]. "<br>";
    echo "Tuoi:" . $sv["tuoi"]. "<br>";
    echo "Diem:" . $sv["diem"]. "<br>";

    // kiem tra diem va dua ra danh gia
    if ($sv["diem"] >= 80) {
        echo "Danh gia: Xuat sac <br>";
    } elseif ($sv["diem"] >= 70) {
        echo "Danh gia: Kha <br>";
    } elseif ($sv["diem"] >= 60) {
        echo "Danh gia: Yeu <br>";
    } else {
        echo "Danh gia: Yeu <br>";
    }
    echo "<hr>";
}

// Tinh diem trung binh cua tat ca sinh vien
$tongDiem = 0;
foreach ($sinhVien as $sv) {
    $tongDiem += $sv["diem"];
}

$diemTrungBinh = $tongDiem / count($sinhVien);
echo "Diem trung binh cua lop la: ".$diemTrungBinh;

?>
