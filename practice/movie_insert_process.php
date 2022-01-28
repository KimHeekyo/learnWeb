<?php
    require "./util/db.php";

    $upload_path = "./poster/";

    $m_title = $_POST['m_title'];
    $m_director = $_POST['m_director'];
    $m_date = $_POST['m_date'];
    $m_genre = $_POST['m_genre'];
    $m_country = $_POST['m_country'];
    $m_time = $_POST['m_time'];
    $m_story = $_POST['m_story'];
    $m_audience = $_POST['m_audience'];

    if(is_uploaded_file($_FILES['m_poster']['tmp_name'])) {

        $m_filename = time()."_".$_FILES['m_poster']['name'];

    if(move_uploaded_file($_FILES['m_poster']['tmp_name'], $upload_path.$m_filename)) {
        if(DBG) echo outmsg(UPLOAD_SUCCESS);

        $stmt = $conn->prepare("INSERT INTO movie(m_title, m_director, m_date,  m_genre, m_country, m_time, m_story, m_audience, m_poster) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $m_title, $m_director, $m_date, $m_genre, $m_country, $m_time, $m_story, $m_audience, $m_filename);
        }
    }

    $stmt->execute();

    $stmt->close();
    $conn->close();

    echo outmsg(COMMIT_CODE);
    echo "<a href='./main.php'>메인화면</a>";
?>