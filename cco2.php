<?php

// 读取数据
$data = file_get_contents("cco2.json");

// 使用换行符分割数据到数组中，每一行应该包含一个 JSON 对象
$jsonStrings = explode(PHP_EOL, trim($data));

// 创建一个数组来存储解析后的 JSON 数据
$jsonData = [];

// 遍历每一个 JSON 字符串，并将其解析后的对象添加到数组中
foreach ($jsonStrings as $jsonString) {
    $jsonObject = json_decode($jsonString, true);
    if (json_last_error() === JSON_ERROR_NONE) { // 判断是否解析成功
        $jsonData[] = $jsonObject;
    } else {
        echo "JSON 解析错误在: $jsonString. 错误信息: " . json_last_error_msg();
    }
}

// 将 JSON 数组编码回 JSON 格式的字符串
$jsonOutput = json_encode($jsonData, JSON_PRETTY_PRINT);

// 输出或保存到文件
echo $jsonOutput;
file_put_contents("cco3.json", $jsonOutput);

?>
