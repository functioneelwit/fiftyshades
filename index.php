<?php
 
include('functions.php');
 
if( $_GET['q'] )
{
    $hex = strtoupper($_GET['q']);

    if(strlen($hex) === 3)
    {
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }
    
    $rgb = hex2rgb($hex);
        
    if( $rgb['r'] === $rgb['g'] && $rgb['g'] === $rgb['b'] )
    {
        
        $code = 100 - round((($rgb['r'] / 255) * 100));
    
        if( $code < 10 )
        {
            $code = '0' . $code;
        }
        
        $class = '$color--gray-' . $code. ': #' . $hex . ';';

    }
    else
    {
       
        $find_by_js = true;
        
    }
    
    $input = '<input id="code" onClick="this.select();" value="' . @$class . '">';
    
}

?>

<html>
<head>
    <style>
        
        html
        {
            text-align: center;
            background-color: #<?php echo $hex; ?>;
            font-family: sans-serif;
        }
        
        input
        {
            width: 50%;
            margin-top: 45vh; 
            font-size: 30px; 
            padding: 10px; 
            text-align: center;
            border-radius: 8px;
            border: none;
        }
        
        .compare
        {
            display: inline-block;
            margin-top: 40px;
            width: 40%;
            padding: 30px;
            border-radius: 8px;
        }
        
        .item
        {
            float: left; 
            width: 10%;
        }
        
    </style>
    
    <script type="text/javascript" src="ntc.js"></script>
        
</head>
<body>
    
    <?php echo $input; ?>

    <br />

    <?php 
        
    if(isset($find_by_js))
    {
?>
    
    <span class="compare" id="compare"></span>
    
    <script type="text/javascript">

        var n_match  = ntc.name("#<?php echo $hex; ?>");
        var name =  n_match[1];
    
        name = name.replace(" / ", "-");
        name = name.replace(" ", "-");
        name = name.replace("/", "").toLowerCase();
    
        document.getElementById('code').value = '$color--' + name + ': #<?php echo $hex; ?>;';

    </script>

<?php
    
    }
    
?>

    
</body>
</html>