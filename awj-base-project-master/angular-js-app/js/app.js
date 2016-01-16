var app = angular.module('blog', [ ]);

app.controller('HomeController', ['$scope', '$http', function($scope, $http) {
  $scope.helloWorld = 'Aplicatii Web cu suport Java!';

  $scope.persoane = [];
  $scope.keys = [];

  $scope.person = {};
  $scope.editPerson = {};

$('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)  
});

  $http.get('http://localhost:8080/persoana').then(
    function successCallback(response) {

    $scope.persoane = response;
    $scope.keys = Object.keys(response.data[0]);
  });




  $scope.addPersoana = function(person) {
    $scope.persoane.data.push(person);
    $http.post('http://localhost:8080/persoana', person);
    $scope.person = {};
  };

  $scope.setUpdatePerson = function(person) {
    $scope.editPerson = person;
  };

  $scope.updatePerson = function() {
    $http.put('http://localhost:8080/persoana', $scope.editPerson);
    $scope.editPerson = {};
  };

  $scope.deletePersoana = function(id) {
    $http.delete('http://localhost:8080/persoana/' + id)
    .then(
      function successCallback(response) {
      },
      function errorCallback(response) {
        angular.element('[data-id=' + id + ']').remove();
    });
  };




 //  Resursa Produs

  $scope.produse = [];
  $scope.keys = [];

  $scope.produs = {};
  $scope.editProdus = {};

  $http.get('http://localhost:8080/produs').then(
    function successCallback(response) {

    $scope.produse = response;
    $scope.keys = Object.keys(response.data[0]);
  });


  $scope.addProdus = function(produs) {
    $scope.produse.data.push(produs);
    $http.post('http://localhost:8080/produs', produs);
    $scope.produs = {};
  };

  $scope.setUpdateProdus = function(produs) {
    $scope.editProdus = produs;
  };

  $scope.updateProdus = function() {
    $http.put('http://localhost:8080/produs', $scope.editProdus);
    $scope.editProdus = {};
  };

  $scope.deleteProdus = function(id) {
    $http.delete('http://localhost:8080/produs/' + id)
    .then(
      function successCallback(response) {
      },
      function errorCallback(response) {
        angular.element('[data-id=' + id + ']').remove();
    });


  };


  //Student

  $scope.studente = [];
  $scope.keys = [];

  $scope.student = {};
  $scope.editStudent = {};

  $http.get('http://localhost:8080/student').then(
    function successCallback(response) {

    $scope.studente = response;
    $scope.keys = Object.keys(response.data[0]);
  });


  $scope.addStudent = function(student) {
    $scope.studente.data.push(student);
    $http.post('http://localhost:8080/student', student);
    $scope.student = {};
  };

  $scope.setUpdateStudent = function(student) {
    $scope.editStudent = student;
  };

  $scope.updateStudent = function() {
    $http.put('http://localhost:8080/student', $scope.editStudent);
    $scope.editStudent = {};
  };

  $scope.deleteStudent = function(id) {
    $http.delete('http://localhost:8080/student/' + id)
    .then(
      function successCallback(response) {
      },
      function errorCallback(response) {
        angular.element('[data-id=' + id + ']').remove();
    });


  };

   //Medicament

  $scope.medicamente = [];
  $scope.keys = [];

  $scope.medicament = {};
  $scope.editMedicament = {};

  $http.get('http://localhost:8080/medicament').then(
    function successCallback(response) {

    $scope.medicamente = response;
    $scope.keys = Object.keys(response.data[0]);
  });


  $scope.addMedicament = function(medicament) {
    $scope.medicamente.data.push(medicament);
    $http.post('http://localhost:8080/medicament', medicament);
    $scope.medicament = {};
  };

  $scope.setUpdateMedicament = function(medicament) {
    $scope.editMedicament = medicament;
  };

  $scope.updateMedicament = function() {
    $http.put('http://localhost:8080/medicament', $scope.editMedicament);
    $scope.editMedicament = {};
  };

  $scope.deleteMedicament = function(id) {
    $http.delete('http://localhost:8080/medicament/' + id)
    .then(
      function successCallback(response) {
      },
      function errorCallback(response) {
        angular.element('[data-id=' + id + ']').remove();
    });


  };

  
}]);
