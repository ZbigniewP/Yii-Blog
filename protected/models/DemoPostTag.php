<?php

/**
 * This is the model class for table "{{demo_post_tag}}".
 *
 * The followings are the available columns in table '{{demo_post_tag}}':
 * @property integer $post_id
 * @property integer $tag_id
 */
class DemoPostTag extends CActiveRecord
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
		return '{{demo_post_tag}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_id, tag_id', 'required'),
			array('post_id, tag_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('post_id, tag_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'post_id' => 'Post',
			'tag_id' => 'Tag',
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

		$criteria=new CDbCriteria;

		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('tag_id',$this->tag_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DemoPostTag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Returns tag names and their corresponding weights.
	 * Only the tags with the top weights will be returned.
	 * @param integer the maximum number of tags that should be returned
	 * @return array weights indexed by tag names.
	 */
	// public function findTagWeights($limit=20)
	// {
	// 	$models=$this->findAll(array(
	// 		'order'=>'post_id DESC',
	// 		'limit'=>$limit,
	// 	));

	// 	$total=0;
	// 	foreach($models as $model)
	// 		$total+=$model->post_id;

	// 	$tags=array();
	// 	if($total>0)
	// 	{
	// 		foreach($models as $model)
	// 			$tags[$model->tag_id]=8+(int)(16*$model->post_id/($total+10));
	// 		// ksort($tags);
	// 	}
	// 	return $tags;
	// }

	public static function string2array($tags)
	{
		return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}

	public static function array2string($tags)
	{
		return implode(', ',$tags);
	}

	public function updateFrequency($oldTags, $newTags)
	{
		$oldTags=self::string2array($oldTags);
		$newTags=self::string2array($newTags);

		DemoTag::model()->addTags(array_values(array_diff($newTags,$oldTags)));
		DemoTag::model()->removeTags(array_values(array_diff($oldTags,$newTags)));
	}
}
