function redirectUrl(url){
	window.location.href = url;
}

function buangInputData(){
	return confirm("Data belum tersimpan. Yakin ingin keluar?");
}

function cekFormInputData(){
  var cek = true;
  if(document.getElementById("tblInputKirim").rows.length < 2){
    alert("Tabel kosing! Tambah baris tabel terlebih dahulu!");
    cek = false;
  }
  else{
    var selNama = document.getElementsByName("nama[]");
    var row;
    for(row=0; row<selNama.length; row++){
      if(selNama[row].value.length < 1 || document.getElementsByName("nohp[]")[row].value.length < 1 || document.getElementsByName("jmlpaket[]")[row].value.length < 1 || document.getElementsByName("berat[]")[row].value.length < 1 || document.getElementsByName("ket[]")[row].value.length < 1){
        alert("Lengkapi tiap tabel! Hapus baris tabel jika berlebih");
        cek = false;
      }
    }
  }
  if(cek == true){ document.getElementById("btnFormSimpanData").click(); }
  else{ return cek; }
}

function askDel(tipe){
  if(tipe == "data"){
    return confirm("Data yang dihapus tidak akan dapat digunakan lagi. Lanjutkan?");
  }else if(tipe == "akun"){
    return confirm("Akun yang dihapus tidak akan dapat digunakan lagi. Lanjutkan?");
  }
}

function askDelData(){
  var cekChecked = false;
  var cbDel = document.getElementsByName("id[]");
  for (var rowId = 0; rowId < cbDel.length; rowId++){
    if (cbDel[rowId].checked){
      cekChecked = true;
      break;
    }
  }
  if(cekChecked == false){
    alert("Pilih data yang ingin dihapus terlebih dahulu");
    return false;
  }else{
    document.getElementById("hapusData").click();
  }
}

function askEdit(){
  var cbVal;
  var numChecked = 0;
  var cbEdit = document.getElementsByName("id[]");
  for (var rowId1 = 0; rowId1 < cbEdit.length; rowId1++){
    if (cbEdit[rowId1].checked){
      cbVal = cbEdit[rowId1].value;
      numChecked++;
    }
    if(numChecked > 1){
      break;
    }
  }
  if(numChecked > 1){
    alert("Pastikan hanya ada 1 data yang dipilih untuk Edit Data. Anda hanya dapat mengedit Data yang diinput dari akun anda");
  }else if(numChecked < 1){
    alert("Pilih 1 Data untuk Edit Data.  Anda hanya dapat mengedit Data yang diinput dari akun anda");
  }else{
    redirectUrl("edit_pengiriman.php?id="+cbVal);
  }
}

function editData(){
  document.getElementById("btnFormEditData").click();
}

function printData(){
  var printKota = document.getElementById("kota").value;
  var printTgl = document.getElementById("tgl").value;
  var printKarung = document.getElementById("karung").value;
  if(printKota.length < 1 || printTgl.length < 1 || printKarung < 1){
    alert("Lengkapi Kota, Tgl, dan No. Karung lalu klik Tampilkan sebelum mem-Print!");
  }else{
    window.open("datafilter.php?print="+printKota+"_"+printTgl+"_"+printKarung, "_blank");
  }
}

function linkAdmin(tipe, page){
  if(tipe == "user"){
    alert("Halaman " + page + " hanya bisa diakses akun Admin");
    return false;
  }
  else{
    return true;
  }
}

function kosongData(){
  document.getElementById("kosongkanData").click();
}

function getFilterData(kota, tgl, karung){
  document.getElementById("kota").value = kota;
  document.getElementById("tgl").value = tgl;
  document.getElementById("karung").value = karung;
}

$(document).ready(function(){
  if(page == "index"){
    // Dashboard Button
    $("button.dashboard-btn").click(function(){
      $(this).closest("div.card").children("div.card-body").toggleClass("hide");
      $(this).children("i.fa").toggleClass("fa-caret-down");
      $(this).children("i.fa").toggleClass("fa-caret-up");
    });
  }

  if(page == "pengiriman-modInput"){
  	// focus Modal Buat Tabel
  	$('input#inputKota').focus();

		//create table 
  	$("#btnBuatTabel").click(function(){
  		if( !$("input#inputKota").val() ) {
  			alert("Lengkapi isian!");
  		}else if( !$("input#inputTgl").val() ) {
  			alert("Lengkapi isian!");
  		}else {
  			$("#formKota").val($("#inputKota").val());
  			$("#formKarung").val($("#inputKarung").val());
  			$("#formTgl").val($("#inputTgl").val());

  			$("div#modalBuatTabel").removeClass("show");
  			$("div#modalBuatTabel").css("display", "");
  		}
  	});

  	//button Back
  	$("#btnBack").click(function(){
  		$("div#modalBuatTabel").removeClass("show");
  		$("div#modalBuatTabel").css("display", "");
  	});

  	//add and remove column
  	$("button#addRow").click(function(){
  			$("tr.rowTarget").removeClass("rowTarget");
  			var rowCount = $(this).closest("tbody.tblInputKirim").children("tr").length;
  			var crtRow = "<tr class='rowTarget'><td>"+rowCount+"</td><td><input type='text' class='form-control-sm border-0' name='nama[]'/></td><td><input type='text' class='form-control-sm border-0' name='nohp[]'/></td><td><input type='text' class='form-control-sm border-0' name='jmlpaket[]'/></td><td><input type='text' class='form-control-sm border-0' name='berat[]'/></td><td><input type='text' class='form-control-sm border-0' name='ket[]'/></td></tr>";
  			$(this).closest("tr").before(crtRow);
  	});
  	$("button#remRow").click(function(){
  		$("tr.rowTarget").addClass("removeTarget");
  		$("tr.rowTarget").removeClass("rowTarget");
  		$("tr.removeTarget").prev().addClass("rowTarget");
  		$("tr.removeTarget").remove();
  	});
  }
  else if(page == 'pengiriman' || page == 'datafilter'){
    $("#checkAll").click(function () {
      $(".check").prop('checked', $(this).prop('checked'));
    });
  }
    $("#show-hide-password button").on("click", function(event){
      event.preventDefault();
      if($("#show-hide-password input").attr("type") == "text"){
        $("#show-hide-password input").attr("type", "password");
        $("#show-hide-password i").addClass("fa-eye-slash");
        $("#show-hide-password i").removeClass("fa-eye");
      }else{
        $("#show-hide-password input").attr("type", "text");
        $("#show-hide-password i").addClass("fa-eye");
        $("#show-hide-password i").removeClass("fa-eye-slash");
      }
    });
    $("#formNamap").on("change", function(event){
      $("#formUsername").val($("#formNamap").val());
      $("#formPass").val($("#formNamap").val() + "_pass123");
    });

    $(".passBtn").on("click", function(event) {
      event.preventDefault();
      if($(this).closest("#passField").children("input").attr("type") == "text"){
        $(this).closest("#passField").children("input").attr("type", "password");
        $(this).children("i").addClass("fa-eye-slash");
        $(this).children("i").removeClass("fa-eye");
      }else{
        $(this).closest("#passField").children("input").attr("type", "text");
        $(this).children("i").addClass("fa-eye");
        $(this).children("i").removeClass("fa-eye-slash");
      }
    });

  $(".inputEA").one("click", function(){
      $("#btnEditAkun").removeClass("d-none");
      $("#btnEditAkun").addClass("d-flex");
    });
  
  if($(window).width() < 576){
    $("#liSearch").append($("#docpanel form"));
  }

  $(".docHover").click(function(){
    $(".docdropdown").toggleClass("disp");
  });
  
});