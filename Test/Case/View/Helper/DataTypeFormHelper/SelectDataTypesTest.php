<?php
/**
 * DataTypeFormHelper::selectDataTypes()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsHelperTestCase', 'NetCommons.TestSuite');
App::uses('DataType4testFixture', 'DataTypes.Test/Fixture');

/**
 * DataTypeFormHelper::selectDataTypes()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\DataTypes\Test\Case\View\Helper\DataTypeForm
 */
class DataTypesDataTypeFormHelperSelectDataTypesTest extends NetCommonsHelperTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array();

/**
 * Plugin name
 *
 * @var array
 */
	public $plugin = 'data_types';

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//テストデータ生成
		$records = (new DataType4testFixture())->records;
		$viewVars['dataTypes'] = array(
			$records[0]['key'] => array('DataType' => $records[0]),
			$records[1]['key'] => array('DataType' => $records[1]),
			$records[2]['key'] => array('DataType' => $records[2]),
		);
		$requestData = array(
			'Model' => array('field' => $records[1]['key'])
		);

		//Helperロード
		$this->loadHelper('DataTypes.DataTypeForm', $viewVars, $requestData);
	}

/**
 * selectDataTypes()のテスト
 *
 * @return void
 */
	public function testSelectDataTypes() {
		//テスト実行
		$result = $this->DataTypeForm->selectDataTypes('Model.field');

		//チェック
		$records = (new DataType4testFixture())->records;
		$pattern = '/' . preg_quote('<select name="data[Model][field]" class="form-control" id="ModelField">', '/') . '/';
		$this->assertRegExp($pattern, $result);

		$pattern = '/' . preg_quote('<option value="' . $records[0]['key'] . '">' . $records[0]['name'] . '</option>', '/') . '/';
		$this->assertRegExp($pattern, $result);
		$pattern = '/' . preg_quote('<option value="' . $records[1]['key'] . '" selected="selected">' . $records[1]['name'] . '</option>', '/') . '/';
		$this->assertRegExp($pattern, $result);
		$pattern = '/' . preg_quote('<option value="' . $records[2]['key'] . '">' . $records[2]['name'] . '</option>', '/') . '/';
		$this->assertRegExp($pattern, $result);
	}

/**
 * selectDataTypes()のテスト($attributes付き)
 *
 * @return void
 */
	public function testSelectDataTypesWithAttribute() {
		//テスト実行
		$result = $this->DataTypeForm->selectDataTypes('Model.field', array('original' => 'test', 'class' => 'original class'));

		//チェック
		$records = (new DataType4testFixture())->records;
		$pattern = '/' . preg_quote('<select name="data[Model][field]" original="test" class="original class" id="ModelField">', '/') . '/';
		$this->assertRegExp($pattern, $result);

		$pattern = '/' . preg_quote('<option value="' . $records[0]['key'] . '">' . $records[0]['name'] . '</option>', '/') . '/';
		$this->assertRegExp($pattern, $result);
		$pattern = '/' . preg_quote('<option value="' . $records[1]['key'] . '" selected="selected">' . $records[1]['name'] . '</option>', '/') . '/';
		$this->assertRegExp($pattern, $result);
		$pattern = '/' . preg_quote('<option value="' . $records[2]['key'] . '">' . $records[2]['name'] . '</option>', '/') . '/';
		$this->assertRegExp($pattern, $result);
	}
}
