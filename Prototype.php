<?php
/*
*原型模式
*
* 现实生活示例
*还记得多莉吗？那只克隆羊。这里不深入细节，关键点在于克隆。

*概述
*基于现有对象通过克隆创建对象。

*维基百科
*在软件开发过程中，原型模式是一种创建型设计模式。当要创建的对象类型由原型实例确定时，
*将通过克隆原型实例生成新对象。简言之，原型模式允许你创建现有对象的副本并根据需要进行修改，
*而不是从头开始创建对象并进行设置。
*
* 何时使用？
*当需要创建一个与已有对象类似的对象，或者当创建对象的成本比克隆更高时，使用原型模式。
*/

//程序示例

//使用PHP的clone方法可以轻松实现
class Sheep
{
	protected $name;
	protected $category;

	public function __construct(string $name, string $category = 'Mountain Sheep')
	{
		$this->name     = $name;
		$this->category = $category;
	}

	public function setName(string $name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setCategory(string $category)
	{
		$this->category = $category;
	}

	public function getCategory()
	{
		return $this->category;
	}
}

//使用
$original = new Sheep('Jolly');
echo $original->getName() . PHP_EOL;
echo $original->getCategory() . PHP_EOL;

//克隆并修改属性
$cloned = clone $original;
$cloned->setName('Dolly');
echo $cloned->getName() . PHP_EOL;
echo $cloned->getCategory() . PHP_EOL;