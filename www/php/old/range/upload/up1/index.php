<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图片上传</title>
    <script type="text/javascript">
    function checkFile(){
        var flag = false;
        var str = document.getElementById("file").value;
        str = str.substring(str.lastIndexOf('.') + 1);
        var arr = new Array('png','bmp','gif','jpg');
        for (var i=0;i<arr.length;i++){
            if(str==arr[i]){
                flag = true;
            }
        }
        if(!flag){
            alert('文件不合法！');
            return false;
        }
        return flag;
    }
    </script>
</head>
<body>
    <form action="up.php" method="post" onsubmit="return checkFile()" enctype="multipart/form-data">
        <input type="file" name="file" id="file" /><br/>
        <input type="submit" value="提交" name="submit" />
    </form>
</body>
</html>