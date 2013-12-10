<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


$config['metadata'] =
        array
            (          
            '2' => array('name' => 'Τίτλος στη Γλώσσα Δημοσίευσης', 'schema' => "dc", 'element' => "title", 'qualifier' => "", 'language' => "en", 'required' => "1", "large" => "0", 'pair' => "1"),
            '3' => array('name' => 'Τίτλος σε άλλη γλώσσα', 'schema' => "dc", 'element' => "title", 'qualifier' => "alternative", 'language' => "el", 'required' => "1", "large" => "0", 'pair' => "1"),
            '4' => array('name' => 'Περίληψη στη γλώσσα δημοσίευσης', 'schema' => "dc", 'element' => "description", 'qualifier' => "abstract", 'language' => "en", 'required' => "1", "large" => "1", 'pair' => "2"),
            '5' => array('name' => 'Περίληψη σε άλλη γλώσσα', 'schema' => "dc", 'element' => "description", 'qualifier' => "abstract", 'language' => "el", 'required' => "1", "large" => "1", 'pair' => "2"),
            '6' => array('name' => 'Βιβλιογραφική αναφορά', 'schema' => "dc", 'element' => "identifier", 'qualifier' => "citation", 'language' => "en", 'required' => "1", "large" => "1", 'pair' => "0"),
            '7' => array('name' => 'Έτος δημοσίευσης', 'schema' => "dc", 'element' => "date", 'qualifier' => "", 'language' => "en", 'required' => "1", "large" => "0", 'pair' => "0")
);


$config['admeta'] =
        array
            (
            '4' => array('name' => 'Περίληψη στη γλώσσα δημοσίευσης', 'schema' => "dc", 'element' => "description", 'qualifier' => "abstract", 'language' => "en", 'required' => "1", "large" => "1", 'pair' => "2"),
            '5' => array('name' => 'Περίληψη σε άλλη γλώσσα', 'schema' => "dc", 'element' => "description", 'qualifier' => "abstract", 'language' => "el", 'required' => "1", "large" => "1", 'pair' => "2"),
            '6' => array('name' => 'Λέξη κλειδί στα Αγγλικά', 'schema' => "dc", 'element' => "subject", 'qualifier' => "", 'language' => "en", 'required' => "1", "large" => "0", 'pair' => "0"),
            '7' => array('name' => 'Λέξη κλειδί στα Ελληνικά', 'schema' => "dc", 'element' => "subject", 'qualifier' => "", 'language' => "el", 'required' => "1", "large" => "0", 'pair' => "0"),
       
);

$config['irserver'] = 'http://your_ir_server:8080/axis2/services/dspaceWS?wsdl';
$config['iruser'] = 'your_ir_user';
$config['ircommunity'] = 0;
$config['year'] = 7;
$config['title'] = 2;
$config['title_sec'] = 3;
$config['citation'] = 6;

$config['pubtypes'] =
        array(
            '1' => array('type' => 'Βιβλίο', 'dcsavevalue' => ''),
            '2' => array('type' => 'Κεφάλαιο Βιβλίου'),
            '3' => array('type' => 'Περιοδικό'),
            '4' => array('type' => 'Πρακτικά συνεδρίου'),
            '5' => array('type' => 'Άλλο')
);


$config['PositionTypes'] = array
    (
    '0' => array('type' => 'Ερευνητής'),
    '1' => array('type' => 'Λέκτορας'),
    '2' => array('type' => 'Επίκουρος Καθηγητής'),
    '3' => array('type' => 'Αναπληρωτής Καθηγητής'),
    '4' => array('type' => 'Καθηγητής'),
    '5' => array('type' => 'Άλλη')
);