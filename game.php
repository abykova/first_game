<?php
session_start();//запуск сессии 

if ($_SESSION['a']) {
	$a = $_SESSION["a"]; // управление сессией, загадывание числа
}
else {
	$_SESSION["pop"] = 0; //начало игры, первая попытка
	$a = rand(0, 100);//загаданное чило генерирует случайное образом
	$_SESSION['a'] = $a;//загаданное число зависит от сессии
	echo "лови!";
}

$b = $_POST['number']; // число, которое вводит пользователь
$pop = $_SESSION['pop'];// попытки записываются в сессию
//var_dump($b);
if ($b === null || $b === '') {//число, которое вводит пользователь не может быть пустым
} else
if ($b > 100) {//если введенно число больше сотни
	echo "нада меньше ста";
}
elseif ($b < 1) {//иначе введено чиисло меньше сотни
	echo "нада болше нула";
}
else {
	$pop++;
	$_SESSION['pop'] = $pop; //увеличение попытки на один, после ввода числа, и занесение в сессию

	if ($pop > 10) {//если попыток больше 10,
		$_SESSION['pop'] = 0;//то обнулить попытки
		$_SESSION['a'] = null;//и сказать, что пользователь офигел
		echo "ты офигел";
	}
	elseif ($a > $b) {
		echo "загадоное число больше";//введенное число меньше загаданного
	}
	elseif ($a < $b) {
		echo "загаданое число меньше";//введенное число больше загаданного
	}
	else {
		$_SESSION['pop'] = 0;//сброс попыток
		$_SESSION['a'] = null;//обнуление загаданного числа
		echo "Эврика!";//потому что угадал
	}
}

//var_dump($_SESSION);
?>

<form method="post">
	<input name="number" autofocus><!-- автофокус на поле ввода -->
	<input type="hidden" name="hidden_key" value="hidden text"><!-- форма ввода -->
	<input type="submit" value="проверить"><!-- кнопка ввода -->
</form>

<?php
$lost = 10 - $pop;
echo "совсем чуть-чуть {$lost}"; //количество оставшихся попыток
?>