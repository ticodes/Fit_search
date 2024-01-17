<?php
session_start();

// Удаление всех переменных сессии
session_unset();

// Уничтожение сессии
session_destroy();

// Перенаправление на главную страницу
header("Location: index.php");
exit();
?>
