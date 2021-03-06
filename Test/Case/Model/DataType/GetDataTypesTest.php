<?php
/**
 * DataType::getDataTypes()のテスト
 *
 * @property DataType $DataType
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * DataType::getDataTypes()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\DataTypes\Test\Case\Model\DataType
 */
class DataTypeGetDataTypesTest extends NetCommonsGetTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.data_types.data_type4test',
		'plugin.data_types.data_type_choice4test',
	);

/**
 * Plugin name
 *
 * @var array
 */
	public $plugin = 'data_types';

/**
 * Model name
 *
 * @var array
 */
	protected $_modelName = 'DataType';

/**
 * Method name
 *
 * @var array
 */
	protected $_methodName = 'getDataTypes';

/**
 * getDataTypes()のテスト
 *
 * @return void
 */
	public function testGetDataTypes() {
		//テスト実施
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$result = $this->$model->$methodName();

		//チェック
		$this->assertEquals(0, count($result));
	}

/**
 * getDataTypes()のテスト(DataTypeChoiceのデータなし)
 *
 * @return void
 */
	public function testGetDataTypesWODataTypeChoice() {
		//テスト実施
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$dataTypeKey = array(
			'label', 'text', 'textarea'
		);
		$result = $this->$model->$methodName($dataTypeKey);

		//チェック
		$expected = $dataTypeKey;
		$this->assertEquals($expected, array_keys($result));

		$this->assertEquals(0, count(Hash::extract($result, '{s}.DataTypeChoice')));
	}

/**
 * getDataTypes()のテスト(DataTypeChoiceのデータあり(都道府県))
 *
 * @return void
 */
	public function testGetDataTypesWDataTypeChoice() {
		//テスト実施
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$dataTypeKey = array(
			'label', 'textarea', 'prefecture'
		);
		$result = $this->$model->$methodName($dataTypeKey);

		//チェック
		$expected = $dataTypeKey;
		$this->assertEquals($expected, array_keys($result));
		$this->assertTrue(Hash::check($result, 'prefecture.DataTypeChoice'));
		$this->assertCount(6, Hash::get($result, 'prefecture.DataTypeChoice'));
	}

/**
 * getDataTypes()のテスト(timezone)
 *
 * @return void
 */
	public function testGetDataTypesTimezone() {
		//テスト実施
		$model = $this->_modelName;
		$methodName = $this->_methodName;
		$dataTypeKey = array(
			'label', 'textarea', 'timezone'
		);
		$result = $this->$model->$methodName($dataTypeKey);

		//チェック
		$expected = $dataTypeKey;
		$this->assertEquals($expected, array_keys($result));
		$this->assertTrue(Hash::check($result, 'timezone.DataTypeChoice'));

		$count = count(DateTimeZone::listIdentifiers(DateTimeZone::ALL));
		$this->assertCount($count, Hash::extract($result, 'timezone.DataTypeChoice'));
	}

}
