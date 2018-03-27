<?php
/*
*责任链模式
*
*现实生活示例
*例如，你的帐户中有三种付款方式（A，B 和 C）; 每种方式付款额不同。 
*A 可支付 100 美元，B 可支付 300 美元，C 可支付 1000 美元，支付的优先级为 A->B->C。
*现在想要购买价值 210 美元的东西。使用责任链模式，首先将检查帐户 A 是否可以进行购买，
*如果可以购买，链条将被破坏。如果不能购买，将继续检查账号 B 是否可以购买，
*如果可以购买，链条将被破坏，否则请求将继续转发，直到找到合适的处理程序。
*这里的 A、B 和 C 就是责任链的链条，整个现象就是责任链模式。
*
*概述
*责任链模式有助于建立一个对象链。请求从一端进入，在对象之间转发，直到找到合适的处理程序。

*维基百科
*责任链模式是面向对象程序设计的一种软件设计模式，它包含了一些命令对象和一系列的处理对象。
*每一个处理对象决定它能处理哪些命令对象，不能处理的命令对象传递给该链中的下一个处理对象。
*
*/

//程序示例

//以上面的支付账号为例，首先给出账户基类，包含链接账号的逻辑以及一些不同类型的账户
abstract class Account 
{
	protected $successor;
	protected $balance;

	public function setNext(Account $account)
	{
		$this->successor = $account;
	}

	public function pay(float $amountToPay)
	{
		if ($this->canPay($amountToPay)) {
			echo sprintf('Paid %s using %s' . PHP_EOL, $amountToPay, get_called_class());
		}elseif ($this->successor) {
			echo sprintf('Cannot pay using %s Proceeding...' . PHP_EOL, get_called_class());
			$this->successor->pay($amountToPay);
		}else{
			throw new Exception('None of the accounts have enough balance');
		}
	}

	public function canPay($amount):bool
	{
		return $this->balance >= $amount;
	}
}
class Bank extends Account
{
	protected $balance;

	public function __construct(float $balance)
	{
		$this->balance = $balance;
	}
}
class Paypal extends Account
{
	protected $balance;

	public function __construct(float $balance)
	{
		$this->balance = $balance;
	}
}
class Bitcoin extends Account
{
	protected $balance;

	public function __construct(float $balance)
	{
		$this->balance = $balance;
	}
}
//使用
$bank = new Bank(100);
$paypal = new Paypal(200);
$bitcoin = new Bitcoin(300);

$bank->setNext($paypal);
$paypal->setNext($bitcoin);
$bank->pay(259);