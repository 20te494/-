<?php
// Mastodon API 的 URL
$apiUrl = "https://mstdn.ditu.jp/api/v1/timelines/public";

// 访问令牌
$accessToken = "KYAQTiZyCUkS7SDeI_ySUBeVXeo4JWE4SczuqAlzd94";

// 使用 cURL 初始化 HTTP GET 请求
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// 设置 HTTP 头字段
$headers = [
    'Authorization: Bearer ' . $accessToken,
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// 执行 cURL 会话
$response = curl_exec($ch);

// 检查是否有错误发生
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    exit();
}

// 关闭 cURL 资源
curl_close($ch);

// 解码响应的 JSON 数据
$statuses = json_decode($response, true);

// 检查解码是否成功
if (json_last_error() !== JSON_ERROR_NONE) {
    echo 'JSON 解析错误';
    exit();
}

// 遍历并显示嘟文
foreach ($statuses as $status) {
    echo "<div style='margin-bottom: 20px;'>";
    echo "<div><strong>" . htmlspecialchars($status['account']['display_name'], ENT_QUOTES, 'UTF-8') . "</strong> @" . htmlspecialchars($status['account']['username'], ENT_QUOTES, 'UTF-8') . "</div>";
    echo "<div>" . htmlspecialchars($status['content'], ENT_QUOTES, 'UTF-8') . "</div>";
    echo "</div>";
}
?>
