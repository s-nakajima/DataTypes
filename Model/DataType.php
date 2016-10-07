<?php
/**
 * DataType Model
 *
 * @property Language $Language
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('DataTypesAppModel', 'DataTypes.Model');

/**
 * DataType Model
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\DataTypes\Model
 */
class DataType extends DataTypesAppModel {

/**
 * データタイプキー
 *
 * @var int
 */
	const
		DATA_TYPE_LABEL = 'label',
		DATA_TYPE_TEXT = 'text',
		DATA_TYPE_TEXTAREA = 'textarea',
		DATA_TYPE_RADIO = 'radio',
		DATA_TYPE_CHECKBOX = 'checkbox',
		DATA_TYPE_SELECT = 'select',
		DATA_TYPE_MULTIPLE_SELECT = 'multiple_select',
		DATA_TYPE_PASSWORD = 'password',
		DATA_TYPE_EMAIL = 'email',
		DATA_TYPE_IMG = 'img',
		DATA_TYPE_FILE = 'file',
		DATA_TYPE_DATE = 'date',
		DATA_TYPE_TIME = 'time',
		DATA_TYPE_DATETIME = 'datetime',
		DATA_TYPE_WYSIWYG = 'wysiwyg',
		DATA_TYPE_PREFECTURE = 'prefecture',
		DATA_TYPE_TIMEZONE = 'timezone';

/**
 * チェックボックスのセパレータ
 *
 * @var const
 */
	const CHECKBOX_SEPARATOR = "\n";

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Language' => array(
			'className' => 'M17n.Language',
			'foreignKey' => 'language_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * Called during validation operations, before validation. Please note that custom
 * validation rules can be defined in $validate.
 *
 * @param array $options Options passed from Model::save().
 * @return bool True if validate operation should continue, false to abort
 * @link http://book.cakephp.org/2.0/en/models/callback-methods.html#beforevalidate
 * @see Model::save()
 */
	public function beforeValidate($options = array()) {
		$this->validate = Hash::merge($this->validate, array(
			'language_id' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					'message' => __d('net_commons', 'Invalid request.'),
					//'allowEmpty' => false,
					//'required' => true,
				),
			),
			'key' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => __d('net_commons', 'Invalid request.'),
					//'required' => true,
				),
			),
			'name' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => __d('net_commons', 'Invalid request.'),
					//'required' => true,
				),
			),
			'weight' => array(
				'numeric' => array(
					'rule' => array('numeric'),
					'message' => __d('net_commons', 'Invalid request.'),
					//'allowEmpty' => false,
					'required' => false,
				),
			),
		));

		return parent::beforeValidate($options);
	}

/**
 * データタイプを取得
 *
 * @param array $dataTypeKey DataType.keyの配列
 * @return array DataTypes配列
 */
	public function getDataTypes($dataTypeKey = array()) {
		$this->loadModels([
			'DataTypeChoice' => 'DataTypes.DataTypeChoice',
		]);

		//データ取得
		$dataTypes = $this->find('all', array(
			'recursive' => -1,
			'conditions' => array(
				$this->alias . '.language_id' => Current::read('Language.id'),
				$this->alias . '.key' => $dataTypeKey
			),
		));
		$dataTypes = Hash::combine($dataTypes, '{n}.' . $this->alias . '.key', '{n}');

		//データ取得
		$dataTypeChoices = $this->DataTypeChoice->find('all', array(
			'recursive' => -1,
			'conditions' => array(
				$this->DataTypeChoice->alias . '.language_id' => Current::read('Language.id'),
				$this->DataTypeChoice->alias . '.data_type_key' => $dataTypeKey
			),
		));
		$dataTypeChoices = Hash::combine(
			$dataTypeChoices,
			'{n}.' . $this->DataTypeChoice->alias . '.id',
			'{n}.' . $this->DataTypeChoice->alias,
			'{n}.' . $this->DataTypeChoice->alias . '.data_type_key'
		);
		foreach ($dataTypeChoices as $key => $choices) {
			$dataTypes[$key][$this->DataTypeChoice->alias] = $choices;
		}

		$typeKey = self::DATA_TYPE_TIMEZONE;
		if (isset($dataTypes[$typeKey])) {
			$dataTypes[$typeKey][$this->DataTypeChoice->alias] = $this->DataTypeChoice->getTimezone();
		}

		return $dataTypes;
	}

/**
 * 言語データタイプを取得
 *
 * @return array DataTypes配列
 */
	public function getLanguages() {
		App::uses('L10n', 'I18n');
		$L10n = new L10n();

		$languages = $this->Language->getLanguage();

		$results = array();
		foreach ($languages as $lang) {
			$catalog = $L10n->catalog($lang['Language']['code']);

			$results[] = array(
				'key' => $lang['Language']['code'],
				'name' => __d('m17n', $catalog['language']),
				'code' => $lang['Language']['code'],
				'language_id' => $lang['Language']['id'],
			);
		}

		return $results;
	}

}
