<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>영화등록</h1>
    <form action="movie_insert_process.php" method="POST" enctype="multipart/form-data">
        <label>제목 : <input type="text" name="m_title" /></label><br><br>
        <label>감독 : <input type="text" name="m_director" /></label><br><br>
        <label>개봉일 : <input type="text" name="m_date" /></label><br><br>
        <label>장르 : <input type="text" name="m_genre" /></label><br><br>
        <label>국가 : <input type="text" name="m_country" /></label><br><br>
        <label>러닝타임 : <input type="text" name="m_time" /></label><br><br>
        <label>내용<br><br><textarea name="m_story" cols="85" rows="15"></textarea></label><br><br>
        <label>배급 : <input type="text" name="m_audience" /></label><br><br>
        <label>영화포스터<br><br><input type="file" name="m_poster"></label><br><br>
        <input type="submit" value="등록">
    </form>
</body>
</html>