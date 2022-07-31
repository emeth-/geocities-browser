<?php

function guid() {
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

if(!$_GET['seed']) {
    header('Location: ?seed='.sha1(guid()));
}

$geo_seed_hash = sha1($_GET['seed']);

$r_num1 = hexdec(substr($geo_seed_hash, 30, 6)); //converted to a number 0-16,000,000
$line_number = $r_num1 % 1477689; //1477691 lines in the file

$file = "geocities_clean.csv";

$file = new SplFileObject($file);
$file->seek($line_number);
$line_contents = $file->current(); 
$geo_data = str_getcsv($line_contents); //Array ( [0] => es.geocities.com/mikelelcelote/ [1] => Página web de Miguel Ángel )

$name = $geo_data[1];
$service_url = "https://web.archive.org/web/19901027080830if_/http://www.".$geo_data[0]."#";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=htmlentities($name, ENT_QUOTES)?></title>
    <style>
.floating-random-button {
    position:fixed;
    bottom:10px;
    right:10px;
    cursor:pointer;
    z-index:999999;
}
    </style>
    <style>
  .pushable {
    position: relative;
    border: none;
    background: transparent;
    padding: 0;
    cursor: pointer;
    outline-offset: 4px;
    transition: filter 250ms;
  }
  .shadow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 12px;
    background: hsl(0deg 0% 0% / 0.25);
    will-change: transform;
    transform: translateY(2px);
    transition:
      transform
      600ms
      cubic-bezier(.3, .7, .4, 1);
  }
  .edge {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 12px;
    background: linear-gradient(
      to left,
      hsl(340deg 100% 16%) 0%,
      hsl(340deg 100% 32%) 8%,
      hsl(340deg 100% 32%) 92%,
      hsl(340deg 100% 16%) 100%
    );
  }
  .front {
    display: block;
    position: relative;
    padding: 12px 42px;
    border-radius: 12px;
    font-size: 1.25rem;
    color: white;
    background: hsl(345deg 100% 47%);
    will-change: transform;
    transform: translateY(-4px);
    transition:
      transform
      600ms
      cubic-bezier(.3, .7, .4, 1);
  }
  .pushable:hover {
    filter: brightness(110%);
  }
  .pushable:hover .front {
    transform: translateY(-6px);
    transition:
      transform
      250ms
      cubic-bezier(.3, .7, .4, 1.5);
  }
  .pushable:active .front {
    transform: translateY(-2px);
    transition: transform 34ms;
  }
  .pushable:hover .shadow {
    transform: translateY(4px);
    transition:
      transform
      250ms
      cubic-bezier(.3, .7, .4, 1.5);
  }
  .pushable:active .shadow {
    transform: translateY(1px);
    transition: transform 34ms;
  }
  .pushable:focus:not(:focus-visible) {
    outline: none;
  }
</style>
</head>
<body>
<div class="floating-random-button">
    <!-- Thanks to https://www.joshwcomeau.com/animation/3d-button/ for the awesome button -->
    <form action="?seed=<?=sha1(guid())?>'">
        <button type="submit" class="pushable">
        <span class="shadow"></span>
        <span class="edge"></span>
        <span class="front">
            Random Geocities Website
        </span>
        </button>
    </form>
</div>
<iframe
  id='geo_iframe'
  sandbox="allow-scripts allow-forms allow-same-origin allow-popups allow-modals"
  src="<?=htmlentities($service_url, ENT_QUOTES)?>"
  style="
    background-color: white;
    position:fixed; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; z-index:100;
  ">
</iframe>
</body>
</html>