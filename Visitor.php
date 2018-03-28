<?php
/*
*访问者模式
*
*现实生活示例
*假如有人前往迪拜，他们需要有证件（比如签证）就可进入迪拜。到达后，无需获得许可或做一些跑腿工作，
*他们便可以自由前往迪拜的任何地方; 只要是知道的地方，就能游览。访问者模式可以做到这一点，
*它可以帮助你添加访问地点，以便在无需跑腿的情况下，可以尽可能多地访问。
*
*概述
*访问者模式可以在无需修改对象的情况下增加一些额外操作。
*
*维基百科
*在面向对象编程和软件工程中，访问者设计模式是一种从对象结构中分离算法的方式。
*这种分离的实际结果是能够向现有的对象结构添加新的操作，而无需修改这些结构。
*这是遵循开放/封闭原则的一种方式。
*
*/

//程序示例

//以模拟动物园为例，动物园里有几种不同种类的动物，我们需要让它们发出叫声，下面使用访问者模式实现
interface Animal
{
	public function accept(AnimalOperation $operation);
}
interface AnimalOperation
{
	public function visitMonkey(Monkey $monkey);
	public function visitLion(Lion $lion);
	public function visitDolphin(Dolphin $dolphin);
}
//然后实现各种动物
class Monkey implements Animal
{
	public function shout()
	{
		echo 'Ooh oo aa aa!' . PHP_EOL;
	}

	public function accept(AnimalOperation $operation)
	{
		$operation->visitMonkey($this);
	}
}
class Lion implements Animal
{
	public function roar()
	{
		echo 'Roaaar!' . PHP_EOL;
	}

	public function accept(AnimalOperation $operation)
	{
		$operation->visitLion($this);
	}
}
class Dolphin implements Animal
{
	public function speak()
	{
		echo 'Tuut tuttu tuutt!' . PHP_EOL;
	}

	public function accept(AnimalOperation $operation)
	{
		$operation->visitDolphin($this);
	}
}
//访问者
class Speak implements AnimalOperation
{
	public function visitMonkey(Monkey $monkey)
	{
		$monkey->shout();
	}

	public function visitLion(Lion $lion)
	{
		$lion->roar();
	}

	public function visitDolphin(Dolphin $dolphin)
	{
		$dolphin->speak();
	}
}
//使用
$monkey = new Monkey();
$lion = new Lion();
$dolphin = new Dolphin();

$speak = new Speak();

$monkey->accept($speak);
$lion->accept($speak);
$dolphin->accept($speak);