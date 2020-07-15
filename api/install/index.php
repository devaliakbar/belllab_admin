<?php
require '../db/db.php';
require '../db/table/client.php';
require '../db/table/invoice.php';
require '../db/table/invoice_item.php';
require '../db/table/project.php';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CHECKING ALREADY INSTALLED
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ClientTableExistCheck = mysqli_query($conn, "SELECT 1 FROM " . Client::$TABLE_NAME . " LIMIT 1");
if ($ClientTableExistCheck == true) {
    echo "Already Installed";
    die();
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING CLIENT TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ClientTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . Client::$TABLE_NAME . " (
    " . Client::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . Client::$COLUMN_NAME . " VARCHAR(100) ,
    " . Client::$COLUMN_EMAIL . " VARCHAR(100) ,
    " . Client::$COLUMN_PHONE . " VARCHAR(20) ,
    " . Client::$COLUMN_ADDRESS . " VARCHAR(500)
)ENGINE = INNODB;";

if (mysqli_query($conn, $ClientTableCreateQuery)) {
    echo "<br>Table 'Client' created successfully<br>";
} else {
    echo "<br>Error creating table 'Client' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING PROJECT TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$ProjectTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . Project::$TABLE_NAME . " (
    " . Project::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,

    " . Project::$COLUMN_CLIENT_ID . " BIGINT UNSIGNED ,

    " . Project::$COLUMN_NAME . " VARCHAR(100) ,
    " . Project::$COLUMN_DESCRIPTION . " VARCHAR(100) ,
    " . Project::$COLUMN_AMOUNT . " DECIMAL ,
    " . Project::$COLUMN_RECIEVED . " DECIMAL ,
    " . Project::$COLUMN_BALANCE . " DECIMAL
)ENGINE = INNODB;";

if (mysqli_query($conn, $ProjectTableCreateQuery)) {
    echo "<br>Table 'Project' created successfully<br>";
} else {
    echo "<br>Error creating table 'Project' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING INVOICE TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$InvoiceTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . Invoice::$TABLE_NAME . " (
    " . Invoice::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
    " . Invoice::$COLUMN_PROJECT_ID . " BIGINT UNSIGNED ,
    " . Invoice::$COLUMN_NAME . " VARCHAR(100) ,
    " . Invoice::$COLUMN_EMAIL . " VARCHAR(100) ,
    " . Invoice::$COLUMN_PHONE . " VARCHAR(20) ,
    " . Invoice::$COLUMN_ADDRESS . " VARCHAR(500) ,
    " . Invoice::$COLUMN_DATE . " DATE ,
    " . Invoice::$COLUMN_PAYMENT_DETAILS . " VARCHAR(500) ,
    " . Invoice::$COLUMN_AMOUNT . " DECIMAL
)ENGINE = INNODB;";

if (mysqli_query($conn, $InvoiceTableCreateQuery)) {
    echo "<br>Table 'Invoice' created successfully<br>";
} else {
    echo "<br>Error creating table 'Invoice' : " . mysqli_error($conn) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CREATING INVOICE ITEM TABLE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$InvoiceItemTableCreateQuery = "CREATE TABLE IF NOT EXISTS " . InvoiceItem::$TABLE_NAME . " (
    " . InvoiceItem::$ID . " BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,

    " . InvoiceItem::$COLUMN_INVOICE_ID . " BIGINT UNSIGNED ,
    " . InvoiceItem::$COLUMN_ITEM . " VARCHAR(500) ,
    " . InvoiceItem::$COLUMN_QTY . " INT ,
    " . InvoiceItem::$COLUMN_TOTAL . " DECIMAL
)ENGINE = INNODB;";

if (mysqli_query($conn, $InvoiceItemTableCreateQuery)) {
    echo "<br>Table 'InvoiceItem' created successfully<br>";
} else {
    echo "<br>Error creating table 'InvoiceItem' : " . mysqli_error($conn) . "<br>";
}
