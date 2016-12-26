<?php
//original array
$arr = array();
$arr[] = array('name' => 'Albert', 'kind' => '1', 'type' => 'B');
$arr[] = array('name' => 'Brian', 'kind' => '2', 'type' => 'C');
$arr[] = array('name' => 'charlie', 'kind' => '3', 'type' => 'A');
$arr[] = array('name' => 'Daniel', 'kind' => '4', 'type' => 'C');
$arr[] = array('name' => 'Edgar', 'kind' => '3', 'type' => 'B');
$arr[] = array('name' => 'Fred', 'kind' => '5', 'type' => 'D');
$arr[] = array('name' => 'George', 'kind' => '2', 'type' => 'D');
$arr[] = array('name' => 'Harry', 'kind' => '4', 'type' => 'E');
$arr[] = array('name' => 'Irvine', 'kind' => '1', 'type' => 'E');
echo 'Original array is';
var_dump($arr);

//sort order
$sort_order = ['kind' => ['3', '5', '4', '2'], 'type' => SORT_ASC];
echo 'Sort order is';
var_dump($sort_order);

echo 'Sorted array is';
var_dump(csort($arr, $sort_order));

//sort function
function csort($arr, $sort_order)
{
	foreach(array_reverse($sort_order) as $k => $v)
	{
		$sort_arr = array_column($arr, $k);
		if(is_array($v))
		{
			$tmp_sort = [];
			foreach($v as $vv)
			{
				$filter_arr = is_array($vv) ? $vv : [$vv];
				$tmp_sort += array_intersect($sort_arr, $filter_arr);
			}
			$tmp_sort += array_diff($sort_arr, $tmp_sort);
			$fliped_arr = array_flip(array_keys($tmp_sort));
			ksort($fliped_arr);
			array_multisort($fliped_arr, $arr);
		}
		else
		{
			array_multisort($sort_arr, $v, SORT_REGULAR, $arr);
		}
	}
	return($arr);
}
