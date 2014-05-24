<?php
/*
	Author: Xenland
	Sponsored By: Cheaper In Bitcoins dot com ( http://cheaperinbitcoins.com )
	Info: Example on verifying a Bitcoin address
*/

function appendHexZeros($inputAddress, $hexEncodedAddress){

	//Append Zeros where nessecary
	for ($i = 0; $i < strlen($inputAddress) && $inputAddress[$i] == "1"; $i++) {
		$hexEncodedAddress = "00" . $hexEncodedAddress;
	}
	if (strlen($hexEncodedAddress) % 2 != 0) {
		$hexEncodedAddress = "0" . $hexEncodedAddress;
	}
	
	return $hexEncodedAddress;
}
function encodeHex($dec){
        $chars="0123456789ABCDEF";
        $return="";
        while (bccomp($dec,0)==1){
                $dv=(string)bcdiv($dec,"16",0);
                $rem=(integer)bcmod($dec,"16");
                $dec=$dv;
                $return=$return.$chars[$rem];
        }
        return strrev($return);
}

function base58_decode($base58){
	$origbase58 = $base58;
	
	//Define vairables
	$base58chars = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
	

	$return = "0";
	for ($i = 0; $i < strlen($base58); $i++) {
		$current = (string) strpos($base58chars, $base58[$i]);
		$return = (string) bcmul($return, "58", 0);
		$return = (string) bcadd($return, $current, 0);
	}
	return $return;
}

//Begin Tutorial Example
$inputAddress = "1PZoWjye1Xa1e1NSNYmKuxEJYGvcnJro7p";
echo "Input Address = ".$inputAddress;
echo "<br/><br/>";

$decodedAddress = base58_decode($inputAddress);
echo "Decoded Address = <b>decodeToBase58(</b>Input Address<b>)</b>";
echo "<br/>";
echo "Decoded Address = ".$decodedAddress;
echo "<br/><br/>";

$hexEncodedAddress = encodeHex($decodedAddress);
echo "Hex Encoded Check = <b>encodeToHexFormat(</b>Decoded Address<b>)</b>";
echo "<br/>";
echo "Hex Encoded Check = ".$hexEncodedAddress;
echo "<br/><br/>";

//Append the 00 to the front of it
echo "Hex Encoded Address = <b>appendHexZeros(</b>Hex Encoded Check<b>)</b>";
$hexEncodedAddress = appendHexZeros($inputAddress, $hexEncodedAddress);
echo "<br/>";
echo "Hex Encoded Address = ".$hexEncodedAddress;
echo "<br/><br/>";

//Remove last 8 characters from Hexencoded string
$encodedAddress = substr($hexEncodedAddress, 0, strlen($hexEncodedAddress) - 8);
echo "Encoded Address = <b>Remove last 8 characters(</b>Hex Encoded Address<b>)</b>";
echo "<br/>";
echo "Encoded Address = ".$encodedAddress;
echo "<br/><br/>";

//Convert to binary
$binaryAddress = pack("H*" , $encodedAddress);
echo "Encoded Address = <b>ConvertToBinary(</b>Encoded Address<b>)</b>";
echo "<br/><br/>";


//Hash(Hash(Value))
$hashedAddress = strtoupper(hash("sha256", hash("sha256", $binaryAddress, true)));
echo "Encoded Address = <b>SHA256(SHA256(</b>Encoded Address<b>))</b>";
echo "<br/>";
echo "Encoded Address = ".$hashedAddress;
echo "<br/><br/>";

//Return the beginning checksum of the address
$checkSumAddress = substr($hashedAddress, 0 ,8);
echo "CheckSum = <b>Remove all characters past the 8th character(</b>Encoded Address<b>)</b>";
echo "<br/>";
echo "CheckSum = ".$checkSumAddress;
echo "<br/><br/>";

echo "ValidCheckSum = <b>Return the last 8 characters(</b>Hex Encoded Check<b>)</b>";
echo "<br/><br/>";

echo "<b>If</b> ValidCheckSum = CheckSum:";
echo "<br/>";
echo '<span style="color:green;">Address is valid</span>';
echo "<br/>";
echo '<b>Else</b>';
echo "<br/>";
echo '<span style="color:red;">Address is not valid</span>';


?>
