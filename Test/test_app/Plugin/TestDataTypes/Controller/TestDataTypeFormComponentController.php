<?php
/**
 * DataTypeFormComponentのテスト用Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppController', 'Controller');

/**
 * DataTypeFormComponentのテスト用Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\DataTypes\Test\test_app\Plugin\TestDataTypes\Controller
 */
class TestDataTypeFormComponentController extends AppController {

/**
 * use component
 *
 * @var array
 */
	public $components = array(
		'DataTypes.DataTypeForm',
	);

/**
 * index
 *
 * @return void
 **/
	public function index() {
	}
}
