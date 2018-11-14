<!DOCTYPE html>
<html lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Login</title>
</head>
<nav> 
    <a href="index.php">Home</a> &nbsp;
    <a href="drag.php">Upload/Download</a> &nbsp;
    <a href="email.php">Email Files</a> &nbsp;
    <a href="login.php">Logout</a> &nbsp;
</nav>
<style>
    #drop_file_zone {
        background-color: #EEE; 
        border: #999 5px dashed;
        width: 290px; 
        height: 200px;
        padding: 8px;
        font-size: 18px;
    }
    #drag_upload_file {
        width:50%;
        margin:0 auto;
    }
    #drag_upload_file p {
        text-align: center;
    }
    #drag_upload_file #selectfile {
        display: none;
    }
</style>
<div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
    <div id="drag_upload_file">
        <p>Drop file here</p>
        <p>or</p>
        <p><input type="button" value="Select File" onclick="file_explorer();"></p>
        <input type="file" id="selectfile">
    </div>
</div>

<script type="text/javascript">
    var fileobj;
    function upload_file(e) {
        e.preventDefault();
        fileobj = e.dataTransfer.files[0];
        ajax_file_upload(fileobj);
    }
 
    function file_explorer() {
        document.getElementById('selectfile').click();
        document.getElementById('selectfile').onchange = function() {
            fileobj = document.getElementById('selectfile').files[0];
            ajax_file_upload(fileobj);
        };
    }
 
    function ajax_file_upload(file_obj) {
        if(file_obj != undefined) {
            var form_data = new FormData();                  
            form_data.append('file', file_obj);
            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                contentType: false,
                processData: false,
                data: form_data,
                success:function(response) {
                    alert(response);
                    $('#selectfile').val('');
                }
            });
        }
    }
</script>

<?PHP
$db = mysqli_connect('capstonedb.cmste82q8owq.us-east-1.rds.amazonaws.com', 'thares96', 'Guitars6', 'Capstone_DB');
    
$arr_file_types = ['image/pdf'];
 
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
    echo "false";
    return;
}
 
if (!file_exists('uploads')) {
    mkdir('uploads', 0777);
}
 
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . time() . $_FILES['file']['name']);
 
echo "File uploaded successfully.";
?>