<?php
/*
*工厂方法模式
*
*现实生活示例
*考虑招聘经理的情况。一个人不可能应付所有职位的面试，对于空缺职位，
*招聘经理必须委派不同的人去面试。
*
*概述
*工厂方法模式提供了一种将实例化逻辑委托给子类的方法。
*
*维基百科
*在基于类的编程中，工厂方法模式是一种使用了工厂方法的创建型设计模式，
*在不指定对象具体类型的情况下，处理创建对象的问题。
*创建对象不是通过调用构造器而是通过调用工厂方法
*（在接口中指定工厂方法并在子类中实现或者在基类中实现，随意在派生类中重写）来完成。
*/

//程序示例

//以上述招聘经理为例，首先给出一个面试官接口及实现
interface Interviewer
{
	public function askQuestions();
}
//开发人员面试
class Developer implements Interviewer
{
	public function askQuestions()
	{
		echo 'Asking about design patterns!' . PHP_EOL;
	}
}
//市场人员面试
class CommunityExecutive implements Interviewer
{
	public function askQuestions()
	{
		echo 'Asking about community building' . PHP_EOL;
	}
}
//人事经理
abstract class HiringManager
{
	//工厂方法
	abstract public function makeInterviewer():Interviewer;

	public function takeInterviewer()
	{
		$interviewer = $this->makeInterviewer();
		$interviewer->askQuestions();
	}
}
//子类继承HiringManager并委派相应的面试官
class DevelopmentManager extends HiringManager
{
	public function makeInterviewer():Interviewer
	{
		return new Developer();
	}
}
class MarketingManager extends HiringManager
{
	public function makeInterviewer():Interviewer
	{
		return new CommunityExecutive();
	}
}
//使用
$devManager = new DevelopmentManager();
$devManager->takeInterviewer();

$marketingManager = new MarketingManager();
$marketingManager->takeInterviewer();

/*何时使用？
*类中的一些常见处理需要在运行时动态决定所需的子类，
*换句话说，当客户端不知道可能需要的确切子类时，使用工厂方法模式。
*/