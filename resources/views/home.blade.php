@extends('layouts.app')

<?php 
	use App\Models\star;
    ini_set('memory_limit', '-1');
	$data= star::all();
?>


@section('content')
<html lang="en">
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
	
	<nav class="buttonList navbar navbar-expand-md navbar-light bg-white shadow-sm">
		<a onclick="add()">Ajouter</a>
		<a onclick="edit({{ json_encode($data) }})">Modifier/Supprimer</a>
	</nav>
	<div class="action bg-white shadow-sm" id="action">
	</div>
</body>
</html>

<script type="application/javascript">

function add(){
    var div = document.getElementById('action');
    removeAllChild(div);
    const h4 = document.createElement("h4");
        h4.className="h4Add";
        h4.appendChild(document.createTextNode("Ajouter"));
    const form = document.createElement('form')
        form.className="form bg-white shadow-sm";
        form.id="form";
        form.method="post";
        form.action ="{{ route('star.store'); }}";
    const labelPhoto = document.createElement('label');
        labelPhoto.appendChild(document.createTextNode("Photo : *"));
        labelPhoto.htmlFor="avatar";
    const img = document.createElement('img');
        img.className="imgVue";
        img.id="imgVue";
        img.style="display:none;";
    const hiddenBase = document.createElement('input');
        hiddenBase.type="hidden"; 
        hiddenBase.id="base64";
        hiddenBase.name="base64";
    const inputPhoto = document.createElement('input');
        inputPhoto.type="file";
        inputPhoto.id="avatar"; 
        inputPhoto.name="avatar";
        inputPhoto.ref="avatar";
        inputPhoto.setAttribute('required', '');
        inputPhoto.onchange=function(){onchangeImg()};
    const labelNom = document.createElement('label');
        labelNom.appendChild(document.createTextNode("Nom : *"));
        labelNom.htmlFor="nom";
    const inputNom = document.createElement('input');
        inputNom.type="text";
        inputNom.id="nom"; 
        inputNom.name="nom";
        inputNom.setAttribute('required', '');
    const labelPrenom = document.createElement('label');
        labelPrenom.appendChild(document.createTextNode("Prenom : *"));
        labelPrenom.htmlFor="prenom";
    const inputPrenom = document.createElement('input');
        inputPrenom.type="text";
        inputPrenom.id="prenom"; 
        inputPrenom.name="prenom";
        inputPrenom.setAttribute('required', '');
    const labelPara = document.createElement('label');
        labelPara.appendChild(document.createTextNode("Description : *"));
        labelPara.htmlFor="para";
    const textArea = document.createElement('textarea');
        textArea.id="para";
        textArea.name="para"
        textArea.cols="50";
        textArea.setAttribute('required', '');
    const inputSubmit = document.createElement('input');
        inputSubmit.type="submit";
        inputSubmit.id="submit"; 
        inputSubmit.name="submit";
        inputSubmit.value="Ajouter";
        inputSubmit.style="width: 30%; margin-left:30%; background: #808080;background-image: -webkit-linear-gradient(top, #808080, #525252);background-image: -moz-linear-gradient(top, #808080, #525252);background-image: -ms-linear-gradient(top, #808080, #525252);background-image: -o-linear-gradient(top, #808080, #525252);background-image: linear-gradient(to bottom, #808080, #525252);-webkit-border-radius: 28;-moz-border-radius: 28;border-radius: 28px;font-family: Arial;color: #ffffff;font-size: 90%;padding: 1% 2% 1% 2%;text-decoration: none;border-color:#fff";


    
    div.append(h4);
    form.append(document.createElement('br'));
    form.append(labelPhoto);
    form.append(document.createElement('br'));
    form.append(img);
    form.append(hiddenBase); 
    form.append(inputPhoto);
    form.append(document.createElement('br'));
    form.append(labelNom);
    form.append(document.createElement('br'));
    form.append(inputNom);
    form.append(document.createElement('br'));
    form.append(labelPrenom);
    form.append(document.createElement('br'));
    form.append(inputPrenom);
    form.append(document.createElement('br'));
    form.append(labelPara);
    form.append(document.createElement('br'));
    form.append(textArea);
    form.append(document.createElement('br'));
    form.append(inputSubmit);
    div.append(form);
}
function removeAllChild(parent) {
    while (parent.firstChild)
        parent.removeChild(parent.firstChild);
}
function edit(datas){
    var div = document.getElementById('action');
    removeAllChild(div);
    const divEdit = document.createElement('div');
        divEdit.className="edit";
        divEdit.id="edit"; 
    const h4 = document.createElement('h4');
        h4.appendChild(document.createTextNode("Modifier/Supprimer"))
    const divList = document.createElement('div');
        divList.className="listOfEdit";
    var count=0;
    datas.forEach((element) => {
        const newButton = document.createElement('button');
            newButton.appendChild(document.createTextNode(element.prenom + " " + element.nom));
            newButton.id=count;
            newButton.onclick=function(){onEdit(element)};
        divList.append(newButton);
        count++;
    });
    div.append(h4);
    divEdit.append(divList);
    div.append(divEdit);
}

function getBase64(file) {

    var reader = new FileReader();
    reader.readAsDataURL(file.files[0]);	
    reader.onloadend = function () {
        document.getElementById('imgVue').src=reader.result;
        document.getElementById('base64').value=reader.result;
    };
}
function onchangeImg(){
    var file= document.getElementById('avatar');
    getBase64(file);
    document.getElementById('imgVue').style="display:block;";
}

function onEdit(dataElement){
    if(document.getElementById("informationEdit") != null){
        document.getElementById("informationEdit").remove();
    }
    const formInfos = document.createElement("form");
        formInfos.className="informationEdit";
        formInfos.id="informationEdit";
        formInfos.method="post";
        formInfos.action ="{{ route('star.update'); }}";
    const buttonDelete = document.createElement("img");
        buttonDelete.appendChild(document.createTextNode("Delete"));
        buttonDelete.style="margin: 5% 0 0 95%; width: 50px; heigth: 50px; object-fit: cover; cursor: pointer;"
        buttonDelete.src="/icon/bin.png";
        buttonDelete.onclick=function(){deleteImg(dataElement.id)};
    const hiddenId = document.createElement('input');
        hiddenId.type="hidden"; 
        hiddenId.id="id";
        hiddenId.name="id";
        hiddenId.value=dataElement.id;
    const labelImage = document.createElement('label');
        labelImage.appendChild(document.createTextNode("Photo :"));
        labelImage.htmlFor="imgVue";
    const image=document.createElement('img');
        image.className="imgVue"
        image.id="imgVue";
        image.src=dataElement.image;
    const labelImg = document.createElement('label');
        labelImg.appendChild(document.createTextNode("Modifier"));
        labelImg.htmlFor="avatar";
        labelImg.className="btnImg btn";
    const inputImg = document.createElement('input');
        inputImg.type="file";
        inputImg.id="avatar";
        inputImg.name="avatar";
        inputImg.ref="avatar";
        inputImg.style="display:none";
        inputImg.onchange=function(){onchangeImg()};
    const hiddenBase = document.createElement('input');
        hiddenBase.type="hidden"; 
        hiddenBase.id="base64";
        hiddenBase.name="base64";
        hiddenBase.value=dataElement.image;
    const labelNom = document.createElement('label');
        labelNom.appendChild(document.createTextNode("Nom :"));
        labelNom.htmlFor="nom";
    const inputNom = document.createElement('input');
        inputNom.type="text";
        inputNom.id="nom"; 
        inputNom.name="nom";
        inputNom.value=dataElement.nom;
    const labelPrenom = document.createElement('label');
        labelPrenom.appendChild(document.createTextNode("Prenom :"));
        labelPrenom.htmlFor="prenom";
    const inputPrenom = document.createElement('input');
        inputPrenom.type="text";
        inputPrenom.id="prenom"; 
        inputPrenom.name="prenom";
        inputPrenom.value=dataElement.prenom;
    const labelPara = document.createElement('label');
        labelPara.appendChild(document.createTextNode("Description :"));
        labelPara.htmlFor="para";
    const textArea = document.createElement('textarea');
        textArea.id="para";
        textArea.name="para";
        textArea.cols="50"
        textArea.value=dataElement.description;
    const inputSubmit = document.createElement('input');
        inputSubmit.type="submit";
        inputSubmit.id="submit"; 
        inputSubmit.name="submit";
        inputSubmit.value="Modifier";
        inputSubmit.style="width: 30%; margin-left:35%; background: #808080;background-image: -webkit-linear-gradient(top, #808080, #525252);background-image: -moz-linear-gradient(top, #808080, #525252);background-image: -ms-linear-gradient(top, #808080, #525252);background-image: -o-linear-gradient(top, #808080, #525252);background-image: linear-gradient(to bottom, #808080, #525252);-webkit-border-radius: 28;-moz-border-radius: 28;border-radius: 28px;font-family: Arial;color: #ffffff;font-size: 90%;padding: 1% 2% 1% 2%;text-decoration: none;border-color:#fff";
        
    var div = document.getElementById("edit");
    formInfos.append(hiddenId);
    formInfos.append(buttonDelete);
    formInfos.append(document.createElement('br'));
    formInfos.append(labelImage); 
    formInfos.append(document.createElement('br'));
    formInfos.append(image);
    formInfos.append(labelImg);
    formInfos.append(inputImg);
    formInfos.append(hiddenBase);
    formInfos.append(document.createElement('br'));
    formInfos.append(labelNom); 
    formInfos.append(document.createElement('br'));
    formInfos.append(inputNom); 
    formInfos.append(document.createElement('br'));
    formInfos.append(labelPrenom);
    formInfos.append(document.createElement('br'));
    formInfos.append(inputPrenom); 
    formInfos.append(document.createElement('br'));
    formInfos.append(labelPara); 
    formInfos.append(document.createElement('br'));
    formInfos.append(textArea);
    formInfos.append(document.createElement('br'));
    formInfos.append(inputSubmit);
    div.append(formInfos);
}

function deleteImg(id){
    var url = "{{ route('star.delete'); }}" + "?id=" + id ;
    window.location.replace(url); 
}


</script>

<link rel="stylesheet" type="text/css" href="/css/page.css"/>

@endsection
