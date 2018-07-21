<?php

/**
 * This is the model class for table "{{demo_comment}}".
 *
 * The followings are the available columns in table '{{demo_comment}}':
 * @property integer $id
 * @property integer $post_id
 * @property integer $author_id
 * @property string $content
 * @property string $publishedAt
 *
 * The followings are the available model relations:
 * @property DemoUser $author
 * @property DemoPost $post
 */
class DemoComment extends CActiveRecord
{
	const STATUS_PENDING = 1;
	const STATUS_APPROVED = 2;

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
		return '{{demo_comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('post_id, author_id, content, publishedAt', 'required'),
			// array('post_id, author_id', 'numerical', 'integerOnly'=>true),
			// // The following rule is used by search().
			// // @todo Please remove those attributes that should not be searched.
			// array('id, post_id, author_id, content, publishedAt', 'safe', 'on'=>'search'),
			array('content, author, email', 'required'),
			array('author, email, url', 'length', 'max' => 128),
			array('email', 'email'),
			array('url', 'url'),
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
			'author' => array(self::BELONGS_TO, 'DemoUser', 'author_id'),
			'post' => array(self::BELONGS_TO, 'DemoPost', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'post_id' => 'Post',
			'author_id' => 'Author',
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
		$criteria->compare('post_id', $this->post_id);
		$criteria->compare('author_id', $this->author_id);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('publishedAt', $this->publishedAt, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DemoComment the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @param integer the maximum number of comments that should be returned
	 * @return array the most recently added comments
	 */
	public function findRecentComments($limit = 10)
	{
		return $this->with('post')->findAll(array(
			'condition' => 't.status=' . self::STATUS_APPROVED,
			'order' => 't.publishedAt DESC',
			'limit' => $limit,
		));
	}

	/**
	 * @return string the hyperlink display for the current comment's author
	 */
	public function getAuthorLink()
	{
		if (!empty($this->url))
			return CHtml::link(CHtml::encode($this->author->fullName), $this->author->email);
		else
			return CHtml::encode($this->author->fullName);
	}

	/**
	 * @param DemoPost the post that this comment belongs to. If null, the method
	 * will query for the post.
	 * @return string the permalink URL for this comment
	 */
	public function getUrl($post = null)
	{
		if ($post === null)
			$post = $this->post;
		return $post->url . '#c' . $this->id;
	}

// after login
	/**
	 * @return integer the number of comments that are pending approval
	 */
	public function getPendingCommentCount()
	{
		// return $this->count('status='.self::STATUS_PENDING);
		return $this->count('status IS NULL OR status=' . self::STATUS_PENDING);
	}

	/**
	 * Approves a comment.
	 */
	public function approve()
	{
		$this->status = self::STATUS_APPROVED;
		$this->update(array('status'));
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			if ($this->isNewRecord)
				$this->publishedAt = time();
			return true;
		} else
			return false;
	}
}
