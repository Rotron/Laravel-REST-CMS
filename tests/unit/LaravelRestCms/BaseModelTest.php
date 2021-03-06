<?php

use App\LaravelRestCms\BaseModel;

class BaseModelTest extends TestCase {

	protected $model;
	protected $table;
	protected $modelName = 'App\LaravelRestCms\BaseModel';
	protected $rules = [
		'col_1' => 'required',
		'col_2' => 'required',
	];

	public function setUp()
    {
        parent::setUp();

        $this->model = $this->getMockForAbstractClass($this->modelName);
        $this->table = 'users';
    }

	public function testGetTable()
	{
		$this->setPrivateProperty($this->model, 'table', $this->table);
		
		$this->assertEquals($this->table, $this->model->getTable());
	}

	public function testGetSingular()
	{
		$this->setPrivateProperty($this->model, 'table', $this->table);
		
		$this->assertEquals('user', $this->model->getSingular());
	}

	public function testGetPlural()
	{
		$this->setPrivateProperty($this->model, 'table', $this->table);
		
		$this->assertEquals('users', $this->model->getPlural());
	}

	public function testFormatTableName()
	{
		$formatted = $this->invokeMethod($this->model, 'formatTableName', ['three_words_here']);

		$this->assertEquals('Three Words Here', $formatted);
	}

	public function testCreate()
	{
		$data = [
			'col_1' => 'a',
			'col_2' => 'b',
		];

		$this->setPrivateProperty($this->model, 'createRules', $this->rules);
		$valid = $this->invokeMethod($this->model, 'validate', [$data]);

		$this->assertTrue($valid);
	}

	/**
	 * @expectedException \Illuminate\Contracts\Validation\ValidationException
	 */
	public function testCreateInvalid()
	{
		$data = [
			'col_1' => 'a',
		];

		$this->setPrivateProperty($this->model, 'createRules', $this->rules);
		$valid = $this->invokeMethod($this->model, 'validate', [$data]);
	}

	public function testUpdate()
	{
		$data = [
			'col_1' => 'a',
			'col_2' => 'b',
		];

		$this->setPrivateProperty($this->model, 'updateRules', $this->rules);
		$valid = $this->invokeMethod($this->model, 'validate', [$data, true]);

		$this->assertTrue($valid);
	}

	/**
	 * @expectedException \Illuminate\Contracts\Validation\ValidationException
	 */
	public function testUpdateInvalid()
	{
		$data = [
			'col_1' => 'a',
		];

		$this->setPrivateProperty($this->model, 'updateRules', $this->rules);
		$valid = $this->invokeMethod($this->model, 'validate', [$data, true]);
	}

	/**
	 * @expectedException \Exception
	 */
	public function testValidateNoRules()
	{
		$data = [
			'col_1' => 'a',
		];

		$this->setPrivateProperty($this->model, 'updateRules', null);
		$valid = $this->invokeMethod($this->model, 'validate', [$data, true]);
	}

}
