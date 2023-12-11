<?php
// 세션 시작
session_start();

include 'db_config.php';

// 로그인한 상태면 세션에서 사용자명 가져오기
$loggedInUser = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// 편지 업로드 버튼 초기화
$uploadButton = '';

// 로그인한 상태에서만 편지 업로드 버튼 표시
if ($loggedInUser) {
    $uploadButton = '<button type="submit">편지 업로드</button>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christmas Web Server</title>
    <link rel="stylesheet" href="css/index.css"
</head>
<body>
    <header>
        <div>
            <?php
            if ($loggedInUser) {
                // 로그인한 상태에서만 로그아웃 버튼 표시
                echo "<span>환영합니다, $loggedInUser 님!</span>";
                echo '<form action="logout.php" method="post">';
                echo '<button type="submit">로그아웃</button>';
                echo '</form>';
            } else {
                // 로그아웃 상태에서만 로그인 버튼 표시
                echo '<button onclick="location.href=\'login.php\'">로그인</button>';


            }
            ?>
        </div>
        <div>
            <h1>Waiting for Christmas&nbsp&nbsp</h1>
        </div>
    </header>

    

    <!-- 롤링페이퍼(편지) -->
    <main>
        <div id="letterContainer">
            <?php
                // 편지 목록 가져오기
                $sql = "SELECT * FROM Letters";
                $result = $conn->query($sql);

                // 편지 표시
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="letter">';
                    echo '<p>' . $row['content'] . '</p>';
                    echo '<img src="' . $row['image_path'] . '" alt="">';
                    echo '<hr>';
                    echo '<p class="username">작성자: ' . $row['username'] . '</p>'; // 작성자의 유저네임 표시
                // 삭제 링크를 로그인한 상태에서만 보이게 함
                if ($loggedInUser && $row['username'] === $loggedInUser) {
                    echo '<a href="delete.php?id=' . $row['id'] . '">편지 삭제</a>';
                }
                    echo '</div>';
                }
            ?>
        </div>

        <div id="uploadContainer">
            <?php
            // 로그인한 상태에서만 편지 업로드 폼 표시
            if ($loggedInUser) {
                echo '<h2>새로운 편지 작성</h2>';
                echo '<form action="upload.php" method="post" enctype="multipart/form-data">';
                echo '<textarea name="newLetterContent" placeholder="새로운 편지 내용을 입력하세요"></textarea>';
                echo '<input type="file" name="uploadImage" accept="image/*">';
                echo '<button type="submit">편지 업로드</button>';
                echo '</form>';
            } else {
                echo '<p>로그인 후에 편지를 작성할 수 있습니다.</p>';
            }
            ?>
        </div>
    </main>

    
    <!-- 왼쪽 사이드바 -->
    <div id="mp3Player">
        
        <h1>Chrismas Music</h1>
        <audio id="audio">오류</audio>
        <img id="lpImage" src="LP.gif" alt="LP">
        <button onclick="playNext()">Next</button>
        <button onclick="togglePlayPause()">Play/Pause</button>
    </div>
    <script src="js/music.js"></script>
    
    <!-- 오른쪽 사이드바 -->
    <div id="chat">
    <h3>크리스마스를<br>기다리는 사람들</h3>
    <?php
    // 가입된 회원 목록 가져오기
    $sqlMembers = "SELECT * FROM Users";
    $resultMembers = $conn->query($sqlMembers);

    // 회원 목록 표시
    echo '<ul>';
    while ($rowMember = $resultMembers->fetch_assoc()) {
        echo '<li>' . $rowMember['username'] . '</li>';
    }
    echo '</ul>';
    ?>
    </div>

    <footer>
        &copy; 2023 Made By TechN0 
	<a href="http://192.168.116.128/xe/">&nbspXE로 제작한 프로토타입 보러가기 
    </footer>
    <!-- 마우스기능 -->
    <div class="fly">
        <img src="./butterfly.gif" alt="">
    </div>
    <script src="js/mouse.js"></script>
</body>
</html>

<?php
// 데이터베이스 연결 닫기
$conn->close();
?>


