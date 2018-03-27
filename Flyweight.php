<?php
/*
*享元模式
*
* 现实生活示例
*你是否在某个摊位上喝过茶？店主总是会多做一些茶，以预留给其他顾客，以此来节省资源比如燃气。
*享元模式所讲的就是共享。
*
*概述
*享元模式通过相似对象之间尽可能的资源共享，来最小化内存使用或计算开销。
*
*维基百科
*在计算机编程中，享元模式是一种软件设计模式。享元模式是通过与其他类似对象共享尽可能多的数据
*来最小化内存使用的对象; 当简单的重复对象过多占用内存时，可以通过享元模式来处理大量相似对象的情况。
*
*/

//程序示例

//以茶为例，首先定义茶的种类及茶具
class KarakTea
{

}

class TeaMaker
{
	protected $availableTea = [];

	public function make($preference)
	{
		if (empty($this->availableTea[$preference])) {
			$this->availableTea[$preference] = new KarakTea();
		}

		return $this->availableTea[$preference];
	}
}
//然后定义茶店来接单及提供服务
class TeaShop
{
	protected $orders;
	protected $teaMaker;

	public function __construct(TeaMaker $teaMaker)
	{
		$this->teaMaker = $teaMaker;
	}

	public function takeOrder(string $teaType, int $table)
	{
		$this->orders[$table] = $this->teaMaker->make($teaType);
	}

	public function serve()
	{
		foreach ($this->orders as $table => $tea) {
			echo "Serving tea to table#" . $table . PHP_EOL;
		}
	}
}
//使用
$teaMaker = new TeaMaker();
$shop = new TeaShop($teaMaker);

$shop->takeOrder('less sugar',    1);
$shop->takeOrder('more milk',     2);
$shop->takeOrder('without sugar', 5);

$shop->serve();