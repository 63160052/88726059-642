<?php
require_once("dbconfig.php");


if ($_POST){
    $doc_num = $_POST['doc_num'];
    $doc_title = $_POST['doc_title'];
    $doc_start_date = $_POST['doc_start_date'];
    $doc_to_date = $_POST['doc_to_date'];
    $doc_status = $_POST['doc_status'];
    $doc_file_name = $_FILES["doc_file_name"]["name"];

    $sql ="INSERT  
            INTO documents (doc_num, doc_title, doc_start_date, doc_to_date, doc_status, doc_file_name) 
            VALUES (?, ?, ? , ?, ?, ?);";       
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssss",$doc_num,$doc_title,$doc_start_date,$doc_to_date,$doc_status,$doc_file_name);
    $stmt->execute();

    //uploadpart
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["doc_file_name"]["name"]);
    $fileType="pdf";
    $realname="a.pdf";
    if (move_uploaded_file($_FILES["doc_file_name"]["tmp_name"], $target_file)) {
      //echo "The file ". htmlspecialchars( basename( $_FILES["doc_file_name"]["name"])). " has been uploaded.";
    } else {
      //echo "Sorry, there was an error uploading your file.";
    }
    //

 
    header("location: documents.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>NewDocuments</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Add Documents</h1>
        <form action="newdoc.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="doc_num">Order</label>
                <input type="text" class="form-control" name="doc_num" id="doc_num" >
            </div>
            <div class="form-group">
                <label for="doc_title">Order Name</label>
                <input type="text" class="form-control" name="doc_title" id="doc_title" >
            </div>
            <div class="form-group">
                <label for="doc_start_date">Start Date</label>
                <input type="date" class="form-control" name="doc_start_date" id="doc_start_date" >
            </div>
            <div class="form-group">
                <label for="doc_to_date">To Date</label>
                <input type="date" class="form-control" name="doc_to_date" id="doc_to_date" >
            </div>
            <div class="form-group">
                <label for="doc_status">Status</label>
                <input type="radio"  name="doc_status" id="doc_status" value="Active"> Active
                <input type="radio"  name="doc_status" id="doc_status" value="Expire"> Expire
            </div>
            <div class="form-group">
                <label for="doc_file_name">File Name</label>
                <input type="file" class="form-control" name="doc_file_name" id="doc_file_name"  >
            </div>
            <br>
            
            <button type="button" class="btn btn-warning" onclick="history.back();" >Back</button>
            <button type="submit" class="btn btn-success" >Save</button>
        </form>
</body>

</html>