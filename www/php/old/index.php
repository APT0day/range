<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>SQL 注入</h3>
    <a href="range/sqli/sqli1.php?id=1" target="_blank">SQL注入1(数字型注入)</a><br />
    <a href="range/sqli/sqli2.php?id=1" target="_blank">SQL注入2(闭合单引号)</a><br />
    <a href="range/sqli/sqli3.php?id=1" target="_blank">SQL注入3(闭合双引号)</a><br />
    <a href="range/sqli/sqli4.php?id=1" target="_blank">SQL注入4(闭合括号)</a><br />
    <a href="range/sqli/sqli5.php?id=1" target="_blank">SQL注入5(报错注入)</a><br />
    <a href="range/sqli/sqli6.php?id=1" target="_blank">SQL注入6(布尔型注入)</a><br />
    <a href="range/sqli/sqli7.php?id=1" target="_blank">SQL注入7(过滤了'--'和'#')</a><br />
    <a href="range/sqli/sqli8.php?id=1" target="_blank">SQL注入8(简单二次注入)</a><br />
    <a href="range/sqli/sqli9.php?id=1" target="_blank">SQL注入9(宽字节注入)</a><br />
    <a href="range/sqli/sqli10.php?id=1" target="_blank">SQL注入10(二次urldecode注入)</a><br />
    <h3>XSS</h3>
    <a href="range/xss/xss1.php?id=1" target="_blank">XSS1(反射型xss)</a><br />
    <a href="range/xss/xss2.php?id=1" target="_blank">XSS2(反射型,正则过滤 script 标签)</a><br />
    <a href="range/xss/xss3.php?id=1" target="_blank">XSS3(反射型,正则过滤 script 标签 不区分大小写)</a><br />
    <a href="range/xss/xss4.php?id=1" target="_blank">XSS4(反射型,正则过滤 script 标签 不区分大小写;双写)</a><br />
    <a href="range/xss/xss5.php?id=1" target="_blank">XSS5(反射型,正则过滤 单双引号)</a><br />
    <a href="range/xss/xss6.php?id=1" target="_blank">XSS6(反射型,正则过滤 标签)</a><br />
    <a href="range/xss/xss7.php" target="_blank">XSS7(存储型xss)</a><br />
    <a href="range/xss/xss8.php" target="_blank">XSS8(DOM型xss)</a><br />
    <h3>文件上传</h3>
    <a href="range/upload/up1/index.php" target="_blank">文件上传(前端js过滤)</a><br />
    <a href="range/upload/up1/index.php" target="_blank">文件上传(黑名单过滤后缀名)</a><br />
    <a href="range/upload/up1/index.php" target="_blank">文件上传(MIME验证)</a><br />
    <a href="range/upload/up1/index.php" target="_blank">文件上传(MIME验证且文件重命名)</a><br />
    <a href="range/upload/up1/index.php" target="_blank">文件上传(验证文件头)</a><br />
    <h3>命令执行</h3>
    <a href="command_exec/ce1.php" target="_blank">命令执行</a><br />
    <a href="command_exec/ce2.php" target="_blank">命令执行(GET到的数据被双引号包括)</a><br />
    <a href="command_exec/ce3.php" target="_blank">命令执行(过滤'&'和';')</a><br />
    <h3>代码执行</h3>
    <a href="code_exec/eval1.php" target="_blank">代码执行</a><br />
    <a href="code_exec/eval2.php" target="_blank">代码执行(需要闭合'))</a><br />
    <a href="code_exec/eval3.php" target="_blank">代码执行(需要闭合"))</a><br />
    <a href="code_exec/assert.php" target="_blank">代码执行(assert的使用)</a><br />
    <a href="code_exec/preg_replace.php" target="_blank">代码执行(preg_replace的/e)</a><br />
    <h3>文件包含</h3>
    <a href="fi/fi1/" target="_blank">文件包含</a><br />
    <a href="fi/fi2/" target="_blank">文件包含(使用%00)</a><br />
    <h3>CSRF</h3>
    <a href="csrf/csrf1/" target="_blank">CSRF(可删除留言)</a><br />
    <a href="csrf/csrf2/" target="_blank">CSRF(可重置密码)</a><br />
    <h3>SSRF</h3>
    <a href="ssrf/ssrf1.php" target="_blank">ssrf1</a><br />
    <a href="ssrf/ssrf2.php" target="_blank">ssrf2</a><br />
    <a href="ssrf/ssrf3.php" target="_blank">ssrf3</a><br />
    <h3>越权</h3>
    <a href="ultra_vires/" target="_blank">越权(更改cookie)</a><br />
    <h3>爆破</h3>
    <a href="range/blast/blast1/index.php" target="_blank">爆破(4位数字验证码)</a><br />
    <a href="range/blast/blast2/index.php" target="_blank">爆破(表单)</a><br />
    <h3>任意文件下载</h3>
    <a href="file/read.php?file=test.txt" target="_blank">任意文件读取</a><br />
    <a href="file/down.php" target="_blank">任意文件下载</a><br />
    <h3>反序列化</h3>
    <a href="range/deserialize//deserialize1.php" target="_blank">test</a>
    <h3>Test</h3>
    <a href="" target="_blank">Test</a>
</body>

<style>
    a {
        text-decoration: none;
        word-break: break-all;
    }
</style>

</html>