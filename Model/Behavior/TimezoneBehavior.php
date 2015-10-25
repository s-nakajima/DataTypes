<?php
/**
 * Timezone Behavior
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('ModelBehavior', 'Model');

/**
 * Timezone Behavior
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\DataTypes\Model\Behavior
 */
class TimezoneBehavior extends ModelBehavior {

/**
 * タイムゾーンの取得
 *
 * @param Model $model Model ビヘイビア呼び出し元モデル
 * @param string $what タイムゾーン(地域)
 * @param string $country 2文字のISO3166-1互換の国コード
 * @return bool True on success
 * @throws InternalErrorException
 */
	public function getTimezone(Model $model, $what = null, $country = null) {
		$results = array();

		if (! isset($what)) {
			if (! isset($country)) {
				$what = DateTimeZone::ALL;
			} else {
				$what = DateTimeZone::PER_COUNTRY;
			}
		}
		$timezoneIdentifiers = DateTimeZone::listIdentifiers($what, $country);
		foreach ($timezoneIdentifiers as $timezone) {
			$results[] = array(
				'key' => $timezone,
				'name' => __d('data_types', $timezone),
				'code' => $timezone,
				'language_id' => Current::read('Language.id'),
			);
		}

		return $results;
	}

}
