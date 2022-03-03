<?php
use yii\helpers\Url;
use app\models\ChainUsers;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
#echo Yii::$app->user->identity->email;
$clinical_url = ChainUsers::getUrl("clinical_report");
$lab_url = ChainUsers::getUrl("lab_report");
$clinicalqc_url = ChainUsers::getUrl("clinical_qc");
$labqc_url = ChainUsers::getUrl("lab_qc");
$labstorage_url = ChainUsers::getUrl("lab_storage");
$chain2_url = ChainUsers::getUrl("chain2");
$viz_url = ChainUsers::getUrl("viz");
$monitoring_url = ChainUsers::getUrl("monitoring");
$neobac = ChainUsers::getUrl("neobac");
$par = ChainUsers::getUrl("par");
$biorepo = ChainUsers::getUrl("biorepo");
$pbsam = ChainUsers::getUrl("pbsam");
?>

<div class="site-index container">

 <div class="row">
 
  <div class="col-sm-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            PB SAM
        </div>
        <div class="panel-body">
            <img src="images/pbsam.jpg" class="img-rounded thumbnail-img" alt="PB SAM" style="object-fit: contain;"> <br/>
          <a href="<?= $pbsam ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>

   <div class="col-sm-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            Samples Repository
        </div>
        <div class="panel-body">
            <img src="images/images.png" class="img-rounded thumbnail-img" alt="Samples Repository" style="object-fit: contain;"> <br/>
          <a href="<?= $biorepo ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
   </div>
 
  <div class="col-sm-3">
        <div class="panel panel-info">
        <div class="panel-heading">
           NEOBAC Study
        </div>
        <div class="panel-body">
          <img src="images/neobac.png" class="img-rounded thumbnail-img" alt="NeoBAC Study" style="object-fit: contain; margin-bottom:2px;"> <br/>
          <a href="<?= $neobac ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>
  
  <div class="col-sm-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            Paediatric Admission Record
        </div>
        <div class="panel-body">
            <img src="images/paed_icon.png" class="img-rounded thumbnail-img" alt="PAR" style="object-fit: contain;"> <br/>
          <a href="<?= $par ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>
  

  
</div>

 <div class="row">

 <div class="col-sm-3">
        <div class="panel panel-info">
        <div class="panel-heading">
           Data Visualization Reports
        </div>
        <div class="panel-body">
          <img src="images/viz.png" class="img-rounded thumbnail-img" alt="Data Visualization Reports" style="object-fit: contain;"> <br/>
          <a href="<?= $viz_url ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>
 
  <div class="col-sm-3">
        <div class="panel panel-info">
        <div class="panel-heading">
           Clinical Reports (After 31-Jan-2019)
        </div>
        <div class="panel-body">
          <img src="images/chain2reports.jpg" class="img-rounded thumbnail-img" alt="CHAIN II Reports" style="object-fit: contain;"> <br/>
          <a href="<?= $chain2_url ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>
  
  <div class="col-sm-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            Clinical Reports (Before 31-Jan-2019)
        </div>
        <div class="panel-body">
            <img src="images/clinical_reports.jpg" class="img-rounded thumbnail-img" alt="Clinical Reports" style="object-fit: contain;"> <br/>
          <a href="<?= $clinical_url ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>
  
  <div class="col-sm-3">
     <div class="panel panel-success">
        <div class="panel-heading">
            Laboratory Reports
        </div>
        <div class="panel-body">
          <img src="images/laboratory_reports.jpg" class="img-rounded thumbnail-img" alt="Laboratory Reports" style="object-fit: contain;"> <br/>
          <a href="<?= $lab_url ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>

</div>
    
    
 <div class="row">
 
  <div class="col-sm-3">
    <div class="panel panel-warning">
        <div class="panel-heading">
            Clinical QC Reports
        </div>
        <div class="panel-body">
          <img src="images/clinical_QC.jpg" class="img-rounded thumbnail-img" alt="Clinical QC Reports" style="object-fit: contain;"> <br/>
          <a href="<?= $clinicalqc_url ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>

  <div class="col-sm-3">
   <div class="panel panel-info">
        <div class="panel-heading">
            Laboratory Storage Data
        </div>
        <div class="panel-body">
          <img src="images/lab_storage.PNG" class="img-rounded thumbnail-img" alt="Laboratory Storage Data" style= "object-fit: contain;" > <br/>
          <a href="<?= $labstorage_url ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>
  
  <div class="col-sm-3">
     <div class="panel panel-danger">
        <div class="panel-heading">
            Laboratory QC Reports
        </div>
        <div class="panel-body">
          <img src="images/lab_QC.jpg" class="img-rounded thumbnail-img" alt="Laboratory QC Reports" style="object-fit: contain;"> <br/>
          <a href="<?= $labqc_url ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>
  
  <div class="col-sm-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            Source Document Verification Report
        </div>
        <div class="panel-body">
            <img src="images/images.png" class="img-rounded thumbnail-img" alt="Source Document Verification Report" style="object-fit: contain;"> <br/>
          <a href="<?= $monitoring_url ?>" class="btn btn-primary pull-right">Launch</a>
        </div>
    </div>
  </div>
  
</div>
    

    
</div>
