<?php
/*
*现实生活示例
*扩展一下简单工厂模式中的房门例子。基于所需，你可能需要从木门店获取木门，
*从铁门店获取铁门或者从相关的门店获取 PVC 门。进一步讲，你可能需要不同种类的专家来安装房门，
*比如木匠安装木门，焊接工安装铁门等等。正如你所料，房门有了依赖，木门需要木匠，铁门需要焊接工。
*
*概述
*一组工厂的工厂：将相关或者互相依赖的单个工厂聚集在一起，而不指定这些工厂的具体类。
*
*维基百科
*抽象工厂模式提供了一种方式，这种方式可以封装一组具有共同主题的个体工厂，而不指定这些工厂的具体类。
*
*何时使用？
*当存在相关的依赖并涉及到稍复杂的创建逻辑时，使用抽象工厂模式。
*/

//程序示例

//Door 接口和一些实现
interface Door
{
	public function getDescription();
}

class WoodenDoor implements Door
{
	public function getDescription()
	{
		echo 'I am a wooden door' . PHP_EOL;
	}
}

class IronDoor implements Door
{
	public function getDescription()
	{
		echo 'I am an iron door' . PHP_EOL;
	}
}
//然后根据每种房门类型给出对应的安装专家
interface DoorFittingExpert
{
	public function getDescription();
}

class Carpenter implements DoorFittingExpert
{
	public function getDescription()
	{
		echo 'I can only fit wooden doors' . PHP_EOL;
	}
}

class Welder implements DoorFittingExpert
{
	public function getDescription()
	{
		echo 'I can only fit iron doors' . PHP_EOL;
	}
}
//现在抽象工厂可以将相关的对象组建在一起，也就是说，
//木门工厂会生成木门并提供木门安装专家，
//铁门工厂会生产铁门并提供铁门安装专家。
interface DoorFactory
{
	public function makeDoor():Door;
	public function makeFittingExpert():DoorFittingExpert;
}

class WoodenDoorFactory implements DoorFactory
{
	public function makeDoor():Door
	{
		return new WoodenDoor();
	}

	public function makeFittingExpert():DoorFittingExpert
	{
		return new Carpenter();
	}
}

class IronDoorFactory implements DoorFactory
{
	public function makeDoor():Door
	{
		return new IronDoor();
	}

	public function makeFittingExpert():DoorFittingExpert
	{
		return new Welder();
	}
}
//使用
$woodenFactory = new WoodenDoorFactory();
$door = $woodenFactory->makeDoor();
$expert = $woodenFactory->makeFittingExpert();

$door->getDescription();
$expert->getDescription();

$ironFactory = new IronDoorFactory();
$door = $ironFactory->makeDoor();
$expert = $ironFactory->makeFittingExpert();

$door->getDescription();
$expert->getDescription();

