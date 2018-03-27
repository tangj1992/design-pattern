<?php
/*
*迭代器模式
*
* 现实生活示例
*老式的无线电设备将是一个很好的迭代器示例，用户可以在某个频道上启动，
*然后使用下一个或上一个按钮来切换频道。或者以 MP3 播放器或电视机为例，
*你可以按下一个按钮和上一个按钮进行连续的频道切换。换句话说，
*它们都提供了一个界面来遍历相应的频道，歌曲或广播电台。
*
*概述
*迭代器模式提供了一种方法，可以访问对象的元素而不暴露底层实现。
*
*维基百科
*在面向对象程序设计中，迭代器模式是一种设计模式，其中迭代器用于遍历容器并访问容器的元素。
*迭代器模式将算法与容器解耦; 在某些情况下，算法是特定容器必需的，因此不能解耦。
*
*/

//程序示例

//通过PHP，使用 SPL（PHP标准库）可以轻松实现迭代器模式，以上述收音机为例，首先给出 RadioStation 类
class RadioStation
{
	protected $frequency;

	public function __construct(float $frequency)
	{
		$this->frequency = $frequency;
	}

	public function getFrequency():float
	{
		return $this->frequency;
	}
}
//迭代器
class StationList implements Countable,Iterator
{
	protected $stations = [];
	protected $counter;

	public function addStation(RadioStation $station)
	{
		$this->stations[] = $station;
	}

	public function removeStation(RadioStation $toRemove)
	{
		$toRemoveFrequency = $toRemove->getFrequency();
		$this->stations = array_filter($this->stations, function(RadioStation $station) use($toRemoveFrequency){
			return $station->getFrequency() !== $toRemoveFrequency;
		});
	}

	public function count():int 
	{
		return count($this->stations);
	}

	public function current():RadioStation
	{
		return $this->stations[$this->counter];
	}

	public function key()
	{
		return $this->counter;
	}

	public function next()
	{
		$this->counter++;
	}

	public function rewind()
	{
		$this->counter = 0;
	}

	public function valid():bool 
	{
		return isset($this->stations[$this->counter]);
	}
}
//使用
$stationList = new StationList();

$stationList->addStation(new RadioStation(89));
$stationList->addStation(new RadioStation(101));
$stationList->addStation(new RadioStation(102));
$stationList->addStation(new RadioStation(103.2));

foreach ($stationList as $station) {
	echo $station->getFrequency() . PHP_EOL;
}

$stationList->removeStation(new RadioStation(89));