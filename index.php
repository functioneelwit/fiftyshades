<?php

include('functions.php');

if($_POST['input'])
{
    $input_hex = $_POST['input'];

    if(validate_hex($input_hex))
    {
        header('location: ' . $input_hex);
        exit;
    }
    else
    {
        $error = '#' . $input_hex . ' is no valid hex color value.. better yourself!';
    }

}


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

        $class = '$color--gray-' . $code. ': #' . minify_hex($hex) . ';';

    }
    else
    {

        $find_by_js = true;

    }

    $input = '<input id="code" value="' . @$class . '">';

}

?>

<html>
<head>
    <style>

        html
        {
            text-align: center;
            background-color: #<?php echo $hex ? $hex : 'ddd' ?>;
            font-family: sans-serif;
        }

        form
        {
            padding: 30px;
        }

        input.input
        {
            width: 120px;
            text-align: center;
        }

        input.input,
        input.submit
        {
            font-size: 20px;
            border-radius: 4px;
            border: none;
            padding: 5px 15px;
        }

        input#code
        {
            width: 50%;
            margin-top: 15vh;
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

        .error
        {
            display: inline-block;
            background-color: red;
            padding: 6px 12px;
            color: white;
            font-weight: bold;
            border-radius: 8px;
            margin: 5px;
        }

        .thanks
        {
            position: fixed;
            bottom: 10px;
            left: 10px;
        }

        .github
        {
            position: fixed;
            bottom: 10px;
            right: 10px;
        }

    </style>

    <script type="text/javascript" src="ntc.js"></script>

</head>
<body>

<?php

    if(isset($error))
    {

?>

    <span class="error"><?php echo $error ?></span>

<?php

    }

?>

    <form method="POST">
        <input type="text" class="input" name="input" value="<?php echo ( $input_hex ) ? $input_hex : $hex ?>" placeholder="XXXXXX"/>
        <input type="submit" class="submit" value="Go!" />
    </form>


    <?php echo $input; ?>

    <br />

    <?php

    if(isset($find_by_js))
    {
?>

    <span class="compare" id="compare"></span>

    <script type="text/javascript">

        var n_match  = ntc.name("#<?php echo $hex; ?>");
        var name = n_match[1];

        name = name.replace(" / ", "-");
        name = name.replace(" ", "-");
        name = name.toLowerCase();

        document.getElementById('code').value = '$color--' + name + ': #<?php echo minify_hex($hex) ?>;';

    </script>

<?php

    }

?>


<small class="thanks">Thanks <a href="http://chir.ag/projects/ntc">Chirag Mehta</a>!</small>
<small class="github"><a href="https://github.com/functioneelwit/fiftyshades">Project on Github</a></small>


</body>
</html>