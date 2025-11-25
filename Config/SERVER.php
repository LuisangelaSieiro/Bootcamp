<?php
	
	/*----------  Datos del servidor  ----------*/
	const SERVER="localhost";
	const DB="bootcamp";
	const USER="root";
	const PASS="";


	const SGBD="mysql:host=".SERVER.";dbname=".DB;


	/*----------  Datos de la encriptacion (No modificar) ----------*/
	const METHOD="AES-256-CBC"; //Cifrado de 256 bits con CBC// no modificar//
	const SECRET_KEY='BC2025'; // 32 caracteres para AES-256-CBC// 
	const SECRET_IV='102791'; // 16 caracteres para AES-256-CBC// no modificar//