<div ng-app="App" ng-controller="AppCtrl">
  <fieldset>
    <legend>Data User</legend>
    <table class="table">
      <thead>
        <th>#</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Email</th>
        <!-- <th>File Upload IMAGE</th> -->
        <th>File Upload ZIP</th>
        <th>Aksi</th>
      </thead>
      <tbody>
        <tr>
          <td></td>
          <td>
            <input placeholder="Nama User" type="text" class="form-control" ng-model="data.nama" />
          </td>
          <td>
            <input placeholder="Alamat User" type="text" class="form-control" ng-model="data.alamat" />
          </td>
          <td>
            <input placeholder="Telepon User" type="text" class="form-control" ng-model="data.telp" />
          </td>
          <td>
            <input placeholder="Email User" type="text" class="form-control" ng-model="data.email" />
          </td>
          <!-- <td>
            <input type="file" ngf-select ng-model="file" name="image_upload"
            ngf-accept="'application/png'" ngf-max-size="50MB">
          </td> -->
          <td>
            <input type="file" ngf-select ng-model="file" name="file_upload"
						ngf-accept="'application/png'" ngf-max-size="50MB">
          </td>
          <td>
            <button class="btn btn-primary" ng-click="simpan()">Simpan</button>
          </td>
        </tr>
        <tr ng-repeat="karyawan in semuaKaryawan">
          <td>{{$index+1}}</td>
          <td>{{karyawan.nama}}</td>
          <td>{{karyawan.alamat}}</td>
          <td>{{karyawan.telp}}</td>
          <td>{{karyawan.email}}</td>
          <!-- <td>
            <a href="/upload/{{karyawan.image_upload}}" class="btn btn-warning">Download</a>
          </td> -->
          <td>
            <a href="/upload/{{karyawan.file_upload}}" class="btn btn-warning">Download</a>
          </td>
          <td>
            <button class="btn btn-success" ng-click="preUbah(karyawan)">Ubah</button>
            <button class="btn btn-danger" ng-click="hapus(karyawan.id)">Hapus</button>
          </td>
        </tr>
      </tbody>
    </table>
  </fieldset>

</div>

<?php
  echo $this->registerJsFile("/js/angular.js");
  echo $this->registerJsFile("/ng-file-upload-master/dist/ng-file-upload-shim.js");
  echo $this->registerJsFile("/ng-file-upload-master/dist/ng-file-upload.min.js");
  echo $this->registerJsFile("/js/app.js");
 ?>
