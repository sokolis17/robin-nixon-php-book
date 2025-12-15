<?php

require_once 'login.php';
require 'helper.php';
//Ошибка первая
try {
    $pdo = new PDO($attr, $user, $pass, $opts);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

//Удаление
if (isset($_POST['delete']) && isset($_POST['isbn'])) {
    $isbn = get_post($pdo, 'isbn');
    $query = "DELETE FROM classics WHERE isbn=$isbn";
    $pdo->query($query);
}
//Вставка
if (proverka_poley(['author', 'title', 'category', 'year', 'isbn'])) {
    $author = get_post($pdo, 'author');
    $title = get_post($pdo, 'title');
    $category = get_post($pdo, 'category');
    $year = get_post($pdo, 'year');
    $isbn = get_post($pdo, 'isbn');

    $query = "INSERT INTO classics(author, title, category, year, isbn) VALUES($author, $title, $category, $year, $isbn)";
    $pdo->query($query);
}else{
    echo "Ошибка: Заполните все поля";
}
//Форма вставки
echo <<<_END
<form action='' method = "post" ><pre>
  Author <input type = "text" name ='author'>
  Title  <input type = "text" name ='title'>
Category <input type = "text" name ='category'>
    Year <input type = "text" name ='year'>
    ISBN <input type = "text" name ='isbn'>
         <input type = "submit" value="ADD RECORD">
</pre>
</form>
_END;
//Отображение всех
$query = "SELECT * FROM classics";
$result = $pdo->query($query);

while($row = $result -> fetch()){
    $r0 = htmlspecialchars($row['author']);
    $r1 = htmlspecialchars($row['title']);
    $r2 = htmlspecialchars($row['category']);
    $r3 = htmlspecialchars($row['year']);
    $r4 = htmlspecialchars($row['isbn']);

//Форма отображения
    echo <<<_END
<pre>
  Author   $r0
  Title    $r1
  Category $r2
  Year     $r3
  ISBN     $r4
</pre>
_END;
//Форма Удаления
  echo <<<_END
<form action = "" method = 'post'>
<input type = "hidden" name = 'delete' value = 'yes'>
<input type = "hidden" name = 'isbn' value = '$r4'>
<input type = "submit" value = 'DELETE RECORD'>
</form>
_END;  
}
