<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Produto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="produto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
    $listData=ArrayHelper::map($todos,'id','nome');
    ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?=
    /*
    $form->field($model, 'categoriaId')->dropDownList(
        $listData,
        ['prompt'=>'Select...']
        ); 
   */     

        $form->field($model, 'categoriaId')->widget(Select2::classname(), [
            'data' => $listData,
            'options' => ['placeholder' => 'Escolha Categoria'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            'options' => ['placeholder' => 'Escolha Categoria'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])
        
        
        ?>

     
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success mt-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
