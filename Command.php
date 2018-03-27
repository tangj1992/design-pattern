<?php
/*
*命令模式
*
* 现实生活示例
*一个典型的例子是你在餐厅点菜，你（即客户）向服务员（即 Invoker）点餐（即命令），
*服务员只需将需求转达给会烹饪的厨师。 另外一个例子是你（即客户端）使用遥控器（Invoker）打开（即命令）
*电视机（即接收器）。
* 
*概述
*命令模式允许将操作封装在对象中，其背后的关键思想是提供客户端与接收器分离的方法。
*
*维基百科
*在面向对象程序设计的范畴中，命令模式是一种行为型设计模式。将所有需要的信息封装到对象中，
*用于之后的动作（action）或者事件触发。被封装的信息包括方法名以及拥有方法及参数的对象。
*/

//程序示例

//首先给出一个接收器，实现了可能会执行的动作
class Bulb
{
	public function turnOn()
	{
		echo 'Bulb has been lit' . PHP_EOL;
	}

	public function turnOff()
	{
		echo 'Darkness!' . PHP_EOL;
	}
}
//然后给出一个接口，（Bulb）中的每个命令都要实现这个接口，得到一组命令集：
interface Command
{
	public function execute();
	public function undo();
	public function redo();
}
class TurnOn implements Command
{
	protected $bulb;

	public function __construct(Bulb $bulb)
	{
		$this->bulb = $bulb;
	}

	public function execute()
	{
		$this->bulb->turnOn();		
	}

	public function undo()
	{
		$this->bulb->turnOff();
	}

	public function redo()
	{
		$this->execute();
	}
}
class TurnOff implements Command
{
	protected $bulb;

	public function __construct(Bulb $bulb)
	{
		$this->bulb = $bulb;
	}

	public function execute()
	{
		$this->bulb->turnOff();		
	}

	public function undo()
	{
		$this->bulb->turnOn();
	}

	public function redo()
	{
		$this->execute();
	}
}
//然后是Invoker，客户端将与之交互以处理各种命令：
class RemoteControl
{
	public function submit(Command $command)
	{
		$command->execute();
	}
}
//使用
$bulb = new Bulb();

$turnOn = new TurnOn($bulb);
$turnOff = new TurnOff($bulb);

$remote = new RemoteControl();
$remote->submit($turnOn);
$remote->submit($turnOff);