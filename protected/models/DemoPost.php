<?php

/**
 * This is the model class for table "{{demo_post}}".
 *
 * The followings are the available columns in table '{{demo_post}}':
 * @property integer $id
 * @property integer $author_id
 * @property string $title
 * @property string $slug
 * @property string $summary
 * @property string $content
 * @property string $publishedAt
 *
 * The followings are the available model relations:
 * @property DemoComment[] $demoComments
 * @property DemoUser $author
 * @property DemoTag[] $symfonyDemoTags
 */
class DemoPost extends CActiveRecord
{
	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;

	private $_oldTags;

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
		return '{{demo_post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author_id, title, slug, summary, content, publishedAt', 'required'),
			array('author_id', 'numerical', 'integerOnly'=>true),
			array('title, slug, summary', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			// array('id, author_id, title, slug, summary, content, publishedAt', 'safe', 'on'=>'search'),

			// array('title, content, status', 'required'),
			array('status', 'in', 'range'=>array(1,2,3)),
			// array('title', 'length', 'max'=>128),
			// array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
			// array('tags', 'normalizeTags'),

			array('title, status', 'safe', 'on'=>'search'),
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
			'demoComments' => array(self::HAS_MANY, 'DemoComment', 'post_id'),
			// 'author' => array(self::BELONGS_TO, 'DemoUser', 'author_id'),
			'symfonyDemoTags' => array(self::MANY_MANY, 'DemoTag', '{{demo_post_tag}}(post_id, tag_id)'),
			'author' => array(self::BELONGS_TO, 'DemoUser', 'author_id'),
			'comments' => array(self::HAS_MANY, 'DemoComment', 'post_id', 'condition' => 'comments.status=' . DemoComment::STATUS_APPROVED, 'order' => 'comments.publishedAt DESC'),
			'commentCount' => array(self::STAT, 'DemoComment', 'post_id', 'condition' => 'status=' . DemoComment::STATUS_APPROVED),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author_id' => 'Author',
			'title' => 'Title',
			'slug' => 'Slug',
			'summary' => 'Summary',
			'content' => 'Content',
			'publishedAt' => 'Published At',
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
		$criteria->compare('author_id', $this->author_id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('slug', $this->slug, true);
		$criteria->compare('summary', $this->summary, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('publishedAt', $this->publishedAt, true);

		return new CActiveDataProvider($this, array('criteria' => $criteria));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DemoPost the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('demopost/view', array('id' => $this->id, 'title' => $this->slug));
	}

	/**
	 * @return array a list of links that point to the post list filtered by every tag of this post
	 */
	public function getTagLinks()
	{
		$links = array();
		foreach ($this->symfonyDemoTags as $tag)
			$links[] = CHtml::link(CHtml::encode($tag->name), array('demopost/index', 'tag' => $tag->name));
		return $links;
	}

	/**
	 * Normalizes the user-entered tags.
	 */
	public function normalizeTags($attribute, $params)
	{
		$this->tags = DemoPostTag::array2string(array_unique(DemoPostTag::string2array($this->tags)));
	}

	public function getTags()
	{
		$tags = array();
		foreach ($this->symfonyDemoTags as $tag)
			$tags[] = $tag->name;
		return DemoPostTag::array2string($tags);
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
			$comment->status = DemoComment::STATUS_PENDING;
		else
			$comment->status = DemoComment::STATUS_APPROVED;
		$comment->post_id = $this->id;
		return $comment->save();
	}

	/**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	protected function afterFind()
	{
		parent::afterFind();
		$this->_oldTags = $this->tags;
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			if ($this->isNewRecord) {
				$this->publishedAt = $this->updatedAt = time();
				$this->author_id = Yii::app()->user->id;
			} else
				$this->updatedAt = time();
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
		DemoPostTag::model()->updateFrequency($this->_oldTags, $this->tags);
		// DemoTag::model()->updateFrequency($this->_oldTags, $this->tags);
		// $this->updateFrequency($this->_oldTags, $this->tags);
	}

	/**
	 * This is invoked after the record is deleted.
	 */
	protected function afterDelete()
	{
		parent::afterDelete();
		DemoComment::model()->deleteAll('post_id=' . $this->id);
		DemoPostTag::model()->updateFrequency($this->tags, '');
		// DemoTag::model()->updateFrequency($this->tags, '');
		// $this->updateFrequency($this->tags, '');
	}

	// protected function updateFrequency($oldTags, $newTags)
	// {
	// 	$oldTags = DemoPostTag::string2array($oldTags);
	// 	$newTags = DemoPostTag::string2array($newTags);

	// 	$this->addTags(array_values(array_diff($newTags, $oldTags)));
	// 	$this->removeTags(array_values(array_diff($oldTags, $newTags)));
	// }
}