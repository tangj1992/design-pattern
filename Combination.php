<?php
/*
*组合模式
*
* 现实生活示例
*每个公司都是由员工组成，每个员工都有一些共同特征比如薪资以及所承担的某些责任，
*会或者不会向其他人汇报工作，有或者没有下属等。
*
*概述
*组合模式让客户端以统一的方式对待各个对象。
*
*维基百科
*在软件工程中，组合模式是一种分治设计模式。组合模式对待一组对象的处理方式与对待对象的单个实例相同。
*组合的意图是将对象“组合”成树状结构以呈现部分-整体的层次结构。
*实现组合模式可以使客户端能够均匀地处理单个对象和组合。
*/

//程序示例

//以上面提到的员工为例，下面是不同的员工类型
interface Employee
{
	public function __construct(string $name, float $salary);
	public function getName():string;
	public function setSalary(float $salary);
	public function getSalary():float;
	public function getRoles():array;
}
//开发
class Developer implements Employee
{
	protected $salary;
	protected $name;

	public function __construct(string $name, float $salary)
	{
		$this->name   = $name;
		$this->salary = $salary;
	}

	public function getName():string
	{
		return $this->name;
	}

	public function setSalary(float $salary)
	{
		$this->salary = $salary;
	}

	public function getSalary():float
	{
		return $this->salary;
	}

	public function getRoles():array
	{
		return $this->rloes;
	}
}
//设计
class Designer implements Employee
{
	protected $salary;
	protected $name;

	public function __construct(string $name, float $salary)
	{
		$this->name   = $name;
		$this->salary = $salary;
	}

	public function getName():string
	{
		return $this->name;
	}

	public function setSalary(float $salary)
	{
		$this->salary = $salary;
	}

	public function getSalary():float
	{
		return $this->salary;
	}

	public function getRoles():array
	{
		return $this->rloes;
	}
}
//包含几种不同类型员工的公司
class Organization
{
	protected $employees;

	public function addEmployee(Employee $employee)
	{
		$this->employees[] = $employee;
	}

	public function getNetSalaries():float
	{
		$netSalary = 0;

		foreach ($this->employees as $employee) {
			$netSalary += $employee->getSalary();
		}

		return $netSalary;
	}
}
//使用
$john = new Developer('John Doe', 12000);
$jane = new Designer('Jane Doe', 15000);
//加入公司
$organization = new Organization();
$organization->addEmployee($john);
$organization->addEmployee($jane);

echo 'Net salaries:' . $organization->getNetSalaries();

