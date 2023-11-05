<?php
// 假定JSON文件位于同一目录中命名为cco3.json
$json_file = 'cco3.json';

// 读取文件内容
$json_data = file_get_contents($json_file);

// 解析JSON数据
$readings = json_decode($json_data, true);

if (!is_array($readings)) {
    die("Error reading JSON data.");
}

// 开始HTML输出
echo "<html><body>";
echo "<h1>教室二氧化碳浓度读数</h1>";

// 遍历读数数据
foreach ($readings as $reading) {
    echo "<p><strong>时间：</strong>" . $reading['datetime'] . "</p>";
    echo "<ul>";
    foreach ($reading as $key => $value) {
        // 排除datetime键，只列出教室读数
        if ($key != 'datetime') {
            echo "<li>" . htmlspecialchars($key) . ": " . htmlspecialchars($value) . " ppm</li>";
        }
    }
    echo "</ul>";
}

echo "</body></html>";
?>
