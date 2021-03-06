<?php
/**
 * DataTypeFormHelper
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AppHelper', 'View/Helper');

/**
 * DataTypeFormHelper
 *
 * @package NetCommons\DataTypes\View\Helper
 */
class DataTypeFormHelper extends AppHelper {

/**
 * Other helpers used by FormHelper
 *
 * @var array
 */
	public $helpers = array(
		'NetCommons.NetCommonsForm',
		'NetCommons.NetCommonsHtml',
	);

/**
 * データタイプの選択リスト
 *
 * @param string $fieldName フィールド名
 * @param array $attributes HTMLの属性オプション
 * @return string SELECTタグ
 * @link http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#options-for-select-checkbox-and-radio-inputs
 */
	public function selectDataTypes($fieldName, $attributes = array()) {
		$dataTypes = Hash::combine(
			$this->_View->viewVars['dataTypes'], '{s}.DataType.key', '{s}.DataType.name'
		);
		$options = Hash::merge(array(
			'type' => 'select',
			'options' => $dataTypes
		), $attributes);

		return $this->NetCommonsForm->input($fieldName, $options);
	}

}
