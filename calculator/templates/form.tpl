<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<h1>{title}</h1>

<form name="calc" method="POST">
       <label>Number #1</label>
       <input type="text" name="a" value="{a}" placeholder="Input a here">

       <br>
       <br>
       <label>Number #2</label>
       <input type="text" name="b" value="{b}" placeholder="Input b here">

       <br>
       <br>
       <label>Operation</label>
       <select name="operation">
            <option value="Sum">Sum</option>
            <option value="Sub">Subtraction</option>
            <option value="Mul">Multiply</option>
            <option value="Div">Divide</option>
       </select>

       <br>
       <br>
       <button type="submit">Calculate</button>

       <p>{result}</p>

</form>
</body>
</html>
