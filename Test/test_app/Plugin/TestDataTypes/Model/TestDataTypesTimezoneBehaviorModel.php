<?php
/**
 * Timezone Behavior用Model
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppModel', 'Model');

/**
 * Timezone Behavior用Model
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\DataTypes\Test\test_app\Plugin\TestDataTypes\Model
 */
class TestDataTypesTimezoneBehaviorModel extends AppModel {

/**
 * テーブルを使用しない
 *
 * @var string
 */
	public $useTable = false;

/**
 * use behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'DataTypes.Timezone'
	);
}
