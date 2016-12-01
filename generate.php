<?php
// settings
$plgName        = 'Elegrit';
$plgDescription = 'Elegrit Payment Gateway';
$apiUrl         = 'http://api.elegrit.com/';
$gatewayUrl     = 'http://gatway.elegrit.com/';
$sandboxUrl     = 'http://sandbox.elegrit.com/';
$domainUrl      = 'http://domain.elegrit.com/';
$author         = 'Zbigniew Jasek';

// handle and path
$plgHandle      = strtolower(str_replace(' ', '-', $plgName));
$path           = __DIR__ . '/woocommerce-' . $plgHandle . '/';

// copy master
mkdir('woocommerce-' . $plgHandle);
recurse_copy(__DIR__ . '/woocommerce-payment-gateway-boilerplate/', $path);

// rename files
rename($path . 'includes/class-wc-gateway-payment-gateway-boilerplate-add-ons.php', $path . 'includes/class-wc-gateway-' . $plgHandle . '-add-ons.php');
rename($path . 'includes/class-wc-gateway-payment-gateway-boilerplate.php', $path . 'includes/class-wc-gateway-' . $plgHandle . '.php');
rename($path . 'languages/woocommerce-payment-gateway-boilerplate.mo', $path . 'languages/woocommerce-' . $plgHandle . '.mo');
rename($path . 'languages/woocommerce-payment-gateway-boilerplate.pot', $path . 'languages/woocommerce-' . $plgHandle . '.pot');
rename($path . 'woocommerce-payment-gateway-boilerplate.php', $path . 'woocommerce-' . $plgHandle . '.php');

// text replacements
$replacements = [
    'A payment gateway boilerplate created to help get you started in developing a payment gateway for WooCommerce.' => $plgDescription,
    'A payment gateway description can be placed here.' => $plgDescription,
    
    'Gateway Name'  => $plgName,
    'Gateway name'  => $plgName,
    'gateway_name'  => str_replace('-', '_', $plgHandle),
    
    'payment-gateway-boilerplate' => $plgHandle,
    'payment_gateway_boilerplate' => str_replace('-', '_', $plgHandle),
    'Payment Gateway Boilerplate' => $plgName,
    
    'WC_Gateway_Name' => 'WC_' . str_replace(' ', '_', $plgName),
    'WC_Gateway_Payment_Gateway_Boilerplate' => 'WC_Gateway_' . str_replace(' ', '_', $plgName),
    'woocommerce-payment-gateway-boilerplate' => 'woocommerce-' . $plgHandle,
    'woocommerce_payment_gateway_boilerplate_icon' => str_replace('-', '_', 'woocommerce-' . $plgHandle . '-icon'),
    'WooCommerce Payment Gateway Boilerplate' => 'WooCommerce ' . $plgName,
    
    'https://api.payment-gateway.com/' => $apiUrl,
    'https://www.payment-gateway.com' => $gatewayUrl,
    'https://www.sandbox.payment-gateway.com' => $sandboxUrl,
    'https://www.domain.com' => $domainUrl,
    
    'Sebastien Dumont' => 'Sebastien Dumont / ' . $author,
];

// replace woocommerce-payment-gateway-boilerplate.php
$file_contents = file_get_contents($path . 'woocommerce-' . $plgHandle . '.php');
foreach($replacements as $key => $val) {
    $file_contents = str_replace($key, $val, $file_contents);
    // $file_contents = preg_replace('/.*TODO.*[\n\r]/', "", $file_contents);
}
file_put_contents($path . 'woocommerce-' . $plgHandle . '.php', $file_contents);

// replace includes/class-wc-gateway-cio-direct.php
$file_contents = file_get_contents($path . 'includes/class-wc-gateway-' . $plgHandle . '.php');
foreach($replacements as $key => $val) {
    $file_contents = str_replace($key, $val, $file_contents);
}
file_put_contents($path . 'includes/class-wc-gateway-' . $plgHandle . '.php', $file_contents);

// replace includes/class-wc-gateway-cio-direct.php
$file_contents = file_get_contents($path . 'includes/class-wc-gateway-' . $plgHandle . '-add-ons.php');
foreach($replacements as $key => $val) {
    $file_contents = str_replace($key, $val, $file_contents);
}
file_put_contents($path . 'includes/class-wc-gateway-' . $plgHandle . '-add-ons.php', $file_contents);

// replace includes/admin/views/admin-options.php
$file_contents = file_get_contents($path . 'includes/admin/views/admin-options.php');
foreach($replacements as $key => $val) {
    $file_contents = str_replace($key, $val, $file_contents);
}
file_put_contents($path . 'includes/admin/views/admin-options.php', $file_contents);

// replace woocommerce-payment-gateway-boilerplate.mo
$file_contents = file_get_contents($path . 'languages/woocommerce-' . $plgHandle . '.mo');
foreach($replacements as $key => $val) {
    $file_contents = str_replace($key, $val, $file_contents);
}
file_put_contents($path . 'languages/woocommerce-' . $plgHandle . '.mo', $file_contents);

// replace woocommerce-payment-gateway-boilerplate.pot
$file_contents = file_get_contents($path . 'languages/woocommerce-' . $plgHandle . '.pot');
foreach($replacements as $key => $val) {
    $file_contents = str_replace($key, $val, $file_contents);
}
file_put_contents($path . 'languages/woocommerce-' . $plgHandle . '.pot', $file_contents);

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 