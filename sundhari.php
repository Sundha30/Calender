<?php
//set timezone
//date_default_timezone_set('Indian / Mahe');
//get prev & next month
if(isset($_GET['YM']))
{
	$YM = $_GET['YM'];
}else{
	//this month
	$YM = date('Y-M');
}
//chech format
$timestamp = strtotime($YM,"-01");
if($timestamp === false)
{
	$timestamp = time();
}
//today
$today = date('Y-M-d',time());

//for h2 title
$h_title = date('Y / M',$timestamp);

//create prev &next month link ,mktime(hour,minute,second,month,date,year)
$prev = date('Y-M', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-M', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));


//no. of days in month
$day_count = date('t', $timestamp);

//0-sun,1-mon,2-tue..
$str = date('w',mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
$weeks = array();
//add empty cell
$weeks[]= str_repeat('<td></td>', $str);
for($day=1; $day<=$day_count; $day++, $str++)
{
	$date =$YM.'-'.$day;
	if($today == $date){
		$weeks[]='<td class= "today">'.$day;
	}else{
		$weeks[]='<td>'.$day;
	}
	$week[]='</td>';
	//End of the week or end of the month
	if($str % 7 == 6 ||$day == $day_count){
		$data = '';
		if($day == $day_count)	{
			//add empty cell
			$data= str_repeat('<td></td>', 6 - ($str % 7));
		}
		$weeks[] = '<tr>'.$data.'</tr>';
		//prepare for new week 
		$weeks[] = '';
	}
}
?>
<html>
<head> <title>Calender</title>
<meta name="viewport" content="width=device-width, initial-scale=0.1">
<style>
.contain{
     font-family:Times New Roman;
	 background-color:white;
	 font-size:12;
	 font-style:Italic;
	 width:50%;
	 text-align:center;
	 }
	 .today{
	 background-color:skyblue;
	 }
</style>
</head>
<header style="background-color:red; height:80px;" > <h1>Calender</h1></header>
<body bgcolor="pink">
<h2><a href="?YM=<?php echo $prev; ?>">&lt;</a><?php echo $h_title ?><a href="?YM=<?php echo $next; ?>">&gt;</a></h2>
<table class="contain"> 
<tr class=some>
<th>Sun</th>
<th>Mon</th>
<th>Tue</th>
<th>Wed</th>
<th>The</th>
<th>Fri</th>
<th>Sat</th>
</tr>
<?php
foreach($weeks as $week)
{
echo $week;
}
?>
<!--<tr>
<td> </td>
<td> </td>
<td> </td>
<td> </td>
<td>1</td>
<td>2</td>
<td>3</td>
</tr>
<tr>
<td>4</td>
<td>5</td>
<td>6</td>
<td>7</td>
<td>8</td>
<td>9</td>
<td>10</td>
</tr>
<tr>
<td>11</td>
<td>12</td>
<td>13</td>
<td>14</td>
<td>15</td>
<td class=today>17</td>
<td>18</td>
</tr>
<tr>
<td>19</td>
<td>20</td>
<td>21</td>
<td>22</td>
<td>23</td>
<td>24</td>
<td>25</td>
</tr>
<tr>
<td>26</td>
<td>27</td>
<td>28</td>
<td>29</td>
<td>30</td>
<td> </td>
<td> </td>
</tr>-->
</table>
<!--<span><img src="zdj%C4%99cia-royalty-free-nieba-b%C5%82%C4%99kitny-motyli-s%C5%82o%C5%84ce-image24906248.jpg"> </span>-->
</body>
</html>