<?php
$json_file = 'cco3.json';
$json_data = file_get_contents($json_file);
$readings = json_decode($json_data, true);

if (!is_array($readings)) {
    die("Error reading JSON data.");
}

// 假定背景二氧化碳浓度
$background_co2 = 400; // 假设室外400 ppm
// 假定每人每小时产生的二氧化碳量
$co2_per_person_per_hour = 0.1; // 人均每小时0.005 m³ CO2太小了改成0.1
// 教室体积
$room_volume = 8 * 15 * 3.5; // 单位为立方米

echo "<html><body>";
echo "<h1>161教室每天的人数估算</h1>";

foreach ($readings as $reading) {
    // 获取特定时间点的二氧化碳读数
    $co2_reading = $reading['161 CO2'] ?? 0; // 容错处理，如果没有161 CO2数据则默认为0
    // 计算人数
    $people_count = ($co2_reading - $background_co2) / ($co2_per_person_per_hour * $room_volume);
    echo "<p><strong>时间：</strong>" . $reading['datetime'] . "</p>";
    echo "<p><strong>估算人数：</strong>" . round($people_count) . "</p>"; // 四舍五入到最近的整数
}

echo "</body></html>";
?>
