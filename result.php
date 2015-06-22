<!doctype html>
<html>
<head>
  <meta charset=utf-8>
  <title>Определение дня недели</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div id="wrapper">
<?php

	$k = 0;
	
    echo "Введенное вами число: ";
    echo $chosen_day=$_POST['chosen_day'];
    echo ".";
    echo $chosen_month=$_POST['chosen_month'];
    echo "."; 
    echo $chosen_year=$_POST['chosen_year'];
    
    
    //Проверяем существует ли такая дата

	if (!checkdate($chosen_month , $chosen_day , $chosen_year ))
	{
		exit("<br>Несуществующая дата");
	}
	
	if ($chosen_year < "1901" or $chosen_year > "2096")
	{
		exit("<br>К сожалению данная программа работает только с периодом 1901-2096");
	}

 

    //Это нужно,чтобы определить к какому массиву принадлежит выбранный пользователем год.

    $year1= array(1901, 1929, 1957, 1985, 2013, 2041, 2069, 1907, 1935, 1963, 1991, 2019, 2047, 2075, 1918, 1946, 1974, 2002, 2030, 2058, 2086);
    $year2= array(1902, 1930, 1958, 1986, 2014, 2042, 2070, 1913, 1941, 1969, 1997, 2025, 2053, 2081, 1919, 1947, 1975, 2003, 2031, 2059, 2087);
    $year3= array(1903, 1931, 1959, 1987, 2015, 2043, 2071, 1914, 1942, 1970, 1998, 2026, 2054, 2082, 1925, 1953, 1981, 2009, 2037, 2065, 2093);
    $year4= array(1904, 1932, 1960, 1988, 2016, 2044, 2072);
    $year5= array(1905, 1933, 1961, 1989, 2017, 2045, 2073, 1911, 1939, 1967, 1995, 2023, 2051, 2079, 1922, 1950, 1978, 2006, 2034, 2062, 2090);
    $year6= array(1906, 1934, 1962, 1990, 2018, 2046, 2074, 1917, 1945, 1973, 2001, 2029, 2057, 2085, 1923, 1951, 1979, 2007, 2035, 2063, 2091);
    $year8= array(1908, 1936, 1964, 1992, 2020, 2048, 2076);
    $year9= array(1909, 1936, 1964, 1992, 2020, 2048, 2076, 1915, 1943, 1971, 1999, 2027, 2055, 2083, 1926, 1954, 1982, 2010, 2038, 2066, 2094);
    $year10= array(1910, 1938, 1966, 1994, 2022, 2050, 2078, 1921, 1949, 1977, 2005, 2033, 2061, 2089, 1927, 1955, 1983, 2011, 2039, 2067, 2095);
    $year12= array(1912, 1940, 1968, 1996, 2024, 2052, 2080);
    $year16= array(1916, 1944, 1972, 2000, 2028, 2056, 2084);
    $year20= array(1920, 1948, 1976, 2004, 2032, 2060, 2088);
    $year24= array(1924, 1952, 1980, 2008, 2036, 2064, 2092);
    $year28= array(1928, 1956, 1984, 2012, 2040, 2068, 2096);


    //Это нужно,чтобы определить к какому массиву принадлежит выбранный пользователем месяц и посчитать число для второй таблицы.

	$months = array(
		"month1" => array(1, 4, 4, 7, 2, 5, 7, 3, 6, 1, 4, 6),
		"month2" => array(2, 5, 5, 1, 3, 6, 1, 4, 7, 2, 5, 7),
		"month3" => array(3, 6, 6, 2, 4, 7, 2, 5, 1, 3, 6, 1),
		"month4" => array(4, 7, 1, 4, 6, 2, 4, 7, 3, 5, 1, 3),
		"month5" => array(6, 2, 2, 5, 7, 3, 5, 1, 4, 6, 2, 4),
		"month6" => array(7, 3, 3, 6, 1, 4, 6, 2, 5, 7, 3, 5),
		"month8" => array(2, 5, 6, 2, 4, 7, 2, 5, 1, 3, 6, 1),
		"month9" => array(4, 7, 7, 3, 5, 1, 3, 6, 2, 4, 7, 2),
		"month10" => array(5, 1, 1, 4, 6, 2, 4, 7, 3, 5, 1, 3),
		"month12" => array(7, 3, 4, 7, 2, 5, 7, 3, 6, 1, 4, 6),
		"month16" => array(5, 1, 2, 5, 7, 3, 5, 1, 4, 6, 2, 4),
		"month20" => array(3, 6, 7, 3, 5, 1, 3, 6, 2, 4, 7, 2),
		"month24" => array(1, 4, 5, 1, 3, 6, 1, 4, 7, 2, 5, 7),
		"month28" => array(6, 2, 3, 6, 1, 4, 6, 2, 5, 7, 3, 5));

    // Вторая таблица. Позволяет определить день недели по посчитанному числу.

    $week = array ("day1" => array(1, 8, 15, 22, 29, 36),
                   "day2" => array(2, 9, 16, 23, 30, 37),
                   "day3" => array(3, 10, 17, 24, 31),
                   "day4" => array(4, 11, 18, 25, 32),
                   "day5" => array(5, 12, 19, 26, 33),
                   "day6" => array(6, 13, 20, 27, 34),
                   "day7" => array(7, 14, 21, 28, 35));

   $days = array('понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', ' воскресенье');


    //Начинаем расчеты.
    // Если год находится в этом масиве, ищем месяц в соответствующем массиве и считаем число $k для второй таблицы.
	
	function search_k($yearr, $monthh, &$chosen_year, &$chosen_month, &$chosen_day, &$k)
	{
		if (in_array($chosen_year, $yearr))
    	{
			 $k = $monthh[$chosen_month+1] + $chosen_day;
		}
	}
	
	search_k($year1, $month1, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year2, $month2, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year3, $month3, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year4, $month4, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year5, $month5, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year6, $month6, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year8, $month8, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year9, $month9, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year10, $month10, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year12, $month12, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year16, $month16, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year20, $month20, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year24, $month24, $chosen_year, $chosen_month, $chosen_day, $k);
	search_k($year28, $month28, $chosen_year, $chosen_month, $chosen_day, $k);


	// Далее по посчитанному $k определяем день недели, пользуясь второй таблицей


    foreach ($week as $section => $items)
	foreach ($items as $key => $value)
	{
	    if ($k == $value)
	    {
	    $r=$section;
	    ++$j;
	    }
	}

    $n = substr($r, 3);
    echo "<br> Это " . $days[$n-1];
	

?>
</form>
</div>
</body>
</html>