<?php
/*
*策略模式
*
*现实生活示例
*考虑排序的例子，我们实现了冒泡排序，但数据开始增长，冒泡排序开始变得非常慢。
*为了解决这个问题，我们实现了快速排序。尽管快速排序算法对于大型数据集来说效果很好，
*但对于较小的数据集却非常慢。为了解决这个问题，我们实施了一个策略，小数据集使用冒泡排序，
*大数据集使用快速排序。
*
*概述
*策略模式允许你基于场景转换算法或策略。
*
*维基百科
*在计算机编程中，策略模式是一种行为设计模式，可以在运行时选择算法的行为。
* 
*/

//程序示例

//以上述排序为例，首先给出策略接口及不同的策略实现
interface SortStrategy
{
	public function sort(array $dataset):array;
}

class BubbleSortStrategy implements SortStrategy
{
	public function sort(array $dataset):array 
	{
		echo 'Sorting using bubble sort...' . PHP_EOL;
		$length = count($dataset);
		$temp = 0;
		for ($i=0; $i < $length; $i++) { 
			for ($j=$i; $j < $length; $j++) { 
				if ($dataset[$i] > $dataset[$j]) {
					$temp        = $dataset[$i];
					$dataset[$i] = $dataset[$j];
					$dataset[$j] = $temp;
				}
			}
		}
		return $dataset;
	}
}

class QuickSortStrategy implements SortStrategy
{
	public function sort(array $dataset):array 
	{
		echo 'Sorting using quick sort...' . PHP_EOL;
		return $this->quickSort($dataset);
	}
	//快速排序
	private function quickSort(array $dataset):array
	{
		$length = count($dataset);
		if ($length <= 1) {
			return $dataset;
		}
		$left   = [];
		$right  = [];
		for ($i=1; $i < $length; $i++) { 
			if($dataset[0] > $dataset[$i]){
				$left[] = $dataset[$i];
			}else{
				$right[] = $dataset[$i];
			}

		}
		$left  = $this->quickSort($left);
		$right = $this->quickSort($right);

		$dataset = array_merge($left, [$dataset[0]], $right);
		return $dataset;
	}
}

//客户端可以使用任意策略
class Sorter
{
	protected $sorter;

	public function __construct(SortStrategy $sorter)
	{
		$this->sorter = $sorter;
	}

	public function sort(array $dataset):array 
	{
		return $this->sorter->sort($dataset);
	}
}

//使用
$dataset = [1, 5, 4, 3, 2, 8];

$sorter = new Sorter(new BubbleSortStrategy());
$sorted = $sorter->sort($dataset);
echo implode(',', $sorted) . PHP_EOL;

$sorter = new Sorter(new QuickSortStrategy());
$sorted = $sorter->sort($dataset);
echo implode(',', $sorted) . PHP_EOL;