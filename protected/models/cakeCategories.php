<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $post_count
 */
class CakeCategories extends CActiveRecord
{

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->db_cake;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_count', 'numerical', 'integerOnly' => true),
			array('name, slug', 'length', 'max' => 255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, slug, post_count', 'safe', 'on' => 'search'),
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
			'post' => array(self::HAS_MANY, 'CakePosts', 'category_id'),
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
			'slug' => 'Slug',
			'post_count' => 'Post Count',
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
		$criteria->compare('slug', $this->slug, true);
		$criteria->compare('post_count', $this->post_count);

		return new CActiveDataProvider($this, array('criteria' => $criteria));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Categories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function findCategoriesWeights($limit = 20)
	{
		$models = $this->findAll(array(
			'order' => 'post_count DESC',
			'limit' => $limit,
		));

		$total = 0;
		foreach ($models as $model)
			$total += $model->post_count;

		$category = array();
		if ($total > 0) {
			foreach ($models as $model)
				$category[$model->name] = array($model->id, 8 + (int)(16 * $model->post_count / ($total + 10)));
			ksort($category);
		}
		return $category;
	}

	public static function string2array($category)
	{
		return preg_split('/\s*,\s*/', trim($category), -1, PREG_SPLIT_NO_EMPTY);
	}

	public static function array2string($category)
	{
		return implode(', ', $category);
	}

	public function findTopCategories($limit = 10)
	{
		return $this->findAll(array(
			'order' => 'post_count DESC',
			'limit' => $limit,
		));
	}
}