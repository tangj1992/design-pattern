<?php
/*
*单例模式
*
*现实生活示例
*一个国家同一时间只能有一位总统。只要使命召唤，这个总统就必须采取行动。 这里的总统就是一个单例。
*
*概述
*确保特定类的对象只被创建一次。
*
*维基百科
*在软件工程中，单例模式是一种软件设计模式，用来限制类初始化为对象。
*当恰恰只需要一个对象来协调整个系统的功能时，单例模式非常有用。
*实际上，单例模式被认为是反模式，应该避免过度使用。 单例模式并非不好，
*可能有时候很有用，但应谨慎使用，因为它在你的应用程序中引入了全局状态，
*一处更改可能会影响其他地方，并且可能会变得很难调试。 
*另外不好的一点是单例模式会使代码紧耦合，单例也很难mock。
*/

//程序示例
//
//要创建一个单例，需要将构造函数设为 private，
//禁用克隆，禁用扩展名，并创建静态变量来容纳实例
final class President 
{
	private static $instance;

	private function __construct()
	{

	}

	public static function getInstance():President
	{
		if (!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __clone()
	{

	}

	private function __wakeup()
	{

	}
}

//使用
$president1 = President::getInstance();
$president2 = President::getInstance();

var_dump($president1 === $president2); //true