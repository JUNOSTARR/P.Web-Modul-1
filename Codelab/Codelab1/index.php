<?php

$n = 5;

for($i = 1; $i <= $n; $i++) { for($j = $i; $j < $n; $j++) {
    echo "&nbsp;&nbsp;";
}
for($k = 1; $k <= (2 * $i - 1); $k++) {
    echo "*";
}
echo "<br>";
}


for($i = $n; $i >= 1; $i--) {
    // Cetak spasi
    for($j = $n; $j > $i; $j--) {
        echo "&nbsp;&nbsp;";
    }
    // Cetak bintang
    for($k = 1; $k <= (2 * $i - 1); $k++) {
        echo "*";
    }
    echo "<br>";
}
?>