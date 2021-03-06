<?php namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%authors}}".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 *
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%authors}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['firstname', 'lastname'], 'required'],
            [['firstname', 'lastname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks() {
        return $this->hasMany(Books::className(), ['author_id' => 'id']);
    }

    public function getFullName() {
        return $this->lastname . ', ' . $this->firstname;
    }

}
