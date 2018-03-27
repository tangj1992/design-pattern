<?php
/*
*中介者模式
*
* 现实生活示例
*典型的例子是你通过手机与他人通话，你与通话者之间有一个网络供应商，
*对话将通过供应商传递而非直接传递。这种情况下网络供应商就是中介者。
*
*概述
*中介者模式添加了第三方对象（称为中介者）来控制两个对象（称为 colleague）之间的交互。
*中介者模式有助于减少通信类之间的耦合，因为类之间无需知道对方的实现。
*
*维基百科
*在软件工程中，中介者模式包装了一系列对象相互作用的方式。这种模式被认为是一种行为模式，
*因为它可以改变程序的运行时行为。
*
*/

//程序示例

//下面是一个最简单的用户（即 colleague）在聊天室（中介者）中互相发送消息的示例
//首先给出中介者及聊天室
interface ChatRoomMediator
{
	public function showMessage(User $user, string $message);
}

class ChatRoom implements ChatRoomMediator
{
	public function showMessage(User $user, string $message)
	{
		$time = date('M d, y H:i');
		$sender = $user->getName();

		echo $time . '[' . $sender . ']' . $message . PHP_EOL;
	}
}
//然后是用户即cooleague
class User{
	protected $name;
	protected $chatMediator;

	public function __construct(string $name, ChatRoomMediator $chatMediator)
	{
		$this->name = $name;
		$this->chatMediator = $chatMediator;
	}

	public function getName()
	{
		return $this->name;
	}

	public function send($message)
	{
		$this->chatMediator->showMessage($this, $message);
	}
}
//使用
$mediator = new ChatRoom();

$john = new User('John Doe', $mediator);
$jane = new User('Jane Doe', $mediator);

$john->send('Hi there!');
$jane->send('Hey!');