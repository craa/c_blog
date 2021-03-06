<?php

/**
 * This is the model base class for the table "{{links}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Links".
 *
 * Columns in table "{{links}}" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $link_id
 * @property string $link_url
 * @property string $link_name
 * @property string $link_image
 * @property string $link_target
 * @property string $link_description
 * @property string $link_visible
 * @property string $link_owner
 * @property integer $link_rating
 * @property string $link_updated
 * @property string $link_rel
 * @property string $link_notes
 * @property string $link_rss
 *
 */
abstract class BaseLinks extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{links}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Links|Links', $n);
	}

	public static function representingColumn() {
		return 'link_url';
	}

	public function rules() {
		return array(
			array('link_notes', 'required'),
			array('link_rating', 'numerical', 'integerOnly'=>true),
			array('link_url, link_name, link_image, link_description, link_rel, link_rss', 'length', 'max'=>255),
			array('link_target', 'length', 'max'=>25),
			array('link_visible, link_owner', 'length', 'max'=>20),
			array('link_updated', 'safe'),
			array('link_url, link_name, link_image, link_target, link_description, link_visible, link_owner, link_rating, link_updated, link_rel, link_rss', 'default', 'setOnEmpty' => true, 'value' => null),
			array('link_id, link_url, link_name, link_image, link_target, link_description, link_visible, link_owner, link_rating, link_updated, link_rel, link_notes, link_rss', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'link_id' => Yii::t('app', 'Link'),
			'link_url' => Yii::t('app', 'Link Url'),
			'link_name' => Yii::t('app', 'Link Name'),
			'link_image' => Yii::t('app', 'Link Image'),
			'link_target' => Yii::t('app', 'Link Target'),
			'link_description' => Yii::t('app', 'Link Description'),
			'link_visible' => Yii::t('app', 'Link Visible'),
			'link_owner' => Yii::t('app', 'Link Owner'),
			'link_rating' => Yii::t('app', 'Link Rating'),
			'link_updated' => Yii::t('app', 'Link Updated'),
			'link_rel' => Yii::t('app', 'Link Rel'),
			'link_notes' => Yii::t('app', 'Link Notes'),
			'link_rss' => Yii::t('app', 'Link Rss'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('link_id', $this->link_id, true);
		$criteria->compare('link_url', $this->link_url, true);
		$criteria->compare('link_name', $this->link_name, true);
		$criteria->compare('link_image', $this->link_image, true);
		$criteria->compare('link_target', $this->link_target, true);
		$criteria->compare('link_description', $this->link_description, true);
		$criteria->compare('link_visible', $this->link_visible, true);
		$criteria->compare('link_owner', $this->link_owner, true);
		$criteria->compare('link_rating', $this->link_rating);
		$criteria->compare('link_updated', $this->link_updated, true);
		$criteria->compare('link_rel', $this->link_rel, true);
		$criteria->compare('link_notes', $this->link_notes, true);
		$criteria->compare('link_rss', $this->link_rss, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}