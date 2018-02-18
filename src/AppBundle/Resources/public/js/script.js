/*
 * Created by tuntech on 05-02-2018.
 * Copyright (C) Ste- TUNTECH
 * Développé   par : Nour El Houda Banbia
 * Description : cette page contient les fonctions js utilisées dans le site
 *
 */
                        /********************************
                        *********************************
                        ******Gestion Catégories       ** 
                        *********************************
                        *********************************/
   //fonction qui verifie si la designation de la categorie entrée est unique
   function find_categorie(){
      var des=$('#des').val();
      if(des==""){
        $('#alert-des').text("");
        $('#new-cat').css('display','none');
      }else{
          $('#new-cat').css('display','block');
          var action = "find";
          var des=$('#des').val();
          xhr = new XMLHttpRequest;
          xhr.responseType = 'json';
          var URL = "ajax/categories.php?action="+action+"&designation="+des;
          xhr.open("GET",URL,true);
          xhr.send(null);
          xhr.onreadystatechange = result;
          function result(){
            if (this.readyState === 4 && this.status === 200) {
              var data = xhr.response;
              //data = xhr.responseText;
              if(data.status == 'unique'){
                $('#alert-des').addClass('text-success');
                $('#alert-des').removeClass('text-warning');
                $('#alert-des').removeClass('text-danger');
                $('#alert-des').text(data.result);
                
                $('#new-cat').css('display','block');
              }else if(data.status == 'not-unique'){
                $('#alert-des').text(data.result);
                $('#alert-des').addClass('text-warning');
                $('#alert-des').removeClass('text-success');
                $('#alert-des').removeClass('text-danger');
                $('#new-cat').css('display','none');
              }else{
                $('#alert-des').text(data.result);
                $('#alert-des').addClass('text-danger');
                $('#alert-des').removeClass('text-success');
                $('#alert-des').removeClass('text-warning');
                $('#new-cat').css('display','block');
              }
            }
          }
      }
   }
//lancer popups categories (page categories_prods.php)
   function lancer_modals_categorie(modal,id,des){
    if(modal=="#suppCat"){
      $('#suppCat').modal('show');
      $("#alert-supp-cat").html("");
      $("#btn-supp").css('display','block');
      $("#id-cat-supp").val(id);
    }else if(modal =="#newCat"){
        $('#newCat').modal('show');
        $('#des').val("");
        $('#new-cat').css('display','block');
        $('#alert-des').text("");
          $('#alert-des').removeClass('text-success');
          $('#alert-des').removeClass('text-danger');
          $('#alert-des').removeClass('text-warning');
    }else{
      $('#editCat').modal('show');
      $("#btn-edit").css('display','block');
      $("#alert-edit-cat").html("");
      $("#des-cat").val(des);
      $("#id-cat-edit").val(id);
      
    }
  }
  //ajouter une nouvelle catégorie
  function new_categorie(){
    var action = "new";
    var des=$('#des').val();
    xhr = new XMLHttpRequest;
    xhr.responseType = 'json';
    var URL = "ajax/categories.php?action="+action+"&designation="+des;
    xhr.open("GET",URL,true);
    xhr.send(null);
    xhr.onreadystatechange = result;
    function result(){
      if (this.readyState === 4 && this.status === 200) {
        var data = xhr.response;
        data = xhr.response;
        
        if(data.status == true){
          $('#des').val("");
          $('#alert-des').text(data.result);
          $('#alert-des').addClass('text-success');
          $('#alert-des').removeClass('text-danger');
          $('#alert-des').removeClass('text-warning');
          $('#new-cat').css('display','none');
          update_categories_liste();
          

        }else{
          $('#alert-des').text(data.result);
          $('#alert-des').addClass('text-danger');
          $('#alert-des').removeClass('text-success');
          $('#alert-des').removeClass('text-warning');
          $('#new-cat').css('display','block');
        }
      }
        
    }
  }
  //mise a jour du tableaudes catégories
  function update_categories_liste(){
    var action = "all";
    xhr = new XMLHttpRequest;
    xhr.responseType = 'json';
    var URL = "ajax/categories.php?action="+action;
    xhr.open("GET",URL,true);
    xhr.send(null);
    xhr.onreadystatechange = result;
    function result(){
      if (this.readyState === 4 && this.status === 200) {
        var data = xhr.response;
        // mise a jour du tableau des catégories
        $("#all-cats").html(data.result);
      }
    }
  }
  //suppression d'une catégorie
  function supp_categorie(){
    var action = "supp";
    id = $("#id-cat-supp").val();
    xhr = new XMLHttpRequest;
    xhr.responseType = 'json';
    var URL = "ajax/categories.php?action="+action+"&id="+id;
    xhr.open("GET",URL,true);
    xhr.send(null);
    xhr.onreadystatechange = result;
    function result(){
      if (this.readyState === 4 && this.status === 200) {
          var data = xhr.response;
          $("#alert-supp-cat").text(data.result);
          if(data.status == 'linked'){
              
              $("#alert-supp-cat").addClass('text-danger');
              $("#alert-supp-cat").removeClass('text-success');
          }else{
              $("#alert-supp-cat").addClass('text-success');
              $("#alert-supp-cat").removeClass('text-danger');
              update_categories_liste();
              $("#btn-supp").css('display','none');

          }
      }
    }
  }
  //modification d'une catégorie
  function edit_categorie(){
    des = $("#des-cat").val();
    if(des==""){
        $("#alert-edit-cat").addClass('text-warning');
        $("#alert-edit-cat").text('Veuillez saisir la désignation de la catégorie');
    }else{
      var action = "edit";
      id = $("#id-cat-edit").val();
      xhr = new XMLHttpRequest;
      xhr.responseType = 'json';
      var URL = "ajax/categories.php?action="+action+"&id="+id+"&designation="+des;
      xhr.open("GET",URL,true);
      xhr.send(null);
      xhr.onreadystatechange = result;
      function result(){
        if (this.readyState === 4 && this.status === 200) {
            var data = xhr.response;
            data = xhr.response;
            $("#alert-edit-cat").text(data.result);
            if(data.status == 'linked'){
                
                $("#alert-edit-cat").addClass('text-danger');
                $("#alert-edit-cat").removeClass('text-success');
            }else{
                $("#alert-edit-cat").addClass('text-success');
                $("#alert-edit-cat").removeClass('text-danger');
                update_categories_liste();
                $("#btn-edit").css('display','none');

            }
        }
      }
    }
    
  }
  //verifier l'unicité de la designation de la catégorie lors de la modification
  function verif_unicite_categorie(){
      var des=$('#des-cat').val();
      if(des==""){
        $('#alert-des').text("");
        $('#btn-edit').css('display','none');
      }else{
          var id=$('#id-cat-edit').val();

          $('#btn-edit').css('display','block');
          var action = "find_edit";
          xhr = new XMLHttpRequest;
          xhr.responseType = 'json';
          var URL = "ajax/categories.php?action="+action+"&designation="+des+"&id="+id;
          xhr.open("GET",URL,true);
          xhr.send(null);
          xhr.onreadystatechange = result;
          function result(){
            if (this.readyState === 4 && this.status === 200) {
              var data = xhr.response;
              //data = xhr.responseText;
              if(data.status == 'unique'){
                $('#alert-edit-cat').addClass('text-success');
                $('#alert-edit-cat').removeClass('text-warning');
                $('#alert-edit-cat').removeClass('text-danger');
                $('#alert-edit-cat').text(data.result);
                
                $('#btn-edit').css('display','block');
              }else if(data.status == 'not-unique'){
                $('#alert-edit-cat').text(data.result);
                $('#alert-edit-cat').addClass('text-warning');
                $('#alert-edit-cat').removeClass('text-success');
                $('#alert-edit-cat').removeClass('text-danger');
                $('#btn-edit').css('display','none');
              }else{
                $('#alert-edit-cat').text(data.result);
                $('#alert-edit-cat').addClass('text-danger');
                $('#alert-edit-cat').removeClass('text-success');
                $('#alert-edit-cat').removeClass('text-warning');
                $('#btn-edit').css('display','block');
              }
            }
          }
      }
   }


                        /********************************
                        *********************************
                        ******Gestion Produits       **** 
                        *********************************
                        *********************************/
//lancer popups produits (page produits.php)
  function lancer_modals_produit(modal,id,des,desc,cat){
    if(modal=="#suppProd"){
      $('#suppProd').modal('show');
      $("#alert-supp-prod").html("");
      $("#btn-supp").css('display','block');
      $("#id-prod-supp").val(id);
    }else if(modal =="#newProd"){
        $("#des-prod").val("");
        $("#categorie").val("0");
        $(".nicEdit-main").text("");
        //$('#newProd').modal('show');
        
    }else{
      $('#editProd').modal('show');
      
    }
  }
  //retourner aux box liste produits
  function back_liste_prod(){
    $('#liste').css('display','block');
    $('#newProd').css('display','none');
  }
  //afficher formulaire ajout produit au lieu de la liste des produits
  function boxnewProd(){
    $('#newProd').css('display','block');
    $('#liste').css('display','none');
    $("#alert-champs").css('display','none');
  }
  //fonction qui verifie si la designation de la categorie entrée est unique
   function find_produit(){
      var des=$('#des-prod').val();
      if(des==""){
        $('#alert-des').text("");
        $('#new-prod').css('display','none');
      }else{
          $('#new-prod').css('display','block');
          var action = "find";
          xhr = new XMLHttpRequest;
          xhr.responseType = 'json';
          var URL = "ajax/produits.php?action="+action+"&designation="+des;
          xhr.open("GET",URL,true);
          xhr.send(null);
          xhr.onreadystatechange = result;
          function result(){
            if (this.readyState === 4 && this.status === 200) {
              var data = xhr.response;
              //data = xhr.responseText;
              if(data.status == 'unique'){
                $('#alert-des').addClass('text-success');
                $('#alert-des').removeClass('text-warning');
                $('#alert-des').removeClass('text-danger');
                $('#alert-des').text(data.result);
                
                $('#new-prod').css('display','block');
              }else if(data.status == 'not-unique'){
                $('#alert-des').text(data.result);
                $('#alert-des').addClass('text-warning');
                $('#alert-des').removeClass('text-success');
                $('#alert-des').removeClass('text-danger');
                $('#new-prod').css('display','none');
              }else{
                $('#alert-des').text(data.result);
                $('#alert-des').addClass('text-danger');
                $('#alert-des').removeClass('text-success');
                $('#alert-des').removeClass('text-warning');
                $('#new-prod').css('display','block');
              }
            }
          }
      }
   }/* 
   function check_files(){
     var f = document.getElementById('files');
      for (var i = 0; i < f.files.length; ++i) {
        var name = f.files.item(i).name;
        extension = name.split('.').pop();
        if(extension != 'jpg' && extension != 'jpeg' && extension != 'JPEG' && extension != 'png' && extension != 'PNG'){

        }else{

        }
      }
   }*/
  //ajouter un nouveau produit
  function new_produit(){
    var action = "new";
    var des = $('#des-prod').val();
    var cat = $('#categorie').val();
    if(des=="" || cat==0){
        $('#alert-des').text("Veuillez remplir tous les champs");
        $('#alert-des').addClass('text-success');
        $('#alert-des').removeClass('text-danger');
        $('#alert-des').removeClass('text-warning');
    }else{
      xhr = new XMLHttpRequest;
      xhr.responseType = 'json';
      var URL = "ajax/produits.php?action="+action+"&designation="+des;
      xhr.open("GET",URL,true);
      xhr.send(null);
      xhr.onreadystatechange = result;
      function result(){
        if (this.readyState === 4 && this.status === 200) {
          var data = xhr.response;
          data = xhr.response;
          
          if(data.status == true){
            $('#des').val("");
            $('#alert-des').text(data.result);
            $('#alert-des').addClass('text-success');
            $('#alert-des').removeClass('text-danger');
            $('#alert-des').removeClass('text-warning');
            $('#new-cat').css('display','block');
            update_categories_liste();
            $('#newCat').modal('hide');

          }else{
            $('#alert-des').text(data.result);
            $('#alert-des').addClass('text-danger');
            $('#alert-des').removeClass('text-success');
            $('#alert-des').removeClass('text-warning');
            $('#new-cat').css('display','block');
          }
        }
          
      }
    }
    
  }
  //mise a jour du tableau des produits
  function update_produits_liste(){
    var action = "all";
    xhr = new XMLHttpRequest;
    xhr.responseType = 'json';
    var URL = "ajax/produits.php?action="+action;
    xhr.open("GET",URL,true);
    xhr.send(null);
    xhr.onreadystatechange = result;
    function result(){
      if (this.readyState === 4 && this.status === 200) {
        var data = xhr.response;
        // mise a jour du tableau des produits
        $("#all-prods").html(data.result);
      }
    }
  }
  //suppression d'un produit
  function supp_produit(){
    var action = "supp";
    id = $("#id-prod-supp").val();
    xhr = new XMLHttpRequest;
    xhr.responseType = 'json';
    var URL = "ajax/produits.php?action="+action+"&id="+id;
    xhr.open("GET",URL,true);
    xhr.send(null);
    xhr.onreadystatechange = result;
    function result(){
      if (this.readyState === 4 && this.status === 200) {
          var data = xhr.response;
          $("#alert-supp-prod").text(data.result);
          if(data.status == 'linked'){
              
              $("#alert-supp-prod").addClass('text-danger');
              $("#alert-supp-prod").removeClass('text-success');
          }else{
              $("#alert-supp-prod").addClass('text-success');
              $("#alert-supp-prod").removeClass('text-danger');
              update_produits_liste();
              $("#btn-supp").css('display','none');

          }
      }
    }
  }
  
  //verifier l'unicité de la designation de la catégorie lors de la modification
  function verif_unicite_produit(){
      var des=$('#des-prod').val();
      if(des==""){
        $('#alert-des').text("");
        $('#btn-edit').css('display','none');
      }else{
          var id=$('#id-prod-edit').val();

          $('#btn-edit').css('display','block');
          var action = "find_edit";
          xhr = new XMLHttpRequest;
          xhr.responseType = 'json';
          var URL = "ajax/produits.php?action="+action+"&designation="+des+"&id="+id;
          xhr.open("GET",URL,true);
          xhr.send(null);
          xhr.onreadystatechange = result;
          function result(){
            if (this.readyState === 4 && this.status === 200) {
              var data = xhr.response;
              //data = xhr.responseText;
              if(data.status == 'unique'){
                $('#alert-edit-prod').addClass('text-success');
                $('#alert-edit-prod').removeClass('text-warning');
                $('#alert-edit-prod').removeClass('text-danger');
                $('#alert-edit-prod').text(data.result);
                
                $('#btn-edit').css('display','block');
              }else if(data.status == 'not-unique'){
                $('#alert-edit-prod').text(data.result);
                $('#alert-edit-prod').addClass('text-warning');
                $('#alert-edit-prod').removeClass('text-success');
                $('#alert-edit-prod').removeClass('text-danger');
                $('#btn-edit').css('display','none');
              }else{
                $('#alert-edit-prod').text(data.result);
                $('#alert-edit-prod').addClass('text-danger');
                $('#alert-edit-prod').removeClass('text-success');
                $('#alert-edit-prod').removeClass('text-warning');
                $('#btn-edit').css('display','block');
              }
            }
          }
      }

}


                        /********************************
                        *********************************
                        ******        Profil         **** 
                        *********************************
                        *********************************/
//modification du profil
//tests sur la saisie des champs                        
function modif_profil(){
    $('#alert1').css('display','none');
    $('#alert2').css('display','none');
    $("#alert-profil-login").css('display','none');
    $("#alert-profil-res").css('display','none');
    $("#alert-profil-tel").css('display','none');
    $("#alert-profil-email").css('display','none');
    var login = $("#login").val();
    var res = $("#res").val();
    var tel = $("#tel").val();
    var email = $("#email").val();
    var go = true;
    if(login==""){
      go = false;
      $("#alert-profil-login").css('display','block');
    }
    if(res==""){
      go = false;
      $("#alert-profil-res").css('display','block');
    }
    if(tel==""){
      go = false;
      $("#alert-profil-tel").css('display','block');
    }
    if(email==""){
      go = false;
      $("#alert-profil-email").css('display','block');
    }
    if(go==true){
    

        var action ="update_infos";
        var id = $("#user-id").val();
        xhr = new XMLHttpRequest;
        xhr.responseType = 'json';
        var URL = "ajax/users.php?action="+action+"&id="+id+"&login="+login+"&tel="+tel+"&email="+email+"&res="+res;
        xhr.open("GET",URL,true);
        xhr.send(null);
        xhr.onreadystatechange = result;
        function result(){
          if (this.readyState === 4 && this.status === 200) {
              var data = xhr.response;
              if(data.status == 'updated'){
                  $('#alert1').html(data.result);
                  
                  $('#alert1').css('display','block');
              }else{
                  $('#alert2').html(data.result);
                  
                  $('#alert2').css('display','block');

              }
          }
        }
    }else{
    }
}
//verifier si le mot de passe saisie et valide (egal a bd)
function check_pass(){
    $('#btn-pass').css('display','block');
    var pas = $("#act").val();
    var action ="check_pass";
    var id = $("#user-id").val();
    xhr = new XMLHttpRequest;
    xhr.responseType = 'json';
    var URL = "ajax/users.php?action="+action+"&id="+id+"&pass="+pas;
    xhr.open("GET",URL,true);
    xhr.send(null);
    xhr.onreadystatechange = result;
    function result(){
      if (this.readyState === 4 && this.status === 200) {
          var data = xhr.response;
          $('#alert-profil-act').html(data.result);  
          $('#alert-profil-act').css('display','block');
          if(data.status == 'found'){
              $('#btn-pass').css('display','block');
          }else{
              $('#btn-pass').css('display','none');
          }
      }
    }
}
//modification du mot ed passe
//tests sur la saisie des champs                        
function modif_password(){
  //mot de passe actuel, nouveau et confirmé et l'id 
  var act =$("#act").val();
  
  var npas =$("#npas").val();
  var cpas =$("#cpas").val();
  if(npas!=cpas){
      $('#alert-profil-npas').html('<span class="text-danger">Mots de passe différents</span>');  
      $('#alert-profil-cpas').html('<span class="text-danger">Mots de passe différents</span>');  
  }else{
      var action ="update_pass";
      var id = $("#user-id").val();
      xhr = new XMLHttpRequest;
      xhr.responseType = 'json';
      var URL = "ajax/users.php?action="+action+"&id="+id+"&pass="+npas;
      xhr.open("GET",URL,true);
      xhr.send(null);
      xhr.onreadystatechange = result;
      function result(){
        if (this.readyState === 4 && this.status === 200) {
            var data = xhr.response;
                $('#alert4').html(data.result);
                
                $('#alert4').css('display','block');
                $("#act").val();
                $("#cpas").val();
                $("#npas").val();
        }
      }
  }
  
  

}



                        /********************************
                        *********************************
                        ******        Slider         **** 
                        *********************************
                        *********************************/
  //lancer popups slider (page slider.php)
  function lancer_modals_slider(modal,id,titre,src){
    if(modal=="#suppSlide"){
      $('#suppSlide').modal('show');
      $("#alert-supp-slice").html("");
      $("#btn-supp").css('display','block');
      $("#id-slice-supp").val(id);
    }else if(modal =="#newSlide"){
        $("#titre-slide").val("");
        $("#src-slide").val("");
        $("#alert-add-slice").html("");
    }else{
      $('#editSlide').modal('show');
      $('#titre-slide-edit').val(titre);
      document.getElementById('img-edit').src = "uploads/slices/"+src;
      $('#src-slide-edit').val(src);
      $('#hidden-old-image').val(src);
      //$('#img-edit').attr("src", "uploads/slices/"+src);
      $('#id-slice-edit').val(id);
      $('#btn-edit').css('display','block');
      $('#alert-edit-slice').css('display','none');

    }
  }
//mise a jour de la liste des slices
  function update_slice_liste(){
    var action = "all";
    xhr = new XMLHttpRequest;
    xhr.responseType = 'json';
    var URL = "ajax/slider.php?action="+action;
    xhr.open("GET",URL,true);
    xhr.send(null);
    xhr.onreadystatechange = result;
    function result(){
      if (this.readyState === 4 && this.status === 200) {
        var datax = xhr.response;
        // mise a jour du tableau des produits
        //$("#slices").innerHTML(datax.result);
        document.getElementById('slices').innerHTML = datax.result;
      }
    }
  }
  //suprpimer slice
  function supp_slice(){
    var action = "supp";
    id = $("#id-slice-supp").val();
    xhr = new XMLHttpRequest;
    xhr.responseType = 'json';
    var URL = "ajax/slider.php?action="+action+"&id="+id;
    xhr.open("GET",URL,true);
    xhr.send(null);
    xhr.onreadystatechange = result;
    function result(){
      if (this.readyState === 4 && this.status === 200) {
          var data = xhr.response;
          $("#alert-supp-slice").html(data.result);
          if(data.status == 'deleted'){
              $("#alert-supp-slice").addClass('text-success');
              $("#alert-supp-slice").removeClass('text-danger');
              update_slice_liste();
              
          }else{
              $("#alert-supp-slice").addClass('text-danger');
              $("#alert-supp-slice").removeClass('text-success');
              

          }
          
      }
    }
  }

  
