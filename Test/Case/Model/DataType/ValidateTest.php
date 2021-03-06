<?php
/**
 * DataType::validates()のテスト
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsValidateTest', 'NetCommons.TestSuite');
App::uses('DataTypeFixture', 'DataTypes.Test/Fixture');

/**
 * DataType::validates()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\DataTypes\Test\Case\Model\DataType
 */
class DataTypeFixtureValidateTest extends NetCommonsValidateTest {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.data_types.data_type',
		'plugin.data_types.data_type_choice',
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
	protected $_methodName = 'validates';

/**
 * ValidationErrorのDataProvider
 *
 * #### 戻り値
 *  - field フィールド名
 *  - value セットする値
 *  - message エラーメッセージ
 *  - overwrite 上書きするデータ
 *
 * @return array
 */
	public function dataProviderValidationError() {
		$data['DataType'] = (new DataTypeFixture())->records[0];

		return array(
			array($data, 'language_id', 'aaa', __d('net_commons', 'Invalid request.')),
			array($data, 'key', '', __d('net_commons', 'Invalid request.')),
			array($data, 'name', '', __d('net_commons', 'Invalid request.')),
			array($data, 'weight', 'aaa', __d('net_commons', 'Invalid request.')),
		);
	}

}
