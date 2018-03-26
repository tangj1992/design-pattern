<?php
/*
*简单工厂模式
*
*现实生活示例
*想象一下，你正在建造一座房子而且需要几扇房门，如果每次需要房门的时候，
*不是用工厂制造的房门，而是穿上木匠服，然后开始自己制造房门，将会搞得一团糟。

*概述
*简单工厂模式只是为客户端创建实例，而不将任何实例化逻辑暴露给客户端。

*维基百科	
*在面向对象程序设计中，工厂通常是一个用来创建其他对象的对象。
*通常来讲，工厂是指某个功能或方法，此功能或方法返回不同类型的对象或者类的某个方法调用，
*返回的东西看起来是「新的」。
*
*何时使用？
*如果创建对象不仅仅是一些变量的初始化，还涉及某些逻辑，
*那么将其封装到一个专用工厂中取代随处使用的重复代码是有意义的。
*/

//程序示例
	
//房门接口
interface Door
{
	public function getWidth():float;
	public function getHeight():float;
}
//木门
class WoodenDoor implements Door
{
	protected $width;
	protected $height;

	public function __construct(float $width, float $height)
	{
		$this->width  = $width;
		$this->height = $height;
	}

	public function getWidth():float
	{
		return $this->width;
	}

	public function getHeight():float
	{
		return $this->height;
	}
}
//生产房门的工厂
class DoorFactory
{
	public static function makeDoor($width, $height):Door
	{
		return new WoodenDoor($width, $height);
	}
}
//使用
$door = DoorFactory::makeDoor(100, 200);
echo 'Width:' . $door->getWidth();
echo PHP_EOL;
echo 'Height:' . $door->getHeight();
