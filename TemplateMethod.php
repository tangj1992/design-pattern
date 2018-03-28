<?php
/*
*模板方法模式
*
*现实生活示例
*假设我们要造一座房子，建造的大体步骤如下：
*打地基
*垒墙
*封顶
*铺地板
*这些步骤的顺序不能被打乱，比如说，你不能在垒墙之前先封顶。但是其中的每一步可以定制，
*比如墙的材料可以使用木头、聚酯纤维或者石头。
*
*概述
*模板方法模式定义了如何执行某种算法的框架，但是将这些步骤的实现推迟到子类中。
*
*维基百科
*在软件工程中，模板方法模式是一种行为设计模式，用于定义操作中算法的程序框架，
*将一些步骤推迟到子类实现。它允许在不改变算法结构的情况下重新定义算法的某些步骤。
* 
*/

//程序示例

//假如我们有一个构建工具，可以帮助我们测试，构建并生成构建报告（即代码覆盖报告，linting报告等），
//并将应用程序部署到测试服务器上。

//首先是用于确定构建算法框架的基类
abstract class Builder
{
	final public function build()
	{
		$this->test();
		$this->lint();
		$this->assemble();
		$this->deploy();
	}

	abstract public function test();
	abstract public function lint();
	abstract public function assemble();
	abstract public function deploy();
}
//然后提供一些基类的实现
class AndroidBuilder extends Builder
{
	public function test()
	{
		echo 'Running android tests...' . PHP_EOL;
	}

	public function lint()
	{
		echo 'Linting the android code...' . PHP_EOL;
	}

	public function assemble()
	{
		echo 'Assembling the android build...' . PHP_EOL;
	}

	public function deploy()
	{
		echo 'Deploying android build to server...' . PHP_EOL;
	}
}
class IosBuilder extends Builder
{
	public function test()
	{
		echo 'Running ios tests...' . PHP_EOL;
	}

	public function lint()
	{
		echo 'Linting the ios code...' . PHP_EOL;
	}

	public function assemble()
	{
		echo 'Assembling the ios build...' . PHP_EOL;
	}

	public function deploy()
	{
		echo 'Deploying ios build to server...' . PHP_EOL;
	}
}
//使用
$androidBuilder = new AndroidBuilder();
$androidBuilder->build();

$iosBuilder = new IosBuilder();
$iosBuilder->build();