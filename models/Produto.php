<?php

namespace app\models;

use Yii;
use app\models\Categoria;

/**
 * This is the model class for table "produto".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property int $categoriaId
 *
 * @property Categoria $categoria
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'descricao', 'categoriaId'], 'required'],
            [['categoriaId'], 'integer'],
            [['nome'], 'string', 'max' => 20],
            [['descricao'], 'string', 'max' => 100],
            [['categoriaId'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoriaId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'categoriaId' => 'Categoria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoriaId']);
    }

    public function getCategorias()
    {
        return Categoria::find()->all();
    }

    public function getNameCategoria()
    {
        $query = self::find();

        $query->joinWith('categoria');
        
    }
}
