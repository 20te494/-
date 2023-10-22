<?php

// 可能需要根据服务器配置调整最大执行时间
set_time_limit(0);  // 0 表示无时间限制

// Mastodon API 身份验证和配置信息
$accessToken = 'Kj5Pil0zEcJhJd__SUTEW0G2WOrPpgUXWnS1NOxYt3E';
$instanceUrl = 'https://mstdn.ditu.jp/';

// 读取 cco3.json 文件内容
$data = file_get_contents("cco3.json");
$jsonObjects = json_decode($data, true);

// 发送每一个 JSON 对象到 Mastodon
foreach ($jsonObjects as $jsonObject) {
    $statusText = json_encode($jsonObject);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$instanceUrl/api/v1/statuses");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'status' => $statusText,
        'visibility' => 'public'  // 'unlisted', 'private', or 'direct' based on your choice
    ]);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $accessToken",
        "User-Agent: YourAppName/1.0"
    ]);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        // 如果发生错误，不等待直接跳到下一个循环
        continue;
    }
    curl_close($ch);

    // 等待10秒
    sleep(10);
}
?>
