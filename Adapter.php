<?php
/*
*适配器模式
*
* 现实生活示例
*考虑这样一个场景，你的存储卡中有一些照片，你需要将其传输到计算机。
*为此，你需要某种与计算机端口兼容的适配器，以便将存储卡连接到计算机上。
*在这种情况下，读卡器就是适配器。另外一个例子就是大名鼎鼎的电源适配器：
*一个三脚插头不能连接到双插头插座，需要使用电源适配器使其与双插头插座兼容。
*另外一个例子是译者将一个人说的话翻译给另一个人。
*
*概述
*适配器模式可以将不兼容的对象包装成适配器来适配其它类。
*
*维基百科
*在软件工程中，适配器模式是允许将现有类的接口用作另一个类接口的软件设计模式。
*它通常用于现有类与其他类的协作，而无需修改现有类的代码。
*
*
*/

// 程序示例
// 考虑一个游戏场景，有一个猎人，他狩猎狮子。
// 首先给出 Lion 接口，所有种类的狮子都要实现这个接口。
interface Lion
{
	public function roar();
} 
class AfricanLion implements Lion
{
	public function roar()
	{
		return 'I am african lion!';
	}
}
class AsianLion implements Lion
{
	public function roar()
	{
		return 'I am asian lion!';
	}
}
// 猎人希望可以狩猎任何实现 Lion 接口的狮子
class Hunter
{
	public function hunt(Lion $lion)
	{
		echo $lion->roar() . PHP_EOL;
	}
}
// 现在我们假定猎人在游戏中也可以狩猎野狗。但是目前我们无法实现，
// 因为狗是通过其他接口实现。为了让猎人可以狩猎野狗，我们需要创建一个适配器，来兼容这种情况。
class WildDog
{
	public function bark()
	{
		return 'I am wild dog';
	}
}
class WildDogAdapter implements Lion
{
	protected $dog;

	public function __construct(WildDog $dog)
	{
		$this->dog = $dog;
	}

	public function roar()
	{
		return $this->dog->bark();
	}
}
//这样，在游戏中通过 WildDogAdapter 就可以使用 WildDog
$wildDog = new WildDog();
$wildDogAdapter = new WildDogAdapter($wildDog);

$hunter = new Hunter();
$hunter->hunt($wildDogAdapter);