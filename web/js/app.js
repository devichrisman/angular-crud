var app = angular.module("App",['ngFileUpload']);
app.controller("AppCtrl",function($scope,$http,Upload){
	$scope.aksiSimpan = "tambah";
	$scope.data = {};

	$scope.simpan = function(){
		switch ($scope.aksiSimpan) {
			case "tambah" :
				$scope.tambahData();
			break;
			case "ubah" :
				$scope.ubah();
			break;
		}
	};

	$scope.tambahData = function(){
		// $uibModalInstance.close($scope.selected.item);
        Upload.upload({
            url: '/user/tambah',
            data: {
                file: $scope.file,
                data:  $scope.data
                // _csrf : yii.getCsrfToken()
            }
        }).then(function (resp) {
					$scope.clearData();
					$scope.dapatkanSemuaKaryawan();
            // console.log('Success ' + resp.config.data.file.name + 'uploaded. Response: ' + resp.data);
        }, function (resp) {
            // console.log('Error status: ' + resp.status);
        }, function (evt) {
            // var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            // console.log('progress: '+progressPercentage);
        });
	};

	$scope.clearData = function(){
		$scope.data = {
			nama : "",
			alamat : "",
			telp : "",
			email : "",
			image_upload : ""
			};
	};

	$scope.dapatkanSemuaKaryawan = function(){
		$http.get(
			'user/dapatkan-semua-karyawan'
		).success(function(data){
			$scope.semuaKaryawan = data;
		});
	};

	$scope.preUbah = function(karyawan){
		$scope.data = karyawan;
		$scope.aksiSimpan = "ubah";
	};

	$scope.ubah = function(){
		$http.post(
			'user/ubah',
			{
				data : $scope.data
			}
		).success(function(){
			$scope.clearData();
			$scope.dapatkanSemuaKaryawan();
			$scope.aksiSimpan = "tambah";
		}).error(function(){
			alert("gagal ubah data");
		});
	};

	$scope.hapus = function(id){
		$http.post(
			'user/hapus',
			{
				id : id
			}
		).success(function(){
			$scope.dapatkanSemuaKaryawan();
		}).error(function(){
			alert("gagal hapus");
		});
	};

	$scope.dapatkanSemuaKaryawan();

});
