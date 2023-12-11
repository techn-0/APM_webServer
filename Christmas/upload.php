<?php
session_start();

include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["newLetterContent"])) {
    $newLetterContent = $_POST["newLetterContent"];
    $username = $_SESSION["username"];

     // 파일 업로드 처리
     $targetDir = "uploads/"; // 업로드된 파일을 저장할 디렉토리
     $targetFile = $targetDir . basename($_FILES["uploadImage"]["name"]); // 업로드된 파일 경로
    if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $targetFile)) {
        echo "The letter and image have been uploaded successfully.";
    }
    else {
        echo "Error uploading file.";
    }

    $sql = "INSERT INTO Letters (username, content, image_path) VALUES ('$username', '$newLetterContent', '$targetFile')";
    if ($conn->query($sql) === TRUE) {
        echo "The letter has been uploaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
// 메인 페이지로 리다이렉션
header("Location: index.php");
exit();
?>

