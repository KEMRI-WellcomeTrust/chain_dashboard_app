<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%chain_sites}}".
 *
 * @property int $id
 * @property string $site_name
 * @property string $county
 *
 * @property ChainUsers[] $chainUsers
 */
class ChainSites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chain_sites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['site_name', 'county'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_name' => 'Site Name',
            'county' => 'County',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChainUsers()
    {
        return $this->hasMany(ChainUsers::className(), ['fk_site' => 'id']);
    }
    
    public static function getSiteOptions(){
        $sites = Self::find()->All();
        $return = [];
        
        foreach($sites as $site){
            $return[$site->id] = $site->site_name;
        }
        return $return;
    }
}
