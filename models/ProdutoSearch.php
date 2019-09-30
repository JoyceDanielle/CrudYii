<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Produto;

/**
 * ProdutoSearch represents the model behind the search form of `app\models\Produto`.
 */
class ProdutoSearch extends Produto
{
    public $categoria;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoriaId'], 'integer'],
            [['nome', 'descricao', 'categoria'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Produto::find();

        $query->joinWith('categoria');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'sort' => ['attributes' => ['firstname', 'lastname', 'groupname', 'email', 'pemail']]
        ]);

        $dataProvider->sort->attributes['categoria'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['categoria.nome' => SORT_ASC],
            'desc' => ['categoria.nome' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere(['like', 'produto.nome', $this->nome])
            ->andFilterWhere(['like', 'produto.descricao', $this->descricao])
            ->andFilterWhere(['like', 'categoria.nome', $this->categoria]);

        return $dataProvider;
    }
}
