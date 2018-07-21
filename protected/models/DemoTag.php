<?php

/**
 * This is the model class for table "{{demo_tag}}".
 *
 * The followings are the available columns in table '{{demo_tag}}':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property DemoPost[] $symfonyDemoPosts
 */
class DemoTag extends CActiveRecord
{

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db_symfony;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{demo_tag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			// // The following rule is used by search().
			// // @todo Please remove those attributes that should not be searched.
			// array('id, name', 'safe', 'on'=>'search'),

			// array('name', 'required'),
			array('frequency', 'numerical', 'integerOnly'=>true),
			// array('name', 'length', 'max'=>128),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'symfonyDemoPosts' => array(self::MANY_MANY, 'DemoPost', '{{demo_post_tag}}(tag_id, post_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DemoTag the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Returns tag names and their corresponding weights.
	 * Only the tags with the top weights will be returned.
	 * @param integer the maximum number of tags that should be returned
	 * @return array weights indexed by tag names.
	 */
	public function findTagWeights($limit = 20)
	{
		$models = $this->findAll(array(
			'order' => 'frequency DESC',
			'limit' => $limit,
		));

		$total = 0;
		foreach ($models as $model)
			$total += $model->frequency;

		$tags = array();
		if ($total > 0) {
			foreach ($models as $model)
				$tags[$model->name] = 8 + (int)(16 * $model->frequency / ($total + 10));
			ksort($tags);
		}
		return $tags;
	}
	
	/**
	 * Suggests a list of existing tags matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of tags to be returned
	 * @return array list of matching tag names
	 */
	public function suggestTags($keyword, $limit = 20)
	{
		$tags = $this->findAll(array(
			'condition' => 'name LIKE :keyword',
			'order' => 'frequency DESC, Name',
			'limit' => $limit,
			'params' => array(
				':keyword' => '%' . strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
			),
		));
		$names = array();
		foreach ($tags as $tag)
			$names[] = $tag->name;
		return $names;
	}

	// public function updateFrequency($oldTags, $newTags)
	// {
	// 	$oldTags=self::string2array($oldTags);
	// 	$newTags=self::string2array($newTags);
	// 	$this->addTags(array_values(array_diff($newTags,$oldTags)));
	// 	$this->removeTags(array_values(array_diff($oldTags,$newTags)));
	// }
	public function addTags($tags)
	{
		$criteria = new CDbCriteria;
		$criteria->addInCondition('name', $tags);
		$this->updateCounters(array('frequency' => 1), $criteria);
		foreach ($tags as $name) {
			if (!$this->exists('name=:name', array(':name' => $name))) {
				$tag = new DemoTag;
				$tag->name = $name;
				$tag->frequency = 1;
				$tag->save();
			}
		}
	}

	public function removeTags($tags)
	{
		if (empty($tags))
			return;
		$criteria = new CDbCriteria;
		$criteria->addInCondition('name', $tags);
		$this->updateCounters(array('frequency' => -1), $criteria);
		$this->deleteAll('frequency<=0');
	}
}
