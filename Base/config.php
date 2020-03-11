<?php
const DB_TYPE = 'mysql';
const DB_HOST = 'localhost';
const DB_NAME = 'mvc';
const DB_USER = 'root';
const DB_PASS = '';

const SALT = 'sajnl70&7076^%#SDO';

\ORM::configure(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME);
\ORM::configure('username', DB_USER);
\ORM::configure('password', DB_PASS);