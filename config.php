<?php


$db = mysqli_connect('localhost', 'root', '', 'endterm');

if (!$db) {
  die("Connection failed:". mysqli_connect_error());
}