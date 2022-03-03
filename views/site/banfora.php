<?php
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

$db = new yii\db\Connection([
    'dsn' => 'mysql:host=keklf-mysql01;dbname=kidms',
    'username' => 'ictdev',
    'password' => 'ictP@ss',
    'charset' => 'utf8',
]);

$query = $db->createCommand("SELECT serial_study_id, spt.type_name, lsr.time_point, sp.id sp_id , sp.pk_specimen_id, sp.parent_id  , 
IF(IFNULL(sp.parent_id,sp.id  ) = @rownum , (@rowcnt:= @rowcnt +1) , @rowcnt:=0) aliquot, 
@rownum := IFNULL(sp.parent_id,sp.id  ) dummycol 
FROM `lab_sample_receive` lsr INNER JOIN `lab_specimen` sp  ON lsr.id = sp.`fk_receive_specimen` 
LEFT JOIN `lab_specimen_type` spt ON sp.fk_specimen_type = spt.id ,  (SELECT @rownum:=0 ) rn , (SELECT @rowcnt:=0 ) ct
WHERE `serial_study_id` LIKE '60001%' AND lsr.time_point IS NOT NULL
GROUP BY  serial_study_id, spt.type_name, lsr.time_point, sp.id  , sp.pk_specimen_id 
ORDER BY serial_study_id , sp.id")
            ->queryAll();

?>
<div class="panel panel-info banfora-index">
      <div class="panel-heading"><?=  "<h3> Banfora Samples </h3>" ?></div>
      <div class="panel-body row">
          <?php
           
$searchAttributes = ['serial_study_id', 'type_name', 'time_point','pk_specimen_id','aliquot'];
$searchModel = [];
$searchColumns = [];

foreach ($searchAttributes as $searchAttribute) {
    $filterName = 'filter' . $searchAttribute;
    $filterValue = Yii::$app->request->getQueryParam($filterName, '');
    $searchModel[$searchAttribute] = $filterValue;
    $searchColumns[] = [
        'attribute' => $searchAttribute,
        'filter' => '<input class="form-control" name="' . $filterName . '" value="' . $filterValue . '" type="text">',
        'value' => $searchAttribute,
    ];
    $query = array_filter($query, function($item) use (&$filterValue, &$searchAttribute) {
        return strlen($filterValue) > 0 ? stripos('/^' . strtolower($item[$searchAttribute]) . '/', strtolower($filterValue)) : true;
    });
}

echo GridView::widget([
    'dataProvider' => new ArrayDataProvider([
        'allModels' => $query,
        'sort' => [
            'attributes' => $searchAttributes,
        ],
            ]),
    'filterModel' => $searchModel,
    'columns' => array_merge(
            $searchColumns
    )
]);

          ?>
      </div>
</div>

