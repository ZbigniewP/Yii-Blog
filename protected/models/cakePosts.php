<?php

/**
 * This is the model class for table "posts".
 *
 * The followings are the available columns in table 'posts':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $content
 * @property integer $category_id
 * @property integer $user_id
 * @property string $created
 */
class CakePosts extends CActiveRecord
{
	const STATUS_DRAFT = 1;
	const STATUS_PUBLISHED = 2;
	const STATUS_ARCHIVED = 3;

	private $_oldCategory;

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
		return 'posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, user_id', 'numerical', 'integerOnly' => true),
			array('name, slug', 'length', 'max' => 255),
			array('content, created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			// array('id, name, slug, content, category_id, user_id, created', 'safe', 'on' => 'search'),

			array('name, content, status', 'required'),
			array('status', 'in', 'range' => array(1, 2, 3)),
			// array('title', 'length', 'max' => 128),
			// array('category_id', 'match', 'pattern' => '/^[\w\s,]+$/', 'message' => 'Category can only contain word characters.'),
			array('category_id', 'normalizeCategory'),

			array('name, status', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		// return array();
		return array(
			'user' => array(self::BELONGS_TO, 'CakeUsers', 'user_id'),
			'category' => array(self::BELONGS_TO, 'CakeCategories', 'category_id'),

			'author' => array(self::BELONGS_TO, 'CakeUsers', 'user_id'),
			'comments' => array(self::HAS_MANY, 'CakeComments', 'post_id', 'order' => 'comments.created DESC'),//'condition' => 'comments.status=' . CakeComments::STATUS_APPROVED,
			'commentCount' => array(self::STAT, 'CakeComments', 'post_id'),//, 'condition' => 'status=' . CakeComments::STATUS_APPROVED
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
			'content' => 'Content',
			'category_id' => 'Category',
			'user_id' => 'User',
			'created' => 'Created',
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
		$criteria->compare('content', $this->content, true);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('created', $this->created, true);

		return new CActiveDataProvider($this, array('criteria' => $criteria));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CakePosts the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function getUrl()
	{
		return Yii::app()->createUrl('cakeposts/view', array('id' => $this->id, 'title' => $this->slug));
	}

	public function getCategoryLink()
	{
		$category = CakeCategories::model()->findByPk($this->category_id);
		if(isset($category->id)) return CHtml::link(CHtml::encode($category->name), array('cakeposts/index', 'tag' => $category->id));
	}
// after login
	public function normalizeCategory($attribute, $params)
	{
// echo "<pre>";
// print_r([$this->_oldCategory, $this->category,$this->category_id,$attribute, $params,$_POST]);
// echo "</pre>";
// exit();
// 		// $this->category_id=Tag::array2string(array_unique(Tag::string2array($this->category_id)));
// 		$this->category_id = CakeCategories_array2string(array_unique(CakeCategories::string2array($this->category_id)));
	}

	public function getCategory()
	{
// $models = CakeCategories::model()->findAll();
// $category = array();
// foreach ($models as $tag)
// $category[] = $tag->name;
// return CakeCategories::array2string($category);
// 'condition' => 'status=' . CakePosts::STATUS_PUBLISHED,
// 'order' => 'updated DESC',
// 'with' => 'commentCount',
// 'select' => array('id', 'name'),
// self::model()->select='id,name';
		$category = CakeCategories::model()->findByPk($this->category_id);
		return $category->name;
	}

	public function findLastPosts($limit = 10)
	{
		return $this->findAll(array(
			'condition' => 'status=' . self::STATUS_PUBLISHED,
			'order' => 'updated DESC',
			'with' => 'commentCount',
			'limit' => $limit
		));
	}

	/**
	 * Adds a new comment to this post.
	 * This method will set status and post_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment($comment)
	{
		if (Yii::app()->params['commentNeedApproval'])
			$comment->status = CakeComments::STATUS_PENDING;
		else
			$comment->status = CakeComments::STATUS_APPROVED;
		$comment->post_id = $this->id;
		return $comment->save();
	}

	/**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	protected function afterFind()
	{
		parent::afterFind();
		$this->_oldCategory = $this->category;
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			if ($this->isNewRecord) {
				$this->published = $this->updated = time();
				$this->author_id = Yii::app()->user->id;
			} else
				$this->updated = time();
			return true;
		} else
			return false;
	}

	/**
	 * This is invoked after the record is saved.
	 */
	protected function afterSave()
	{
		parent::afterSave();
		// DemoPostTag::model()->updateFrequency($this->_oldCategory, $this->category);
		// DemoTag::model()->updateFrequency($this->_oldCategory, $this->category);
// echo "<pre>";
// print_r([$this->_oldCategory, $this->category]);
// echo "</pre>";
// exit();
// 		$this->updatePostCount($this->_oldCategory, $this->category);
	}
	
	/**
	 * This is invoked after the record is deleted.
	 */
	protected function afterDelete()
	{
		parent::afterDelete();
		// CakeComments::model()->deleteAll('post_id=' . $this->id);
		// DemoPostTag::model()->updateFrequency($this->category, '');
		// DemoTag::model()->updateFrequency($this->category, '');
		$this->updatePostCount($this->category, '');
	}
}