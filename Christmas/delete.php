<?php
session_start();

include 'db_config.php';

// 로그인한 상태면 세션에서 사용자명 가져오기
$loggedInUser = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// 편지 삭제
if ($loggedInUser && isset($_GET['id'])) {
    $letterId = $_GET['id'];
    
    // 작성자와 로그인한 사용자가 동일한 경우에만 삭제
    $sql = "DELETE FROM Letters WHERE id = $letterId AND username = '$loggedInUser'";
    
    if ($conn->query($sql) === TRUE) {
        echo "편지가 성공적으로 삭제되었습니다.";
    } else {
        echo "편지 삭제 중 오류 발생: " . $conn->error;
    }
} else {
    echo "자신이 작성한 편지만 삭제할 수 있습니다.";
}

// 데이터베이스 연결 닫기
$conn->close();
?>

