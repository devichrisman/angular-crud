<?php
  namespace app\controllers;
  use Yii;
  use yii\web\Controller;
  use app\models\Karyawan;

  class UserController extends Controller{

    public function beforeAction($action){
      $this->enableCsrfValidation = false;
      return parent::beforeAction($action);
    }

    public function actionIndex(){
      echo $this->render('index');
    }

    public function actionTambah(){
      $postData    = $_POST;
      $dataObject  = $_POST;
      $file_upload = $_FILES['file']['tmp_name'];
      $extention   = pathinfo($_FILES['file']['name']);
      $namaFile    = Yii::$app->security->generateRandomString();
      $namaFile    = $namaFile.'.'.$extention['extension'];

      /* save .zip to path @app/tms/$this->tanggal()/filename.zip */
        move_uploaded_file($file_upload, Yii::getAlias('@webroot') . '/upload/' . $namaFile);

      $karyawan = new Karyawan;
      $karyawan->nama = $dataObject['data']['nama'];
      $karyawan->alamat = $dataObject['data']['alamat'];
      $karyawan->telp = $dataObject['data']['telp'];
      $karyawan->email = $dataObject['data']['email'];
      // $karyawan->image_upload = $namaFile;
      $karyawan->file_upload = $namaFile;
      $karyawan->save();
    }

    public function actionDapatkanSemuaKaryawan(){
      $karyawan = Karyawan::find()->asArray()->all();
      echo json_encode($karyawan);
    }

    public function actionUbah(){
      $postData = file_get_contents("php://input");
      $dataObject = json_decode($postData);

      $karyawan = Karyawan::findOne($dataObject->data->{'id'});
      $karyawan->nama = $dataObject->data->{'nama'};
      $karyawan->alamat = $dataObject->data->{'alamat'};
      $karyawan->telp = $dataObject->data->{'telp'};
      $karyawan->email = $dataObject->data->{'email'};
      // $karyawan->image_upload = $namaFile;
      $karyawan->file_upload = $dataObject->data->{'file_upload'};
      $karyawan->save();

    }

    public function actionHapus(){
      $postData = file_get_contents("php://input");
      $dataObject = json_decode($postData);

      $karyawan = Karyawan::findOne($dataObject->{'id'});
      $karyawan->delete();

    }

  }
 ?>
