<?php

/**
 * This is the model class for table "comments".
 *
 * The followings are the available columns in table 'comments':
 * @property integer $id
 * @property string $username
 * @property string $mail
 * @property string $content
 * @property integer $post_id
 * @property string $created
 */
class CakeComments extends CActiveRecord
{
	const STATUS_PENDING = 1;
	const STATUS_APPROVED = 2;

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
		return 'comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_id', 'numerical', 'integerOnly' => true),
			array('username, mail', 'length', 'max' => 255),
			array('content, created', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			// array('id, username, mail, content, post_id, created', 'safe', 'on' => 'search'),

			array('content, username, mail', 'required'),
			// array('username, mail, url', 'length', 'max' => 128),
			array('mail', 'email'),
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
			'post' => array(self::BELONGS_TO, 'CakePosts', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'mail' => 'Mail',
			'content' => 'Content',
			'post_id' => 'Post',
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
		$criteria->compare('username', $this->username, true);
		$criteria->compare('mail', $this->mail, true);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('post_id', $this->post_id);
		$criteria->compare('created', $this->created, true);

		return new CActiveDataProvider($this, array('criteria' => $criteria));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comments the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	public function findRecentComments($limit = 10)
	{
		return $this->with('post')->findAll(array(
			'condition' => 't.status=' . self::STATUS_APPROVED,
			'order' => 't.created DESC',
			'limit' => $limit,
		));
	}
	public function getAuthorLink()
	{
		if (!empty($this->url))
			return CHtml::link(CHtml::encode($this->username), $this->url);
		else
			return CHtml::encode($this->username);
	}
	public function getUrl($post = null)
	{
		if ($post === null)
			$post = $this->post;
		return $post->url . '#c' . $this->id;
	}
// after login
	public function getPendingCommentCount()
	{
		// return $this->count('status='.self::STATUS_PENDING);
		return $this->count('status IS NULL OR status=' . self::STATUS_PENDING);
	}
	public function approve()
	{
		$this->status = self::STATUS_APPROVED;
		$this->update(array('status'));
	}
}